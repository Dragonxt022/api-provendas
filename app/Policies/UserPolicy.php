<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine se o usuário autenticado pode visualizar outro usuário.
     *
     * @param User $authUser O usuário autenticado
     * @param User $user O usuário a ser visualizado
     * @return bool
     */
    public function view(User $authUser, User $user): bool
    {
        return $authUser->empresa_id === $user->empresa_id;
    }

    /**
     * Determine se o usuário autenticado pode atualizar outro usuário.
     *
     * @param User $authUser O usuário autenticado
     * @param User $user O usuário a ser atualizado
     * @return bool
     */
    public function update(User $authUser, User $user): bool
    {
        return $authUser->empresa_id === $user->empresa_id;
    }

    /**
     * Determine se o usuário autenticado pode deletar outro usuário.
     *
     * @param User $authUser O usuário autenticado
     * @param User $user O usuário a ser deletado
     * @return bool
     */
    public function delete(User $authUser, User $user): bool
    {
        return $authUser->empresa_id === $user->empresa_id;
    }

    /**
     * Determine se o usuário autenticado pode criar novos usuários na mesma empresa.
     *
     * @param User $authUser O usuário autenticado
     * @return bool
     */
    public function create(User $authUser): bool
    {
        // Apenas administradores ou gerentes podem criar usuários
        return in_array($authUser->role, ['admin', 'gerente']);
    }
}
