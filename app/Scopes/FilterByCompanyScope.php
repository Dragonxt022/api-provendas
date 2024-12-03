<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class FilterByCompanyScope implements Scope
{
    /**
     * Aplica o filtro de empresa em uma consulta de modelo.
     */
    public function apply(Builder $builder, Model $model)
    {
        if (auth()->check()) {
            $builder->where('empresa_id', auth()->user()->empresa_id);
        }
    }
}
