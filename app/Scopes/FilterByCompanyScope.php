<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class FilterByCompanyScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        // Defina a lógica de escopo aqui, por exemplo, filtrar por empresa
        $builder->where('empresa_id', auth()->user()->empresa_id);
    }
}
