<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Borrow;
use App\Models\User;

class BorrowPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Borrow');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Borrow $borrow): bool
    {
        return $user->checkPermissionTo('view Borrow');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Borrow');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Borrow $borrow): bool
    {
        return $user->checkPermissionTo('update Borrow');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Borrow $borrow): bool
    {
        return $user->checkPermissionTo('delete Borrow');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Borrow $borrow): bool
    {
        return $user->checkPermissionTo('restore Borrow');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Borrow $borrow): bool
    {
        return $user->checkPermissionTo('force-delete Borrow');
    }
}
