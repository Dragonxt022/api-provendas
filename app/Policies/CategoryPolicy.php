<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;

class CategoryPolicy
{
    public function view(User $authUser, Category $category): bool
    {
        return $authUser->empresa_id === $category->empresa_id;
    }

    public function create(User $authUser): bool
    {
        return in_array($authUser->role, ['admin', 'gerente']);
    }

    public function update(User $authUser, Category $category): bool
    {
        return $authUser->empresa_id === $category->empresa_id;
    }

    public function delete(User $authUser, Category $category): bool
    {
        return $authUser->empresa_id === $category->empresa_id;
    }
}
