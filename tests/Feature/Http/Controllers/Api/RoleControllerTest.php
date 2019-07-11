<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_return_a_collection_of_paginated_users ()
    {
        $user = factory(User::class)->create();
        $role1 = factory(Role::class)->create();

        $response = $this->actingAs($user, 'api')->json('GET', '/api/v1/roles');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'guard_name',
                            'links' =>
                                ['*' =>
                                     [
                                         'rel', 'href'
                                     ]
                                ]
                    ]
                ],
                'meta' => [
                    'pagination' => [
                        'total', 'count',
                        'per_page',
                        'current_page',
                        'total_pages',
                        'links' => ['next']
                    ]
                ]
            ]);
    }

    /**
     * @test
     * @return void
     */
    public function can_create_a_role()
    {
        $faker = Factory::create();

        $user = factory(User::class)->create();

        $response = $this->actingAs($user, 'api')
            ->json('POST', 'api/v1/roles', [
                'name' => $name = $faker->name,
                'guard_name' => $guardName = $faker->boolean == true ? 'web' : 'api',
            ]);

        $response->assertJsonStructure([
            'id', 'name', 'guard_name', 'created_at'
        ])->assertJson([
            'name' => $name,
            'guard_name' => $guardName
        ])->assertStatus(201);

        $this->assertDatabaseHas('roles', [
            'name' => $name,
            'guard_name' => $guardName
        ]);
    }
}
