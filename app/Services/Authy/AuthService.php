<?php
/**
 * Created by PhpStorm.
 * User: muhammed.cansiz
 * Date: 27-May-19
 * Time: 9:48 AM.
 */

namespace App\Services\Authy;

use App\Models\User;
use App\Services\Authy\Exceptions\InvalidTokenException;
use App\Services\Authy\Exceptions\RegistrationFailedException;
use App\Services\Authy\Exceptions\SmsRequestFailedException;
use Authy\AuthyApi;
use Authy\AuthyFormatException;

class AuthService
{
    private $client;

    public function __construct(AuthyApi $client)
    {
        $this->client = $client;
    }

    public function registerUser(User $user)
    {
        $user = $this->client->registerUser(
            $user->email,
            $user->phoneNumber->phone_number,
            $user->phoneNumber->diallingCode->dialling_code
        );

        if (! $user->ok()) {
            new RegistrationFailedException;
        }

        return $user->id();
    }

    public function verifyToken($token, User $user = null)
    {
        try {
            $verification = $this->client->verifyToken(
                $user ? $user->authy_id : request()->session()->get('authy.authy_id'),
                $token
            );
        } catch (AuthyFormatException $e) {
            new InvalidTokenException;
        }

        if (! $verification->ok()) {
            new InvalidTokenException;
        }

        return true;
    }

    public function requestSms(User $user)
    {
        $request = $this->client->requestSms($user->authy_id, [
            'force' => true,
        ]);

        if (! $request->ok()) {
            new SmsRequestFailedException;
        }
    }
}
