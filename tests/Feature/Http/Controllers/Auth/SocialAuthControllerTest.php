<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Facades\Socialite;
use Mockery;
use Tests\TestCase;

class SocialAuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_authenticate_using_twitter ()
    {
        $abstractUser = Mockery::mock('Laravel\Socialite\Two\User');

        $abstractUser->shouldReceive('getId')
            ->andReturn(rand())
            ->shouldReceive('getEmail')
            ->andReturn('johnDoe@acme.com')
            ->shouldReceive('getName')
            ->andReturn('John Doe')
            ->shouldReceive('getAvatar')
            ->andReturn('https://en.gravatar.com/userimage');

        $provider = Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $provider->shouldReceive('user')->andReturn($abstractUser);

        Socialite::shouldReceive('driver')->andReturn($provider);

        $this->get('/callback/twitter')
            ->assertStatus(302);
    }


    /**
     * @test
     */
    public function can_authenticate_using_google ()
    {
        $abstractUser = Mockery::mock('Laravel\Socialite\Two\User');

        $abstractUser->shouldReceive('getId')
            ->andReturn(rand())
            ->shouldReceive('getEmail')
            ->andReturn('johnDoe@acme.com')
            ->shouldReceive('getName')
            ->andReturn('John Doe')
            ->shouldReceive('getAvatar')
            ->andReturn('https://en.gravatar.com/userimage');

        $provider = Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $provider->shouldReceive('user')->andReturn($abstractUser);

        Socialite::shouldReceive('driver')->andReturn($provider);

        $this->get('/callback/google')
            ->assertStatus(302);
    }

    /**
     * @test
     */
    public function can_authenticate_using_facebook ()
    {
        $abstractUser = Mockery::mock('Laravel\Socialite\Two\User');

        $abstractUser->shouldReceive('getId')
            ->andReturn(rand())
            ->shouldReceive('getEmail')
            ->andReturn('johnDoe@acme.com')
            ->shouldReceive('getName')
            ->andReturn('John Doe')
            ->shouldReceive('getAvatar')
            ->andReturn('https://en.gravatar.com/userimage');

        $provider = Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $provider->shouldReceive('user')->andReturn($abstractUser);

        Socialite::shouldReceive('driver')->andReturn($provider);

        $this->get('/callback/facebook')
            ->assertStatus(302);
    }

    /**
     * @test
     */
    public function can_authenticate_using_github ()
    {
        $abstractUser = Mockery::mock('Laravel\Socialite\Two\User');

        $abstractUser->shouldReceive('getId')
            ->andReturn(rand())
            ->shouldReceive('getEmail')
            ->andReturn('johnDoe@acme.com')
            ->shouldReceive('getName')
            ->andReturn('John Doe')
            ->shouldReceive('getAvatar')
            ->andReturn('https://en.gravatar.com/userimage');

        $provider = Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $provider->shouldReceive('user')->andReturn($abstractUser);

        Socialite::shouldReceive('driver')->andReturn($provider);

        $this->get('/callback/github')
            ->assertStatus(302);
    }
}
