<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateDoador
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('doador')->check()) {
            return redirect()->route('login.doador')
                ->with('erro', 'Você precisa estar logado para acessar esta página.');
        }

        return $next($request);
    }
}
