<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Permission;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermissionControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @todo we remove 'links' => ['next'] in "meta" field
     *
     * @test
     */
    public function can_return_a_collection_of_paginated_permissions()
    {
        $user = factory(User::class)->create();
        $permission1 = factory(Permission::class)->create();

        $response = $this->actingAs($user, 'api')->json('GET', '/api/v1/permissions');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'guard_name',
                        'links' => [
                                '*' => [
                                        'rel',
                                        'href',
                                    ],
                            ],
                    ],
                ],
                'meta' => [
                    'pagination' => [
                        'total',
                        'count',
                        'per_page',
                        'current_page',
                        'total_pages',
                    ],
                ],
            ]
            );
    }

    /**
     * @test
     * @return void
     */
    public function can_create_a_permission()
    {
        $faker = Factory::create();

        $user = factory(User::class)->create();

        $response = $this->actingAs($user, 'api')
            ->json('POST', 'api/v1/permissions', [
                'name' => $name = $faker->name,
                'guard_name' => $guardName = $faker->boolean == true ? 'web' : 'api',
            ]
            );

        $response->assertJsonStructure([
            'id',
            'name',
            'guard_name',
            'created_at',
        ]
        )->assertJson([
            'name' => $name,
            'guard_name' => $guardName,
        ]
        )->assertStatus(201);

        $this->assertDatabaseHas('permissions', [
            'name' => $name,
            'guard_name' => $guardName,
        ]
        );
    }

    /**
     * @test
     * @return void
     */
    public function can_delete_a_permission()
    {
        $faker = Factory::create();

//        $role = factory(\App\Models\Role::class)->create([
//            'name' => 'role1',
//            'guard_name' => 'web'
//        ]);

        $user = factory(User::class)->create();

        $response = $this->actingAs($user, 'api')
            ->json('POST', 'api/v1/permissions', [
                'name' => 'permissions2',
                'guard_name' => 'web',
            ]
            );

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', 'api/v1/permissions/', [
                'id' => 2,
            ]
            );

//        $this->assertDatabaseMissing('roles', [
//            'name' => $name,
//            'guard_name' => $guardName
//        ]);
    }
}
