<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerificaTipoAdmin
{
    /**
     * Manipula a requisição.
     * Verifica se o usuário é do tipo administrador.
     */
    public function handle(Request $request, Closure $next)
    {
        $usuario = $request->user();
        if ($usuario && $usuario->type !== 'admin') {
            return response()->json(['mensagem' => 'Acesso permitido apenas para administradores.'], 403);
        }
        return $next($request);
    }
}
