@extends('layout.base')

@section('title', 'Criar Conta - Passaporte.io')

@section('content')
<div class="flex justify-center items-center min-h-[80vh]">
    <div class="card bg-base-100 shadow-xl border border-base-200 w-full max-w-md">
        <div class="card-body p-8">
            <h2 class="card-title text-2xl font-bold mb-6 justify-center text-primary">Criar Conta</h2>
            
            <form action="{{ route('usuario.salvar') }}" method="POST" class="space-y-4">
                @csrf

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold">Nome Completo</span>
                    </label>
                    <input type="text" name="name" placeholder="Ex: douglas silva" class="input input-bordered w-full" required />
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold">E-mail</span>
                    </label>
                    <input type="email" name="email" placeholder="seu@email.com" class="input input-bordered w-full" required />
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold">Senha</span>
                    </label>
                    <input type="password" name="password" placeholder="Mínimo 6 caracteres" class="input input-bordered w-full" required />
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold">Tipo de Conta</span>
                    </label>
                    <select name="role" class="select select-bordered w-full" required>
                        <option value="" disabled selected>Selecione o seu perfil...</option>
                        <option value="participante">Quero me inscrever em eventos (Participante)</option>
                        <option value="organizador">Quero criar e gerenciar eventos (Organizador)</option>
                    </select>
                </div>

                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary w-full text-base font-bold">
                        Cadastrar Conta
                    </button>
                </div>
            </form>

            <div class="text-center mt-4 text-sm opacity-70">
                Já tem uma conta? <a href="{{ route('login') }}" class="link link-primary font-semibold">Faça Login</a>
            </div>
        </div>
    </div>
</div>
@endsection