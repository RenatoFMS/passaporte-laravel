@extends('layout.base')

@section('title', $evento->title . ' - Passaporte.io')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    
    <div class="mb-4">
        <a href="{{ route('home') }}" class="btn btn-ghost btn-sm gap-2">
            ⬅️ Voltar para a Vitrine
        </a>
    </div>

    <div class="bg-base-100 rounded-3xl shadow-xl border border-base-200 overflow-hidden">
        
        <div class="w-full h-64 md:h-96 bg-base-300 relative">
            @if($evento->banner_path)
                <img src="{{ asset('storage/' . $evento->banner_path) }}" alt="{{ $evento->title }}" class="w-full h-full object-cover" />
            @else
                <div class="flex items-center justify-center text-7xl opacity-20 w-full h-full bg-neutral">
                    ✨
                </div>
            @endif
        </div>

        <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="md:col-span-2 space-y-6">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold tracking-tight text-primary">{{ $evento->title }}</h1>
                    <div class="flex flex-wrap gap-4 mt-3 text-sm opacity-80">
                        <div>📅 {{ date('d/m/Y \à\s H:i', strtotime($evento->date_time)) }}</div>
                        <div>📍 {{ $evento->location }}</div>
                    </div>
                </div>

                <div class="border-t border-base-200 pt-6">
                    <h2 class="text-xl font-bold mb-3">Sobre o Evento</h2>
                    <p class="text-base opacity-90 leading-relaxed whitespace-pre-line">{{ $evento->description }}</p>
                </div>
            </div>

            <div class="space-y-4">
                <div class="bg-base-200/50 p-6 rounded-2xl border border-base-200 shadow-inner">
                    <div class="mb-4 text-center">
                        <span class="text-xs uppercase tracking-wider opacity-60 block">Vagas Disponíveis</span>
                        <span class="text-3xl font-black text-secondary">{{ $evento->vagas }} / {{ $evento->capacity }}</span>
                    </div>

                    <div class="space-y-3">
                        @if(!session('usuario_id'))
                            <div class="text-center space-y-2">
                                <p class="text-xs opacity-70">Você precisa estar logado para reservar sua vaga.</p>
                                <a href="{{ route('login') }}" class="btn btn-primary w-full shadow-md">
                                    🔑 Entrar para Inscrever-se
                                </a>
                            </div>
                        @elseif(session('usuario_role') === 'organizador')
                            <button class="btn btn-neutral btn-block" disabled>
                                🚫 Conta de Organizador
                            </button>
                            <p class="text-[11px] text-center opacity-60">Organizadores não podem se inscrever em eventos.</p>
                        @elseif($jaInscrito)
                            <button class="btn btn-success text-white btn-block" disabled>
                                ✓ Inscrição Confirmada
                            </button>
                        @elseif($evento->vagas <= 0)
                            <button class="btn btn-error text-white btn-block" disabled>
                                ❌ Vagas Esgotadas
                            </button>
                        @else
                            <form action="{{ route('inscricao.salvar', $evento->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-block shadow-md">
                                    🎟️ Garantir Minha Vaga
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection