<?php

namespace App\Http\Controllers\Admin;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\PagarmeRequestService;

class AuthController extends Controller
{
    public function home()
    {
        if (!Auth::user()->is_admin) {
            Auth::logout();
            return redirect()->route('admin.formlogin');
        }

        $pagarme = new PagarmeRequestService();
        $balance = $pagarme->getBalance();

        $transactions = Transaction::orderBy('id', 'DESC')->limit(10)->get();

        return view('admin.home', [
            'balance' => $balance,
            'transactions' => $transactions
        ]);
    }

    public function formLogin()
    {
        if (Auth::check() === true && Auth::user()->is_admin) {
            return redirect()->route('admin.home');
        }

        Auth::logout();
        return view('admin.login');
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
            'password' => $request->password,
            'is_admin' => 1
        ];

        if (!Auth::attempt($credentials)) {
            return redirect()->back()->withInput()->withErrors([
                'message' => 'Oooops, dados não conferem ou você não tem acesso a essa área!'
            ]);
        }

        return redirect()->route('admin.home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.formlogin');
    }
}
