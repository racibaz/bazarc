<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

//        'Illuminate\Auth\Events\Registered' => [
//            'App\Listeners\Users\LogRegisteredUser',
//        ],
//
//        'Illuminate\Auth\Events\Attempting' => [
//            'App\Listeners\Users\LogAuthenticationAttempt',
//        ],
//
//        'Illuminate\Auth\Events\Authenticated' => [
//            'App\Listeners\Users\LogAuthenticated',
//        ],

        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\Users\LogSuccessfulLogin',
        ],

//        'Illuminate\Auth\Events\Failed' => [
//            'App\Listeners\Users\LogFailedLogin',
//        ],
//
//        'Illuminate\Auth\Events\Logout' => [
//            'App\Listeners\Users\LogSuccessfulLogout',
//        ],
//
//        'Illuminate\Auth\Events\Lockout' => [
//            'App\Listeners\Users\LogLockout',
//        ],
//
//        'Illuminate\Auth\Events\PasswordReset' => [
//            'App\Listeners\Users\LogPasswordReset',
//        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
