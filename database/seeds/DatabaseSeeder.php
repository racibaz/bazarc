<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SettingTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RoleAndPermissionSeeder::class);
        $this->call(DiallingCodesSeeder::class);
        $this->call(ActivityLogSeeder::class);
    }
}
