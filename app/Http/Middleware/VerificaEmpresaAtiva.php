<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerificaEmpresaAtiva
{
    /**
     * Manipula a requisição.
     * Verifica se a empresa do usuário está ativa.
     */
    public function handle(Request $request, Closure $next)
    {
        // Exemplo de verificação simples
        $empresa = $request->user()->company ?? null;
        if ($empresa && !$empresa->ativa) {
            return response()->json(['mensagem' => 'Empresa inativa.'], 403);
        }
        return $next($request);
    }
}
