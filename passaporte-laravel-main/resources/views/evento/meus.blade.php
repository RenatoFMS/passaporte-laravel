@extends('layout.base')

@section('title', 'Meus Eventos - Passaporte.io')

@section('content')
<div class="container mx-auto px-4 py-8">
    
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold tracking-tight">Meus Eventos Criados</h1>
            <p class="text-sm opacity-70 mt-1">Gerencie as vagas e acompanhe o engajamento das suas publicações.</p>
        </div>
        <a href="{{ route('evento.criar') }}" class="btn btn-primary gap-2 shadow-md">
            ⚡ Criar Novo Evento
        </a>
    </div>

    <div class="overflow-x-auto w-full bg-base-100 rounded-xl shadow-lg border border-base-200">
        <table class="table w-full">
            <thead>
                <tr class="bg-base-200 text-base">
                    <th>Evento</th>
                    <th>Data / Hora</th>
                    <th>Localização</th>
                    <th>Lotação (Vagas Restantes)</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($eventos as $item)
                    <tr class="hover:bg-base-200/50 transition-colors">
                        <td>
                            <div class="font-bold text-lg text-primary">{{ $item->title }}</div>
                        </td>
                        <td class="font-medium">
                            {{ date('d/m/Y H:i', strtotime($item->date_time)) }}
                        </td>
                        <td class="max-w-xs truncate font-medium">
                            {{ $item->location }}
                        </td>
                        <td>
                            <div class="badge badge-ghost font-semibold py-3 px-4">
                                {{ $item->capacity - $item->vagas }} / {{ $item->capacity }} inscritos
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('home') }}" class="btn btn-xs btn-outline btn-info" title="Ver na Vitrine">
                                    Ver
                                </a>
                                <a href="{{ route('evento.editar', $item->id) }}" class="btn btn-xs btn-warning text-white" title="Editar Evento">
                                    Editar
                                </a>
                                <form action="{{ route('evento.excluir', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este evento?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-error text-white" title="Excluir Evento">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-12 opacity-60 text-lg">
                            Você ainda não publicou nenhum evento.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection