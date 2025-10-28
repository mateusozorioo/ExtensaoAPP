<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se o usuário está autenticado
        if (!Auth::check()) {
            // Se não estiver logado, redireciona para a página de login
            return redirect()->route('login')->with('error', 'Você precisa estar logado para acessar esta página.');
        }

        return $next($request);
    }
}