<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario está autenticado y si el rol coincide
        if (Auth::check() && Auth::user()->admin) {
            return $next($request);

        }

        // Si no es admin, redirige o devuelve un error
        return response()->json(['error' => 'Unauthorized'], 403);


    }
}
