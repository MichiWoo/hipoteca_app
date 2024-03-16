<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Observation;
use App\Models\User;

class ObservationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Observation');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Observation $observation): bool
    {
        return $user->checkPermissionTo('view Observation');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Observation');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Observation $observation): bool
    {
        return $user->checkPermissionTo('update Observation');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Observation $observation): bool
    {
        return $user->checkPermissionTo('delete Observation');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Observation $observation): bool
    {
        return $user->checkPermissionTo('restore Observation');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Observation $observation): bool
    {
        return $user->checkPermissionTo('force-delete Observation');
    }
}
