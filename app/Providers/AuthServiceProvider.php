<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * O mapeamento de políticas para os modelos do aplicativo.
     *
     * @var array
     */
    protected $policies = [
        \App\Models\User::class => \App\Policies\UserPolicy::class,
        \App\Models\Category::class => \App\Policies\CategoryPolicy::class,
        \App\Models\Product::class => \App\Policies\ProductPolicy::class,
        \App\Models\Supplier::class => \App\Policies\SupplierPolicy::class,
    ];

    /**
     * Registra quaisquer serviços de autenticação ou autorização.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Outras definições de autorização podem ser registradas aqui, se necessário.
    }
}
