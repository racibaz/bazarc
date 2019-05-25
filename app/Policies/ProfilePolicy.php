<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
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
     * Determine whether the user can view the use.
     *
     * @param  \App\Models\User $user
     * @param $record
     *
     * @return boolean
     */
    public function view(User $user, $record)
    {
        if ($user->can('show-any-profile')) {
            return true;
        }elseif ($user->can('show-profile')) {
            return $user->id === $record->id;
        }
    }


    /**
     * Determine whether the user can update the use.
     *
     * @param  \App\Models\User $user
     * @param $record
     *
     * @return boolean
     * @internal param \App\Models\User $use
     */
    public function update(User $user, $record)
    {
        if ($user->can('update-any-profile')) {
            return true;
        }elseif ($user->can('update-profile')) {
            return $user->id === $record->id;
        }
    }

    /**
     * Determine whether the user can delete the use.
     *
     * @param  \App\Models\User $user
     * @param $record
     *
     * @return bool
     */
    public function delete(User $user, $record)
    {
        if ($user->can('delete-any-profile')) {
            return true;
        }elseif ($user->can('delete-profile')) {
            return $user->id === $record->id;
        }
    }
}