<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @test
     *
     * @return void
     */
    public function testItShouldSeeLoginPage()
    {
        $this->get(route('login'))
            ->assertStatus(200);
    }
}
