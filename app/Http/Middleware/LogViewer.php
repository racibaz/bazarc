<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LogViewer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->can('manage-log')) {
            return $next($request);
        }

        //Log::warning('Unauthorized log index page request. uri :' . Route::getCurrentRoute()->uri() . ' : user_id : ' . auth()->user()->getAuthIdentifier() . '  IP :' . auth()->user()->getUserIp());
        return redirect('/login');
    }
}
