<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $guardName = 'admin';

        $permissions = [
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
        $superAdminRole = Role::where('name', 'super-admin')->where('guard_name', $guardName)->first();

        if ($superAdminRole) {
            $superAdminRole->givePermissionTo($permissions);
            $allPermissions = Permission::where('guard_name', $guardName)->get();
            $superAdminRole->syncPermissions($allPermissions);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $guardName = 'admin';

        $permissions = [
            'role.read',
            'role.create',
            'role.edit',
            'role.delete',
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
