<?php


use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        //'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'password' => bcrypt(12345),
        'remember_token' => Str::random(10),
        'slug' => Str::slug($name),
        'cell_phone' => $faker->phoneNumber,
        //..
        'web_site' => 'http://www.' . $faker->domainName,
        'gender' => $faker->boolean,
        'bio_note' => $faker->realText(rand(10,20)),
        'IP' => $faker->ipv4,
        'last_login' => now(),
        'previous_visit' => now(),
        'status' => rand(0,3)
    ];
});
