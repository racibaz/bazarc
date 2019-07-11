<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Activitylog\Models\Activity;
use Tests\TestCase;

class ActivityLogControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @uses  Activity Logs enpoints have two methods index and show.
     *
     * @test
     */
    public function non_authenticated_users_cannot_access_the_following_endpoints_for_the_activity_log_api ()
    {
        $index = $this->json('GET', '/api/v1/activity_logs');
        $index->assertStatus(401);

        $show = $this->json('GET', '/api/v1/activity_logs/-1');
        $show->assertStatus(401);
    }

    /**
     * @test
     * @return void
     */
    public function can_get_activity_logs_without_authenticated ()
    {
        $response = $this->json('GET', 'api/v1/activity_logs');

//        $this->expectOutputString('Unauthenticated');

        $response
//            ->assertJsonStructure(['error', 'code'])
//            ->assertJson([
//                'error' => "Unauthenticated.",
//                'code' => 401
//            ])
            ->assertStatus(401);
    }

    /**
     * @test
     */
    public function can_return_a_collection_of_paginated_activity_logs ()
    {

        $user = factory(User::class)->create();

        $activity_log1 = factory(ActivityLog::class)->create();
        $activity_log2 = factory(ActivityLog::class)->create();
        $activity_log3 = factory(ActivityLog::class)->create();


        $response = $this->actingAs($user, 'api')->json('GET', '/api/v1/activity_logs');


        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                            'log_name',
                            'description',
                            'subject_id',
                            'subject_type',
                            'causer_id',
                            'causer_type',
                            'properties',
                            'links' =>
                                ['*' => [
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
}
