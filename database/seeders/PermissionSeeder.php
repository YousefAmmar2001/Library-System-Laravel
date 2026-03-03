<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //===========================Admin Permission ==========================//
        // Permission::create(['name' => 'Create-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Roles', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Role', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Permissions', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Permission', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Admins', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Admin', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-User', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Users', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-User', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-User', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Category', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Categories', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Category', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Category', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Book', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Books', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Book', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Book', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Restore-Book', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Country', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Countries', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Country', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Country', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Manage-Role-Permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Manage-User-Permission', 'guard_name' => 'admin']);

        //===========================User Permission ==========================//
        // Permission::create(['name' => 'Read-', 'guard_name' => 'user']);
        // Permission::create(['name' => 'Create-', 'guard_name' => 'user']);
        // Permission::create(['name' => 'Update-', 'guard_name' => 'user']);
        // Permission::create(['name' => 'Delete-', 'guard_name' => 'user']);

        Permission::create(['name' => 'Read-Categories', 'guard_name' => 'user']);
        Permission::create(['name' => 'Read-Books', 'guard_name' => 'user']);
        Permission::create(['name' => 'Read-Countries', 'guard_name' => 'user']);
    }
}
