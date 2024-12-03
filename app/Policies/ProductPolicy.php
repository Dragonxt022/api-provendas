<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;

class ProductPolicy
{
    public function view(User $authUser, Product $product): bool
    {
        return $authUser->empresa_id === $product->empresa_id;
    }

    public function create(User $authUser): bool
    {
        return in_array($authUser->role, ['admin', 'gerente']);
    }

    public function update(User $authUser, Product $product): bool
    {
        return $authUser->empresa_id === $product->empresa_id;
    }

    public function delete(User $authUser, Product $product): bool
    {
        return $authUser->empresa_id === $product->empresa_id;
    }
}
