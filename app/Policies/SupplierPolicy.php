<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Supplier;

class SupplierPolicy
{
    public function view(User $authUser, Supplier $supplier): bool
    {
        return $authUser->empresa_id === $supplier->empresa_id;
    }

    public function create(User $authUser): bool
    {
        return in_array($authUser->role, ['admin', 'gerente']);
    }

    public function update(User $authUser, Supplier $supplier): bool
    {
        return $authUser->empresa_id === $supplier->empresa_id;
    }

    public function delete(User $authUser, Supplier $supplier): bool
    {
        return $authUser->empresa_id === $supplier->empresa_id;
    }
}
