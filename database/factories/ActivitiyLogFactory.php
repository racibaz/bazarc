<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\ActivityLog;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(ActivityLog::class, function (Faker $faker) {
    return [
        'log_name' => 'default',
        'description' => 'created',
        'subject_id' => factory(User::class)->create()->id,
        'subject_type' => User::class,
        'causer_id' => null,
        'causer_type' => null,
        'properties' => null,
    ];
});
