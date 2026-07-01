<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventoController extends Controller
{

    public function criar()
    {
        if (!session('usuario_id')) {
            return redirect()->route('login')->withErrors(['erro' => 'Faça login para acessar esta página.']);
        }

        return view('evento.criar');
    }


    public function index(Request $request)
{
    $categoria_id = $request->query('categoria_id');

    $query = DB::table('eventos');

    if ($categoria_id) {
        $query->where('category_id', $categoria_id);
    }

    $eventos = $query->orderBy('date_time', 'asc')->get();
    $categorias = DB::table('categories')->get();

    return view('vitrine.home', compact('eventos', 'categorias'));
}

public function detalhes($id)
{
    $evento = DB::table('eventos')->where('id', $id)->first();

    if (!$evento) {
        return redirect()->route('home')->withErrors(['erro' => 'Evento não encontrado.']);
    }

    $jaInscrito = false;
    $usuario_id = session('usuario_id');

    if ($usuario_id) {
        $jaInscrito = DB::table('event_user')
            ->where('event_id', $id)
            ->where('user_id', $usuario_id)
            ->exists();
    }

    return view('vitrine.detalhes', compact('evento', 'jaInscrito'));
}
public function salvar(Request $request)
{
    $organizador_id = session('usuario_id');
    if (!$organizador_id) {
        return redirect()->route('login')->withErrors(['erro' => 'Sessão expirada. Faça login novamente.']);
    }

    $title = $request->input('title') ?? $request->input('titulo');
    $description = $request->input('description') ?? $request->input('descricao');
    $date_time = $request->input('date_time') ?? $request->input('data');
    $location = $request->input('location') ?? $request->input('local');
    $capacity = $request->input('capacity') ?? $request->input('vagas');

    if (strtotime($date_time) < time()) {
        return redirect()->back()->withErrors(['erro' => 'Não é possível cadastrar eventos com datas retroativas.'])->withInput();
    }

    $banner_path = null;
    if ($request->hasFile('banner') && $request->file('banner')->isValid()) {
        $extensao = $request->file('banner')->getClientOriginalExtension();
        if (in_array(strtolower($extensao), ['jpg', 'jpeg', 'png', 'webp'])) {
            $banner_path = $request->file('banner')->store('banners', 'public');
        }
    }

    $category_id = 1;
    $categoriaExiste = DB::table('categories')->where('id', $category_id)->exists();
    if (!$categoriaExiste) {
        DB::table('categories')->insert([
            'id' => $category_id,
            'name' => 'Geral',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    DB::table('eventos')->insert([
        'user_id' => $organizador_id,
        'category_id' => $category_id,
        'title' => $title,
        'description' => $description,
        'date_time' => $date_time,
        'location' => $location,
        'capacity' => $capacity,
        'vagas' => $capacity,
        'banner_path' => $banner_path,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return redirect()->route('home')->with('sucesso', 'Evento publicado com sucesso!');
}
public function meusEventos()
{
    $organizador_id = session('usuario_id');
    
    $eventos = DB::table('eventos')
        ->where('user_id', $organizador_id)
        ->orderBy('date_time', 'asc')
        ->get();

    return view('evento.meus', compact('eventos'));
}
public function editar($id)
{
    $organizador_id = session('usuario_id');
    
    $evento = DB::table('eventos')
        ->where('id', $id)
        ->where('user_id', $organizador_id)
        ->first();

    if (!$evento) {
        return redirect()->route('evento.meus')->withErrors(['erro' => 'Evento não encontrado ou acesso negado.']);
    }

    return view('evento.editar', compact('evento'));
}

public function atualizar(Request $request, $id)
{
    $organizador_id = session('usuario_id');
    
    $evento = DB::table('eventos')
        ->where('id', $id)
        ->where('user_id', $organizador_id)
        ->first();

    if (!$evento) {
        return redirect()->route('evento.meus')->withErrors(['erro' => 'Evento não encontrado.']);
    }

    $title = $request->input('title') ?? $request->input('titulo');
    $description = $request->input('description') ?? $request->input('descricao');
    $date_time = $request->input('date_time') ?? $request->input('data');
    $location = $request->input('location') ?? $request->input('local');
    $capacity = $request->input('capacity') ?? $request->input('vagas');

    $banner_path = $evento->banner_path;
    if ($request->hasFile('banner') && $request->file('banner')->isValid()) {
        $extensao = $request->file('banner')->getClientOriginalExtension();
        if (in_array(strtolower($extensao), ['jpg', 'jpeg', 'png', 'webp'])) {
            $banner_path = $request->file('banner')->store('banners', 'public');
        }
    }

    DB::table('eventos')
        ->where('id', $id)
        ->update([
            'title' => $title,
            'description' => $description,
            'date_time' => $date_time,
            'location' => $location,
            'capacity' => $capacity,
            'banner_path' => $banner_path,
            'updated_at' => now()
        ]);

    return redirect()->route('evento.meus')->with('sucesso', 'Evento atualizado com sucesso!');
}

public function excluir($id)
{
    $organizador_id = session('usuario_id');

    $deleted = DB::table('eventos')
        ->where('id', $id)
        ->where('user_id', $organizador_id)
        ->delete();

    if (!$deleted) {
        return redirect()->route('evento.meus')->withErrors(['erro' => 'Não foi possível excluir o evento.']);
    }

    return redirect()->route('evento.meus')->with('sucesso', 'Evento excluído com sucesso!');
}
public function meusIngressos()
{
    $participante_id = session('usuario_id');
    if (!$participante_id) {
        return redirect()->route('login')->withErrors(['erro' => 'Faça login para ver seus ingressos.']);
    }

    $ingressos = DB::table('event_user')
        ->join('eventos', 'event_user.event_id', '=', 'eventos.id')
        ->where('event_user.user_id', $participante_id)
        ->select('eventos.*', 'event_user.ticket_code', 'event_user.created_at as data_inscricao')
        ->orderBy('event_user.created_at', 'desc')
        ->get();

    return view('participante.ingressos', compact('ingressos'));
}
public function cancelarInscricao($id)
{
    $participante_id = session('usuario_id');
    if (!$participante_id) {
        return redirect()->route('login')->withErrors(['erro' => 'Faça login para gerenciar suas inscrições.']);
    }

    $inscricao = DB::table('event_user')
        ->where('event_id', $id)
        ->where('user_id', $participante_id)
        ->first();

    if ($inscricao) {
        DB::table('event_user')
            ->where('event_id', $id)
            ->where('user_id', $participante_id)
            ->delete();

        DB::table('eventos')
            ->where('id', $id)
            ->increment('vagas');

        return redirect()->route('inscricao.meus')->with('sucesso', 'Sua inscrição foi cancelada e a vaga foi liberada.');
    }

    return redirect()->route('inscricao.meus')->withErrors(['erro' => 'Inscrição não encontrada.']);
}
}