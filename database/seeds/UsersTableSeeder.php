<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();

        $user->fill([
            'name' => 'admin',
            'email' => 'r.c67@hotmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt(12345),
            'remember_token' => Str::random(10),
            'slug' => Str::slug('admin'),
            'cell_phone' => '1234567890',
            'web_site' => 'bazsoft.biz',
            'gender' => 1,
            'bio_note' => 'Bio text'
        ]);

        $user->save();

        factory(\App\User::class, 50)->create();
    }
}
