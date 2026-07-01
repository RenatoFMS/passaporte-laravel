@extends('layout.base')

@section('title', 'Login')

@section('content')
<div class="card bg-base-100 shadow-xl border border-base-200">
    <div class="card-body">
        <h2 class="card-title text-2xl font-bold mb-4 justify-center">Entrar no Sistema</h2>
        
        <form action="/logar" method="POST" class="space-y-4">
            @csrf
            
            <div class="form-control">
                <label class="label" for="email">
                    <span class="label-text font-semibold">Email</span>
                </label>
                <input type="email" id="email" name="email" placeholder="seu-email@site.com" required 
                       class="input input-bordered w-full" />
            </div>

            <div class="form-control">
                <label class="label" for="senha">
                    <span class="label-text font-semibold">Senha</span>
                </label>
                <input type="password" id="senha" name="senha" placeholder="Sua senha" required 
                       class="input input-bordered w-full" />
                
                @if($errors->has('login_erro'))
                    <p class="text-error text-xs font-semibold mt-2">
                        {{ $errors->first('login_erro') }}
                    </p>
                @endif
            </div>

            <div class="form-control mt-6">
                <button type="submit" class="btn btn-primary w-full text-lg">Entrar</button>
            </div>
        </form>

        <div class="text-center mt-4 text-sm">
            <span>Não tem uma conta? </span>
            <a href="{{ route('home') }}" class="link link-primary font-semibold">Cadastre-se</a>
        </div>
    </div>
</div>
@endsection