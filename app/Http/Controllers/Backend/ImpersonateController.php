<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpersonateController extends BackendBaseController
{
    /**
     * We have used except parameter so basic users should be use stop
     * function without permission.
     *
     * ImpersonateController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['stop']]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return  view('backend.impersonate.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function impersonate(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();

        session()->put('impersonate_by', auth()->id());

        Auth::login($user);

        return redirect(route('dashboard'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function stop()
    {
        Auth::loginUsingId(session('impersonate_by'));

        session()->forget('impersonate_by');

        return redirect(route('home'));
    }
}
