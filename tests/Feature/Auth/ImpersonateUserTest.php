<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImpersonateUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function non_admin_user_cannot_access_impersonate_page()
    {
        $this->withExceptionHandling();

        $this->get(route('impersonate'))
            ->assertRedirect('/login');

        $user = factory(User::class)->create();

        $this->actingAs($user);

        $this->get(route('impersonate'))
            ->assertStatus(302);
    }

    /** @test **/
    public function non_admin_user_cannot_impersonate_a_user()
    {
        $this->withExceptionHandling();

        $this->post(route('impersonate'))
            ->assertRedirect('/login');

        $user = factory(User::class)->create();

        $this->actingAs($user);

        $this->post(route('impersonate'))
            ->assertStatus(302); //also it should be 403
    }

    /** @test **/
    public function admin_can_impersonate_a_user()
    {
        $admin = factory(User::class)->create();
        $admin->assignRole('super-admin');

        $user = factory(User::class)->create();

        $this->actingAs($admin);

        $this->post(route('impersonate', ['email' => $user->email]));

        $this->assertEquals(auth()->id(), $user->id);
    }

    /** @test **/
    public function user_can_stop_impersonating()
    {
        $admin = factory(User::class)->create();
        $admin->assignRole('super-admin');

        $user = factory(User::class)->create();

        $this->actingAs($admin);

        $this->post(route('impersonate', ['email' => $user->email]));

        $this->assertEquals(auth()->id(), $user->id);

        $this->delete(route('impersonate'));

        $this->assertEquals(auth()->id(), $admin->id);
    }
}
