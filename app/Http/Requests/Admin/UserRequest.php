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
        return [
            'name' => 'required|min:3|max:191',
            'email' => (!empty($this->request->all()['id']) ? 'required|email|unique:users,email,' . $this->request->all()['id'] : 'required|email|unique:users,email'),
            'password' => (!empty($this->request->all()['id']) ? '' : 'required'),
            'genre' => 'in:male,female,other',
            'cpf' => (!empty($this->request->all()['id']) ? 'required|min:11|max:14|unique:users,cpf,' . $this->request->all()['id'] : 'required|min:11|max:14|unique:users,cpf'),
            'cell' => 'required',
        ];
    }
}
