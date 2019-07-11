<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
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
     * Determine whether the user can view the use.
     *
     * @param User $user
     * @param $record
     *
     * @return boolean
     */
    public function index()
    {
        return true;
    }

    /**
     * Determine whether the user can view the use.
     *
     * @param User $user
     * @param $record
     *
     * @return boolean
     */
    public function view(User $user, $record)
    {
        if ($user->can('show-any-setting')) {
            return true;
        } elseif ($user->can('show-setting')) {
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
        if ($user->can('create-setting')) {
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
    public function update(User $user, $record)
    {
        if ($user->can('update-any-setting')) {
            return true;
        } elseif ($user->can('update-setting')) {
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
        if ($user->can('delete-any-setting')) {
            return true;
        } elseif ($user->can('delete-setting')) {
            return $user->id === $record->id;
        }
    }
}
