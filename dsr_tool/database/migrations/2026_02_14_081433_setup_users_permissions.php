<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

return new class extends Migration
{
    public function up(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $guardName = 'admin';

        $permissions = [
            'user.read',
            'user.create',
            'user.edit',
            'user.delete',
            'role.read',
            'role.create',
            'role.edit',
            'role.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => $guardName
            ]);
        }

        // Ensure the super-admin role exists
        $superAdminRole = Role::firstOrCreate(
            [
                'name' => 'super-admin',
                'guard_name' => $guardName
            ]
        );

        $superAdminRole->givePermissionTo($permissions);
        $allPermissions = Permission::where('guard_name', $guardName)->get();
        $superAdminRole->syncPermissions($allPermissions);
    }

    public function down(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $guardName = 'admin';

        $permissions = [
            'user.read',
            'user.create',
            'user.edit',
            'user.delete',
            'role.read',
            'role.create',
            'role.edit',
            'role.delete',
        ];

        $superAdminRole = Role::where('name', 'super-admin')->where('guard_name', $guardName)->first();
        $adminRole = Role::where('name', 'admin')->where('guard_name', $guardName)->first();

        if ($superAdminRole) {
            $superAdminRole->revokePermissionTo($permissions);
            // Sync all permissions to ensure super-admin has all remaining ones
            $allPermissions = Permission::where('guard_name', $guardName)->get();
            $superAdminRole->syncPermissions($allPermissions);
        }

        if ($adminRole) {
            $adminRole->revokePermissionTo($permissions);
        }

        Permission::whereIn('name', $permissions)->where('guard_name', $guardName)->delete();
    }
};
