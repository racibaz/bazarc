<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->can('index-admin')) {
            return $next($request);
        }

        $userId = Auth::check() ? \auth()->user()->getAuthIdentifier() : '';
        //Log::warning('Unauthorized request. uri :' . Route::getCurrentRoute()->uri() . ' : user_id : ' . $userId . '  IP :' . $request->ip());
        return redirect('/login');
    }
}
