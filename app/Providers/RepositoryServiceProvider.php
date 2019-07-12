<?php

namespace App\Providers;

use App\Contracts\Repositories\ActivityLogRepository;
use App\Contracts\Repositories\PermissionRepository;
use App\Contracts\Repositories\ProfileRepository;
use App\Contracts\Repositories\RoleRepository;
use App\Contracts\Repositories\SettingRepository;
use App\Contracts\Repositories\UserRepository;
use App\Repositories\Eloquent\ActivityLogRepositoryEloquent;
use App\Repositories\Eloquent\PermissionRepositoryEloquent;
use App\Repositories\Eloquent\ProfileRepositoryEloquent;
use App\Repositories\Eloquent\RoleRepositoryEloquent;
use App\Repositories\Eloquent\SettingRepositoryEloquent;
use App\Repositories\Eloquent\UserRepositoryEloquent;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(UserRepository::class, UserRepositoryEloquent::class);
        App::bind(ProfileRepository::class, ProfileRepositoryEloquent::class);
        App::bind(SettingRepository::class, SettingRepositoryEloquent::class);
        App::bind(ActivityLogRepository::class, ActivityLogRepositoryEloquent::class);
        App::bind(RoleRepository::class, RoleRepositoryEloquent::class);
        App::bind(PermissionRepository::class, PermissionRepositoryEloquent::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
