<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Conexion;
use App\Models\User;

class ConexionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Conexion');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Conexion $conexion): bool
    {
        return $user->checkPermissionTo('view Conexion');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Conexion');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Conexion $conexion): bool
    {
        return $user->checkPermissionTo('update Conexion');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Conexion $conexion): bool
    {
        return $user->checkPermissionTo('delete Conexion');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Conexion $conexion): bool
    {
        return $user->checkPermissionTo('restore Conexion');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Conexion $conexion): bool
    {
        return $user->checkPermissionTo('force-delete Conexion');
    }
}
