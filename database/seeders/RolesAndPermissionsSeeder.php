<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions
        $permissions = [
            'edit_users',
            'view_users',
            'import_awbs',
            'export_awbs',
            'edit_awbs',
            'view_awbs',
            'edit_driver',
            'view_driver',
            
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $superadminRole = Role::create(['name' => 'superadmin']);
        $superadminRole->givePermissionTo(Permission::all());

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'edit_users',
            'view_users',
            'import_awbs',
            'edit_awbs',
            'view_awbs',
            'edit_driver',
            'view_driver'
        ]);

        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo([
            'view_users',
            'view_awbs'
            // Add other permissions for user role if needed
        ]);
    }
}
