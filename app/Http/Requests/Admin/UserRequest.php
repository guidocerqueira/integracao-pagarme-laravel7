<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->user ?? Auth::id();

        return [
            'name' => 'required|min:3|max:191',
            'email' => "required|email|unique:users,email,{$id},id",
            'password' => $this->method() === 'PUT' ? '' : 'required',
            'genre' => 'in:male,female,other',
            'cpf' => "required|min:11|max:14|unique:users,cpf,{$id},id",
            'cell' => 'required',
        ];
    }
}
