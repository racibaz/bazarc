<?php

namespace App\Listeners\Users;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Carbon;
use function request;

class LogSuccessfulLogout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(Login $event)
    {
        $event->user->last_login = Carbon::now();
        $event->user->IP = request()->getClientIp();
        $event->user->save();
    }
}
