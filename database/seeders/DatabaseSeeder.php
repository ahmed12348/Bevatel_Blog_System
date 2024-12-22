<?php

// database/seeders/DatabaseSeeder.php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    private $permissions = [
        // Blog-related permissions
        'create_blog',
        'edit_blog',
        'delete_blog',
        'view_blog',
        'export_blog',
        'import_blog',
        // User-related permissions
        'role-list',
        'role-create',
        'role-edit',
        'role-delete',
        'edit_users',
        'view_users',
        'create_users',
        'delete_users',
    ];

    public function run()
    {
        // Create permissions
        foreach ($this->permissions as $permission) {
            if (Permission::where('name', $permission)->doesntExist()) {
                Permission::create(['name' => $permission]);
            }
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $authorRole = Role::firstOrCreate(['name' => 'author']);

        // Assign all permissions to admin
        $adminRole->givePermissionTo(Permission::all());

        // Assign specific permissions to author
        $authorRole->givePermissionTo([
            'create_blog',
            'edit_blog',
            'delete_blog',
            'view_blog',
            'export_blog',
            'import_blog',
        ]);

        // Create one admin user and assign the admin role
        $adminUser = User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('1234'),
            ]
        );
        $adminUser->assignRole([$adminRole->id]);

        // Create one author user and assign the author role
        $authorUser = User::updateOrCreate(
            ['email' => 'author@blog.com'],
            [
                'name' => 'Author',
                'password' => Hash::make('password'),
            ]
        );
        $authorUser->assignRole([$authorRole->id]);
    }
}
