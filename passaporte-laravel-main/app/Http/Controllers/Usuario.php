<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Usuario extends Controller
{
    public function cadastrar()
    {
        return view('usuario.cadastro');
    }

    public function salvar(Request $request)
    {
        $nome = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $role = $request->input('role');

        $usuarioExiste = DB::table('usuario')->where('email', $email)->exists();
        if ($usuarioExiste) {
            return redirect()->back()->withErrors(['erro' => 'Este endereço de e-mail já está cadastrado.']);
        }

        $senhaCriptografada = Hash::make($password);

        DB::table('usuario')->insert([
            'name' => $nome,
            'email' => $email,
            'password' => $senhaCriptografada,
            'role' => $role,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('login')->with('sucesso', 'Conta criada com sucesso! Faça o login.');
    }
}