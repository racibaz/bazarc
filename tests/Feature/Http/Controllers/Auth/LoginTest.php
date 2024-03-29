<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @test
     *
     * @return void
     */
    public function it_should_see_login_page ()
    {
        $this->get(route('login'))
            ->assertStatus(200);
    }

    /**
     * A basic test example.
     *
     * @test
     *
     * @return void
     */
    public function a_user_login_to_ ()
    {
        $this->get(route('login'))
            ->assertStatus(200);
    }

}
