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
            'userManagement.read',
            'userManagement.create',
            'userManagement.edit',
            'userManagement.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => $guardName
            ]);
        }

        $superAdminRole = Role::where('name', 'super-admin')->where('guard_name', $guardName)->first();

        if ($superAdminRole) {
            $superAdminRole->givePermissionTo($permissions);
            $allPermissions = Permission::where('guard_name', $guardName)->get();
            $superAdminRole->syncPermissions($allPermissions);
        }
    }
    public function down(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $guardName = 'admin';

        $permissions = [
            'userManagement.read',
            'userManagement.create',
            'userManagement.edit',
            'userManagement.delete',
        ];

        $superAdminRole = Role::where('name', 'super-admin')->where('guard_name', $guardName)->first();

        if ($superAdminRole) {
            $superAdminRole->revokePermissionTo($permissions);
            // Sync all permissions to ensure super-admin has all remaining ones
            $allPermissions = Permission::where('guard_name', $guardName)->get();
            $superAdminRole->syncPermissions($allPermissions);
        }

        Permission::whereIn('name', $permissions)->where('guard_name', $guardName)->delete();

    }
};
