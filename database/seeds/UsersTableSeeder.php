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
            'cell_phone' => '5415859867',
            'web_site' => 'http://www.bazsoft.biz',
            'gender' => 1,
            'bio_note' => 'Bio text',
            'status' => 1,
        ]);

        $user->save();

        factory(User::class, 250)->create();
    }
}
