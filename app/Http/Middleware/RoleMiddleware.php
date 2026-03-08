<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

    // Usamos !! para convertir cualquier valor (1, true, "1") a booleano
    if ($request->user() && $request->user()->is_admin) {
        return $next($request);
    }

    return redirect('/')->with('error', 'Acceso denegado: No eres administrador.');
    }
}