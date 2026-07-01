<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Passaporte.io') }} - @yield('title')</title>
    

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-base-300 text-base-content min-h-screen flex flex-col">


    <nav class="navbar bg-base-100 border-b border-base-200 px-8 justify-between">
    <div>
        <a href="{{ route('home') }}" class="text-2xl font-black tracking-tight text-primary">
            Passaporte.io
        </a>
    </div>

    <div>
        @if(session('usuario_id'))
            <div class="flex items-center gap-4">
                <span class="text-sm opacity-80">Olá, {{ session('usuario_nome') }}</span>
                
                @if(session('usuario_role') === 'organizador')
                    <a href="{{ route('evento.meus') }}" class="btn btn-ghost btn-sm text-secondary font-bold">
                         Meus Eventos
                    </a>
                @endif

                @if(session('usuario_role') === 'participante')
                    <a href="{{ route('inscricao.meus') }}" class="btn btn-ghost btn-sm text-primary font-bold">
                         Meus Ingressos
                    </a>
                @endif

                <a href="{{ route('logout') }}" class="btn btn-error btn-outline btn-sm">Sair</a>
            </div>
        @else
            <div class="flex items-center gap-2">
                <a href="{{ route('login') }}" class="btn btn-ghost btn-sm font-semibold">
                     Entrar
                </a>
                <a href="{{ route('usuario.cadastro') }}" class="btn btn-primary btn-sm shadow-md">
     Cadastrar-se
</a>
            </div>
        @endif
    </div>
</nav>
    </header>

    <main class="flex-grow flex items-center justify-center p-4 md:p-8">
            @yield('content')
    </main>

    <footer class="footer footer-center p-4 bg-base-100 text-base-content border-t border-base-200">
        <aside>
            <p>Copyright © 2026 - Todos os direitos reservados por Passaporte.io</p>
        </aside>
    </footer>

</body>
</html>