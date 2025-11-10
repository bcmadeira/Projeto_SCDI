<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Doador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DoadorAuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.cadastro_doador');
    }

    public function cadastrar(Request $request)
    {
        $request->validate([
            'tipo_doador' => 'required|in:pessoa_fisica,pessoa_juridica',
            'nome' => 'required|string',
            'cpf_cnpj' => 'required|string',
            'telefone' => 'required|string',
            'endereco' => 'required|string',
            'cidade' => 'required|string',
            'email' => 'required|email|unique:doadores,email',
            'password' => 'required|confirmed|min:6',
        ]);

        Doador::create([
            'tipo_doador' => $request->tipo_doador,
            'nome' => $request->nome,
            'cpf_cnpj' => $request->cpf_cnpj,
            'telefone' => $request->telefone,
            'endereco' => $request->endereco,
            'cidade' => $request->cidade,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('login.doador')->with('success', 'Cadastro realizado com sucesso! Faça login.');
    }

    public function showLoginForm()
    {
        return view('auth.login_doador');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('doador')->attempt($credentials)) {
            return redirect()->intended('/painel-doador');
        }

        return back()->withErrors(['email' => 'E-mail ou senha incorretos.']);
    }

    public function logout()
    {
        Auth::guard('doador')->logout();
        return redirect()->route('login.doador')->with('success', 'Logout realizado com sucesso!');
    }
}
