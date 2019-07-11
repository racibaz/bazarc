<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use Spatie\Permission\Models\Role;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => 'writer',
        'guard_name' => $faker->boolean == true ? 'web' : 'api',
    ];
});
