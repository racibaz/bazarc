<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassportAuthController extends ApiController
{
    public function store(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $token = User::where('email', $request->email)->first()->createToken($request->email)->accessToken;

            return response()->json(['token' => $token], 201);
        }
    }
}
