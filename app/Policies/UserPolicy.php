<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can view the use.
     *
     * @param User $user
     * @param $record
     *
     * @return bool
     */
    public function index()
    {
        if (auth()->user()->can('index-user')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the use.
     *
     * @param User $user
     * @param $record
     *
     * @return bool
     */
    public function view(User $user, $record)
    {
        if ($user->can('show-any-user')) {
            return true;
        } elseif ($user->can('show-user')) {
            return $user->id === $record->id;
        }
    }

    /**
     * Determine whether the user can create uses.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('create-user')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the use.
     *
     * @param User $user
     * @param $record
     *
     * @return bool
     * @internal param \App\Models\User $use
     */
    public function update(User $user, $record)
    {
        if ($user->can('update-any-user')) {
            return true;
        } elseif ($user->can('update-user')) {
            return $user->id === $record->id;
        }
    }

    /**
     * Determine whether the user can delete the use.
     *
     * @param User $user
     * @param $record
     *
     * @return bool
     */
    public function delete(User $user, $record)
    {
        if ($user->can('delete-any-user')) {
            return true;
        } elseif ($user->can('delete-user')) {
            return $user->id === $record->id;
        }
    }
}
