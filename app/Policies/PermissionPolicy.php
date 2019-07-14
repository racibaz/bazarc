<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Determine whether the permission can view the use.
     *
     * @return boolean
     */
    public function index()
    {
        if (auth()->user()->can('index-permission')) {
            return true;
        }
    }

    /**
     * Determine whether the permission can view the use.
     *
     * @param \App\Models\User $user
     * @param $record
     *
     * @return boolean
     */
    public function view(User $user, $record)
    {
        if ($user->can('show-permission')) {
            return true;
        }
    }

    /**
     * Determine whether the permission can create uses.
     *
     * @param \App\Models\User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('create-permission')) {
            return true;
        }
    }

    /**
     * Determine whether the permission can update the use.
     *
     * @param \App\Models\User $user
     * @param $record
     *
     * @return boolean
     * @internal param \App\Models\Permission $use
     */
    public function update(User $user, $record)
    {
        if ($user->can('update-permission')) {
            return true;
        }
    }

    /**
     * Determine whether the permission can delete the use.
     *
     * @param Permission $permission
     * @param $record
     *
     * @return bool
     */
    public function delete(User $user, $record)
    {
        if ($user->can('delete-permission')) {
            return true;
        }
    }
}
