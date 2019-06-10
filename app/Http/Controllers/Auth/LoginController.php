<?php

namespace App\Http\Controllers\Auth;

use App\Facades\Authy;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Authy\Exceptions\SmsRequestFailedException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Where to redirect users for
     *
     * @var string
     */
    protected $redirectToToken = '/auth/token';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();

        // $user->token;

        $user->getId();
        $user->getNickname();
        $user->getName();
        $user->getEmail();
        $user->getAvatar();


    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $user
     * @return mixed
     */
    protected function authenticated(Request $request, User $user)
    {

        if ($user->hasTwoFactorAuthenticationEnabled()) {
            return $this->logoutAndRedirectToTokenEntry($request, $user);
        }

        return redirect()->intended($this->redirectPath());
    }

    protected function logoutAndRedirectToTokenEntry(Request $request, User $user)
    {
        //todo  must be dynamic
        //Auth::guard($this->getGuard())->logout();
        Auth::guard('web')->logout();

        $request->session()->put('authy', [
            'user_id' => $user->id,
            'authy_id' => $user->authy_id,
            'using_sms' => false,
            'remember' => $request->has('remember'),
        ]);

        if ($user->hasSmsTwoFactorAuthenticationEnabled()) {
            try {
                Authy::requestSms($user);
            } catch (SmsRequestFailedException $e) {
                return redirect()->back();
            }

            $request->session()->push('authy.using_sms', true);
        }

        return redirect($this->redirectTokenPath());
    }

    protected function redirectTokenPath()
    {
        return $this->redirectToToken;
    }
}
