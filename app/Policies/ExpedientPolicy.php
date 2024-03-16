<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Expedient;
use App\Models\User;

class ExpedientPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Expedient');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Expedient $expedient): bool
    {
        return $user->checkPermissionTo('view Expedient');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Expedient');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Expedient $expedient): bool
    {
        return $user->checkPermissionTo('update Expedient');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Expedient $expedient): bool
    {
        return $user->checkPermissionTo('delete Expedient');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Expedient $expedient): bool
    {
        return $user->checkPermissionTo('restore Expedient');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Expedient $expedient): bool
    {
        return $user->checkPermissionTo('force-delete Expedient');
    }
}
