@extends('layout.base')

@section('title', 'Passaporte.io - Vitrine de Eventos')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="text-center max-w-2xl mx-auto mb-12">
        <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl text-primary">Encontre seu próximo evento</h1>
        <p class="mt-4 text-lg opacity-70">Garanta sua vaga de forma rápida, segura e instantânea.</p>
    </div>

    <div class="flex flex-wrap justify-center gap-2 mb-10">
        <a href="{{ route('home') }}" class="btn btn-sm {{ !request('categoria_id') ? 'btn-primary' : 'btn-outline' }}">
             Todos
        </a>
        @foreach($categorias as $cat)
            <a href="{{ route('home', ['categoria_id' => $cat->id]) }}" class="btn btn-sm {{ request('categoria_id') == $cat->id ? 'btn-primary' : 'btn-outline' }}">
                {{ $cat->name }}
            </a>
        @endforeach
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($eventos as $item)
            <div class="card bg-base-100 shadow-xl border border-base-200 overflow-hidden hover:shadow-2xl transition-all duration-300">
                <figure class="h-48 bg-base-300 relative">
                    @if($item->banner_path)
                        <img src="{{ asset('storage/' . $item->banner_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover" />
                    @else
                        <div class="flex items-center justify-center text-4xl opacity-20 w-full h-full"></div>
                    @endif
                </figure>
                <div class="card-body p-6">
                    <h2 class="card-title text-xl font-bold text-primary truncate block">{{ $item->title }}</h2>
                    <p class="text-sm opacity-70 line-clamp-2 my-2">{{ $item->description }}</p>
                    <div class="text-xs opacity-80 space-y-1 my-3">
                        <div> {{ date('d/m/Y H:i', strtotime($item->date_time)) }}</div>
                        <div> {{ $item->location }}</div>
                    </div>
                    <div class="card-actions justify-between items-center mt-4 pt-4 border-t border-base-200">
                        <div class="badge badge-ghost font-semibold p-3">
                            {{ $item->vagas }} vagas restando
                        </div>
                        <a href="{{ route('evento.detalhes', $item->id) }}" class="btn btn-primary btn-sm px-5">
                            Ver Mais
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16 opacity-60">
                <p class="text-xl">Nenhum evento encontrado para esta seleção.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection