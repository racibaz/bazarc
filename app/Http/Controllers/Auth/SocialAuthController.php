<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect($service) {
        return Socialite::driver($service)->redirect();
    }

    public function callback($service) {

        $serviceUser = Socialite::driver($service)->user();

        $user = $this->getExistingUser($serviceUser, $service);

        if (!$user) {
            $user = User::create([
                'name' => $serviceUser->getName(),
                'email' => $serviceUser->getEmail(),
                'status' => User::ACTIVE
            ]);
        }

        if ($this->needsToCreateSocial($user, $service)) {
            $user->social()->create([
                'social_id' => $serviceUser->getId(),
                'service' => $service,
            ]);
        }

        Auth::login($user, false);

        return redirect()->intended('home');
    }

    protected function needsToCreateSocial(User $user, $service)
    {
        return !$user->hasSocialLinked($service);
    }

    protected function getExistingUser($serviceUser, $service)
    {
        return User::where('email', $serviceUser->getEmail())->orWhereHas('social', function ($q) use ($serviceUser, $service) {
            $q->where('social_id', $serviceUser->getId())->where('service', $service);
        })->first();
    }
}
