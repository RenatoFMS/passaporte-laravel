@extends('layout.base')

@section('title', 'Criar Novo Evento - Passaporte.io')

@section('content')
<div class="flex justify-center items-center min-h-[80vh] my-6">
    <div class="card bg-base-100 shadow-xl border border-base-200 w-full max-w-lg">
        <div class="card-body p-8">
            <h2 class="card-title text-2xl font-bold mb-6 justify-center text-primary">Cadastrar Novo Evento</h2>
            
            @if($errors->any())
                <div class="alert alert-error mb-4 shadow-sm">
                    <div>
                        <span class="font-bold">Erro:</span> {{ $errors->first('erro') }}
                    </div>
                </div>
            @endif

            <form action="{{ route('evento.salvar') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold">Título do Evento</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="Ex: Workshop de Laravel Avançado" class="input input-bordered w-full" required />
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold">Descrição Detalhada</span>
                    </label>
                    <textarea name="description" placeholder="Descreva os principais tópicos do evento..." class="textarea textarea-bordered w-full h-24" required>{{ old('description') }}</textarea>
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold">Data e Horário</span>
                    </label>
                    <input type="datetime-local" name="date_time" value="{{ old('date_time') }}" class="input input-bordered w-full" required />
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold">Local / Endereço</span>
                    </label>
                    <input type="text" name="location" value="{{ old('location') }}" placeholder="Ex: Auditório Principal ou Link do Zoom" class="input input-bordered w-full" required />
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold">Capacidade Máxima de Vagas</span>
                    </label>
                    <input type="number" name="capacity" value="{{ old('capacity') }}" placeholder="Ex: 100" class="input input-bordered w-full" min="1" required />
                </div>
                
                <div class="form-control w-full">
        <label class="label">
            <span class="label-text font-semibold">Banner Informativo (Imagem)</span>
        </label>
        <input type="file" name="banner" class="file-input file-input-bordered file-input-primary w-full" accept="image/*" />
        <label class="label">
            <span class="label-text-alt opacity-60">Formatos aceitos: JPG, PNG ou WEBP.</span>
        </label>
    </div>
                
                <div class="form-control mt-6">
        <button type="submit" class="btn btn-primary w-full text-base font-bold">
            Publicar Evento
        </button>
    </div>
</form>
            </form>
        </div>
    </div>
</div>
@endsection