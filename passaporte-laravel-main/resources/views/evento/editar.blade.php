@extends('layout.base')

@section('title', 'Editar Evento - Passaporte.io')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <div class="mb-6">
        <h1 class="text-3xl font-bold tracking-tight">Editar Evento</h1>
        <p class="text-sm opacity-70 mt-1">Altere os dados necessários do evento.</p>
    </div>

    <div class="bg-base-100 p-6 rounded-xl shadow-lg border border-base-200">
        <form action="{{ route('evento.atualizar', $evento->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="form-control w-full">
                <label class="label"><span class="label-text font-semibold">Título do Evento</span></label>
                <input type="text" name="title" value="{{ $evento->title }}" required class="input input-bordered w-full" />
            </div>

            <div class="form-control w-full">
                <label class="label"><span class="label-text font-semibold">Descrição Breve</span></label>
                <textarea name="description" required class="textarea textarea-bordered w-full h-24">{{ $evento->description }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-control w-full">
                    <label class="label"><span class="label-text font-semibold">Data e Horário</span></label>
                    <input type="datetime-local" name="date_time" value="{{ date('Y-m-d\TH:i', strtotime($evento->date_time)) }}" required class="input input-bordered w-full" />
                </div>

                <div class="form-control w-full">
                    <label class="label"><span class="label-text font-semibold">Capacidade Máxima</span></label>
                    <input type="number" name="capacity" value="{{ $evento->capacity }}" required min="1" class="input input-bordered w-full" />
                </div>
            </div>

            <div class="form-control w-full">
                <label class="label"><span class="label-text font-semibold">Local do Evento</span></label>
                <input type="text" name="location" value="{{ $evento->location }}" required class="input input-bordered w-full" />
            </div>

            <div class="form-control w-full">
                <label class="label"><span class="label-text font-semibold">Substituir Banner (Opcional)</span></label>
                <input type="file" name="banner" class="file-input file-input-bordered file-input-primary w-full" accept="image/*" />
            </div>

            <div class="flex gap-4 mt-6">
                <a href="{{ route('evento.meus') }}" class="btn btn-outline w-1/2">Cancelar</a>
                <button type="submit" class="btn btn-primary w-1/2">Salvar Alterações</button>
            </div>
        </form>
    </div>
</div>
@endsection