<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'index-admin']);
        Permission::create(['name' => 'index-dashboard']);
        Permission::create(['name' => 'anyData-dashboard']);

        Permission::create(['name' => 'index-user']);
        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'edit-user']);
        Permission::create(['name' => 'edit-any-user']);
        Permission::create(['name' => 'show-user']);
        Permission::create(['name' => 'show-any-user']);
        Permission::create(['name' => 'delete-user']);
        Permission::create(['name' => 'delete-any-user']);
        Permission::create(['name' => 'anyData-user']);
        Permission::create(['name' => 'update-user']);
        Permission::create(['name' => 'update-any-user']);
        Permission::create(['name' => 'publish-user']);
        Permission::create(['name' => 'unpublish-user']);

        Permission::create(['name' => 'index-impersonate']);
        Permission::create(['name' => 'impersonate-impersonate']);
        Permission::create(['name' => 'stop-impersonate']);

        //profile
        Permission::create(['name' => 'show-any-profile']);
        Permission::create(['name' => 'show-profile']);
        Permission::create(['name' => 'edit-profile']);
        Permission::create(['name' => 'edit-any-profile']);
        Permission::create(['name' => 'update-any-profile']);
        Permission::create(['name' => 'update-profile']);
        Permission::create(['name' => 'delete-profile']);
        Permission::create(['name' => 'delete-any-profile']);


        Permission::create(['name' => 'index-activity-log']);
        Permission::create(['name' => 'show-activity-log']);


        //role
        Permission::create(['name' => 'index-role']);
        Permission::create(['name' => 'create-role']);
        Permission::create(['name' => 'edit-role']);
        Permission::create(['name' => 'show-role']);
        Permission::create(['name' => 'delete-role']);
        Permission::create(['name' => 'update-role']);

        //permission
        Permission::create(['name' => 'index-permission']);
        Permission::create(['name' => 'create-permission']);
        Permission::create(['name' => 'edit-permission']);
        Permission::create(['name' => 'show-permission']);
        Permission::create(['name' => 'delete-permission']);
        Permission::create(['name' => 'update-permission']);


        Permission::create(['name' => 'manage-log']);

        Permission::create(['name' => 'manage-developer']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'writer']);
        $role->givePermissionTo('edit-user');

        // or may be done by chaining
        $role = Role::create(['name' => 'moderator'])
            ->givePermissionTo(['publish-user', 'unpublish-user']);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

        $user = User::find(1);
        $user->assignRole(['super-admin']);
    }
}
