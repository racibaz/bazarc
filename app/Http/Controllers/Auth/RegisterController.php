<?php

namespace App\Http\Controllers\Auth;

use App\Models\Setting;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $userDefaultStatus = Setting::where('attribute_key', 'user_default_status')->first();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => (int) $userDefaultStatus->attribute_value
        ]);

        $userDefaultRole = Setting::where('attribute_key','user_default_role')->first();
        $user->assignRole([$userDefaultRole->attribute_value]); //writer

        return $user;
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $userDefaultRegistrationType = Setting::where('attribute_key', 'registration_type')->first();

        switch ($userDefaultRegistrationType->attribute_value) {    // 1

            case Setting::$registrationTypes['public']['number']:   // 1
                return redirect('/login');
                break;
            case Setting::$registrationTypes['private']['number']:
                Auth::logout();
                return redirect()->back()->withErrors(trans('setting.user_registration_type.private'));
                break;
            case Setting::$registrationTypes['verified']['number']:
                Auth::logout();
                return redirect()->back()->withErrors(trans('setting.user_registration_type.verified'));
                break;
            case Setting::$registrationTypes['none']['number']:
                Auth::logout();
                return redirect()->back()->withErrors(trans('setting.user_registration_type.none'));
                break;
        }

        // todo give a log
    }
}
