<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use phpDocumentor\Reflection\Types\Boolean;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can index the use.
     *
     * @return bool
     */
    public function index(): bool
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
     * @return boolean
     */
    public function view(User $user, $record): bool
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
    public function create(User $user): bool
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
     * @return boolean
     * @internal param \App\Models\User $use
     */
    public function update(User $user, $record): bool
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
    public function delete(User $user, $record): bool
    {
        if ($user->can('delete-any-user')) {
            return true;
        } elseif ($user->can('delete-user')) {
            return $user->id === $record->id;
        }
    }
}
