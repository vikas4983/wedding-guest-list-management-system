<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Permissions
            ['name' => 'guest create', 'guard_name' => 'web'],
            ['name' => 'guest view', 'guard_name' => 'web'],
            ['name' => 'guest edit', 'guard_name' => 'web'],
            ['name' => 'guest delete', 'guard_name' => 'web'],
            ['name' => 'RSVP update', 'guard_name' => 'web'],
        ];

        foreach ($permissions as $key => $permission) {
            Permission::firstOrCreate($permission);
        }

        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $user = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);
        $admin->syncPermissions(Permission::all());
        $user->syncPermissions([
            'guest view',
            'guest create',
        ]);
    }
}
