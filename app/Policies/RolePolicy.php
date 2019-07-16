<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the role can index the use.
     *
     * @return boolean
     */
    public function index(): bool
    {
        if (auth()->user()->can('index-role')) {
            return true;
        }
    }

    /**
     * Determine whether the role can view the use.
     *
     * @param \App\Models\User $user
     * @param $record
     *
     * @return boolean
     */
    public function view(User $user, $record): bool
    {
        if ($user->can('show-role')) {
            return true;
        }
    }

    /**
     * Determine whether the role can create uses.
     *
     * @param \App\Models\User $user
     *
     * @return mixed
     */
    public function create(User $user): bool
    {
        if ($user->can('create-role')) {
            return true;
        }
    }

    /**
     * Determine whether the role can update the use.
     *
     * @param \App\Models\User $user
     * @param $record
     *
     * @return boolean
     * @internal param \App\Models\Role $use
     */
    public function update(User $user, $record): bool
    {
        if ($user->can('update-role')) {
            return true;
        }
    }

    /**
     * Determine whether the role can delete the use.
     *
     * @param Role $role
     * @param $record
     *
     * @return bool
     */
    public function delete(User $user, $record): bool
    {
        if ($user->can('delete-role')) {
            return true;
        }
    }
}
