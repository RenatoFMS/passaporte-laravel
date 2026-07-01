<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckOrganizador
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('usuario_id') || session('usuario_role') !== 'organizador') {
            return redirect()->route('home')->withErrors(['erro' => 'Acesso restrito apenas para organizadores.']);
        }

        return $next($request);
    }
}