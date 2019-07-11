<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * todo you should continue:)
     * User register.
     *
     * @return void
     */
    public function test_user_register_while_get_the_role ()
    {
        Session::start();

        $user = [
            'name' => 'test',
            'email' => 'test@hotmail.com',
            'password' => 12345,
            'remember_token' => Str::random(10),
            'slug' => Str::slug('test'),
            'status' => 1,
            'password_confirmation' => 12345,
            '_token' => csrf_token()
        ];

        $response = $this->post('/register/', $user);

        $this->assertTrue($response->isRedirect());
    }
}
