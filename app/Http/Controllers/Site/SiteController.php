<?php

namespace App\Http\Controllers\Site;

use Exception;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{
    public function home()
    {
        $products = Product::paginate(8);

        return view('site.home', [
            'products' => $products
        ]);
    }

    public function plans()
    {
        return view('site.plan');
    }

    public function formLogin()
    {
        if (Auth::check()) {
            return redirect()->route('site.account.home');
        }
        
        return view('site.account.login');
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ];

        $message = [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Esse e-mail já está cadastrado.',
            'password.required' => 'A senha é obrigatória.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        try {
            DB::beginTransaction();

            $userCreate = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            DB::commit();
            return redirect()->route('site.account.login')->with([
                'color' => 'success',
                'message' => 'Cadastro efetuado com sucesso. Faça o Login!'
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->withErrors([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function login(Request $request)
    {
        if (in_array('', $request->only('email', 'password'))) {
            return redirect()->back()->withInput()->withErrors([
                'message' => 'Oooops, informe todos os dados para efetuar o login!'
            ]);
        }

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->withInput()->withErrors([
                'message' => 'Oooops, informe um e-mail válido!'
            ]);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (!Auth::attempt($credentials)) {
            return redirect()->back()->withInput()->withErrors([
                'message' => 'Oooops, dados não conferem ou você não tem acesso a essa área!'
            ]);
        }

        return redirect()->route('site.account.home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('site.account.login');
    }

    public function homeAccount()
    {
        return view('site.account.home');
    }

    public function infoAccount()
    {
        return view('site.account.info', [
            'user' => Auth::user()
        ]);
    }

    public function updateInfoAccount(UserRequest $request)
    {
        $user = Auth::user();

        try {
            DB::beginTransaction();

            $user->fill($request->all());
            $user->save();

            DB::commit();
            return redirect()->route('site.account.info')->with([
                'color' => 'success',
                'message' => 'Cadastro atualizado com sucesso!'
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->withErrors([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function transactionAccount()
    {
        return view('site.account.transaction');
    }
}
