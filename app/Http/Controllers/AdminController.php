<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Exibe o formulário de login
    public function showLoginForm()
    {
        return view('adm.adm');
    }

    // Lida com a submissão do formulário de login
    public function login(Request $request)
    {
        // Validação dos dados de email e senha
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Tenta fazer o login usando o guard 'adm'
        if (Auth::guard('adm')->attempt($credentials)) {
            // Se o login for bem-sucedido, redireciona o usuário
            return redirect()->intended('control');
        }

        // Se o login falhar, retorna com mensagem de erro
        return back()->withErrors([
            'email' => 'As credenciais não correspondem aos nossos registros.',
        ])->withInput();
    }
}
