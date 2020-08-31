<?php

namespace App\Http\Controllers\Auth;

use App\Facades\Authy;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Authy\Exceptions\InvalidTokenException;
use App\Services\Authy\Exceptions\SmsRequestFailedException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthTokenController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    public function getToken(Request $request)
    {
        if (! $request->session()->has('authy')) {
            return redirect()->to('/');
        }

        return view('auth.token');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function postToken(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
        ]
        );

        try {
            $verification = Authy::verifyToken($request->token);
        } catch (InvalidTokenException $e) {
            return redirect()->back()->withErrors([
                'token' => 'Invalid token',
            ]
            );
        }

        if (Auth::loginUsingId(
            $request->session()->get('authy.user_id'),
            $request->session()->get('authy.remember')
        )) {
            $request->session()->forget('authy');

            return redirect()->intended();
        }

        return redirect()->url('/');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function getResend(Request $request)
    {
        $user = User::findOrFail($request->session()->get('authy.user_id'));

        if (! $user->hasSmsTwoFactorAuthenticationEnabled()) {
            return redirect()->back();
        }

        try {
            Authy::requestSms($user);
        } catch (SmsRequestFailedException $e) {
            return redirect()->back();
        }

        return redirect()->back();
    }
}
