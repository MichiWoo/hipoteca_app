<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Formulario;
use App\Models\User;

class FormularioPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Formulario');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Formulario $formulario): bool
    {
        return $user->checkPermissionTo('view Formulario');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Formulario');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Formulario $formulario): bool
    {
        return $user->checkPermissionTo('update Formulario');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Formulario $formulario): bool
    {
        return $user->checkPermissionTo('delete Formulario');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Formulario $formulario): bool
    {
        return $user->checkPermissionTo('restore Formulario');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Formulario $formulario): bool
    {
        return $user->checkPermissionTo('force-delete Formulario');
    }
}
