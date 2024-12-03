<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FilterByCompany
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Obtenha a empresa do usuário autenticado
        $empresaId = auth()->user()->empresa_id;

        // Defina o escopo global de filtragem para os modelos
        \Illuminate\Database\Eloquent\Builder::macro('byCompany', function () use ($empresaId) {
            return $this->where('empresa_id', $empresaId);
        });

        return $next($request);
    }
}

