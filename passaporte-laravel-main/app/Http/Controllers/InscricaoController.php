<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InscricaoController extends Controller
{
    public function inscrever(Request $request, $id)
{
    $usuario_id = session('usuario_id');
    if (!$usuario_id) {
        return redirect()->route('login')->withErrors(['erro' => 'Você precisa estar logado para se inscrever.']);
    }

    if (session('usuario_role') === 'organizador') {
        return redirect()->back()->withErrors(['erro' => 'Organizadores não podem se inscrever em eventos.']);
    }

    $evento = DB::table('eventos')->where('id', $id)->first();
    if (!$evento) {
        return redirect()->back()->withErrors(['erro' => 'Evento não encontrado.']);
    }

    if ($evento->vagas <= 0) {
        return redirect()->back()->withErrors(['erro' => 'Vagas esgotadas para este evento.']);
    }

    $jaInscrito = DB::table('event_user')
        ->where('event_id', $id)
        ->where('user_id', $usuario_id)
        ->exists();

    if ($jaInscrito) {
        return redirect()->back()->withErrors(['erro' => 'Você já está inscrito neste evento.']);
    }

    DB::table('event_user')->insert([
        'user_id' => $usuario_id,
        'event_id' => $id,
        'ticket_code' => 'TICKET-' . strtoupper(bin2hex(random_bytes(4))),
        'status' => 'Confirmada',
        'created_at' => now(),
        'updated_at' => now()
    ]);

    DB::table('eventos')->where('id', $id)->decrement('vagas');

    return redirect()->route('inscricao.meus')->with('sucesso', 'Inscrição realizada com sucesso!');
}
}