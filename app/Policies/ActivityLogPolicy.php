<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityLogPolicy
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
     * Determine whether the user can index the use.
     *
     * @return boolean
     */
    public function index(): bool
    {
        if (auth()->user()->can('index-activity-log')) {
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
        if ($user->can('show-activity-log')) {
            return true;
        }
    }
}
