<?php

namespace App\Policies;

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
     * Determine whether the user can view the use.
     *
     * @return boolean
     */
    public function index()
    {
        if (auth()->user()->can('index-role')) {
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
    public function view(User $user, $record)
    {
        if ($user->can('show-role')) {
            return true;
        }
    }
}
