<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
     * Determine whether the user can view the use.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\User $use
     * @return mixed
     */
    public function view(User $user, User $use)
    {
        if ($use->published) {
            return true;
        }
        // visitors cannot view unpublished items
        if ($user === null) {
            return false;
        }
        // admin overrides published status
        if ($user->can('view unpublished uses')) {
            return true;
        }
        // authors can view their own unpublished uses
        return $user->id === $use->user_id;
    }
    /**
     * Determine whether the user can create uses.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('create uses')) {
            return true;
        }
    }
    /**
     * Determine whether the user can update the use.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\User $use
     * @return mixed
     */
    public function update(User $user, User $use)
    {
        if ($user->can('edit own uses')) {
            return $user->id === $use->user_id;
        }
        if ($user->can('edit all uses')) {
            return true;
        }
    }
    /**
     * Determine whether the user can delete the use.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\User $use
     * @return mixed
     */
    public function delete(User $user, User $use)
    {
        if ($user->can('delete own uses')) {
            return $user->id === $use->user_id;
        }
        if ($user->can('delete any use')) {
            return true;
        }
    }
}
