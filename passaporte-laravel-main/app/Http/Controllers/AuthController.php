<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'senha' => 'required',
    ]);

    $usuario = DB::table('usuario')->where('email', $request->email)->first();

    if ($usuario && Hash::check($request->senha, $usuario->password)) {
        
        session([
            'usuario_id'   => $usuario->id,
            'usuario_nome' => $usuario->name,
            'usuario_role' => $usuario->role
        ]);

        return redirect()->route('home')->with('sucesso', 'Bem-vindo de volta, ' . $usuario->name . '!');
    }

    return redirect()->back()->withErrors(['erro' => 'E-mail ou senha incorretos.']);
}
    public function logout()
    {
        session()->forget(['usuario_id', 'usuario_nome']);
        return redirect()->route('login')->with('sucesso', 'Sessão encerrada com sucesso.');
    }
}