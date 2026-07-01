@extends('layout.base')

@section('title', 'Meus Ingressos - Passaporte.io')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Meus Ingressos</h1>
        <p class="text-sm opacity-70 mt-1">Aqui estão seus vouchers confirmados para os próximos eventos.</p>
    </div>

    @if(session('sucesso'))
        <div class="alert alert-success mb-6 shadow-md">
            <span>{{ session('sucesso') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error mb-6 shadow-md">
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <div class="space-y-6">
        @forelse($ingressos as $ingresso)
            <div class="bg-base-100 rounded-2xl shadow-xl border border-base-200 overflow-hidden flex flex-col md:flex-row">
                <div class="md:w-1/3 h-48 md:h-auto bg-base-200 relative">
                    @if($ingresso->banner_path)
                        <img src="{{ asset('storage/' . $ingresso->banner_path) }}" alt="Banner" class="w-full h-full object-cover" />
                    @else
                        <div class="flex items-center justify-center text-5xl opacity-20 w-full h-full bg-neutral">
                            🎟️
                        </div>
                    @endif
                </div>

                <div class="p-6 flex flex-col justify-between flex-1 border-t md:border-t-0 md:border-l border-dashed border-base-300">
                    <div>
                        <div class="flex justify-between items-start gap-4 mb-2">
                            <h2 class="text-xl font-bold text-primary">{{ $ingresso->title }}</h2>
                            <div class="badge badge-success text-white font-bold py-3 px-4 tracking-wider">
                                CONFIRMADO
                            </div>
                        </div>
                        <p class="text-sm opacity-70 line-clamp-2 mb-4">{{ $ingresso->description }}</p>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm opacity-90">
                            <div> <span class="font-semibold">{{ date('d/m/Y H:i', strtotime($ingresso->date_time)) }}</span></div>
                            <div> <span class="font-semibold truncate block">{{ $ingresso->location }}</span></div>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-base-200 flex flex-col sm:flex-row justify-between items-center gap-4 bg-base-200/40 p-4 rounded-xl">
                        <div>
                            <span class="text-xs uppercase tracking-wider opacity-60 block">Código do Voucher</span>
                            <span class="font-mono text-lg font-bold text-secondary tracking-widest">{{ $ingresso->ticket_code ?? 'TICKET-ERRO' }}</span>
                        </div>
                        <div class="flex items-center gap-2 w-full sm:w-auto">
                            <a href="{{ route('evento.detalhes', $ingresso->id) }}" class="btn btn-sm btn-outline btn-primary flex-1 sm:flex-none">
                                Ver Detalhes
                            </a>
                            <form action="{{ route('inscricao.cancelar', $ingresso->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja cancelar sua inscrição neste evento?');" class="flex-1 sm:flex-none">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-error btn-outline w-full">
                                    Cancelar Vaga
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-16 bg-base-100 rounded-2xl border border-base-200 opacity-60">
                <p class="text-xl mb-4">Você ainda não se inscreveu em nenhum evento.</p>
                <a href="{{ route('home') }}" class="btn btn-primary btn-sm">Explorar Vitrine</a>
            </div>
        @endforelse
    </div>
</div>
@endsection