<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function non_authenticated_users_cannot_access_the_following_endpoints_for_the_product_api()
    {
        $index = $this->json('GET', '/api/v1/users');
        $index->assertStatus(401);

        $store = $this->json('POST', '/api/v1/users');
        $store->assertStatus(401);

        $show = $this->json('GET', '/api/v1/users/-1');
        $show->assertStatus(401);

        $update = $this->json('PUT', '/api/v1/users/-1');
        $update->assertStatus(401);

        $destroy = $this->json('DELETE', '/api/v1/users/-1');
        $destroy->assertStatus(401);
    }

    /**
     * A basic feature test example.
     *
     * @test
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @test
     * @return void
     */
    public function can_get_users_without_authenticated()
    {
        $response = $this->json('GET', '/api/v1/users/');

        $response->assertStatus(401)
            ->assertJsonStructure([
                'error' => "Unauthenticated.",
                'code' => 401
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function can_create_a_user()
    {
        $faker = Factory::create();

        $user = factory(User::class)->create([
            'two_factor_type' => 'off'
        ]
        );

        $response = $this->actingAs($user, 'api')->json('POST', '/api/users', [
                'name' => $name = $faker->company,
                'email' => $email = $faker->email,
                'slug' => Str::slug($name)
            ]
        );

        $response->assertJsonStructure([
            'id', 'name', 'slug', 'email', 'created_at'
        ]
        )
            ->assertJson([
                'name' => $name,
                'slug' => Str::slug($name),
                'email' => $email,
                'two_factor_type' => 'off'
            ]
            )
            ->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'name' => $name,
            'slug' => Str::slug($name),
            'email' => $email
        ]
        );
    }

}
