<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            [
                'email' => 'superadmin@dsrtool.com',
                'username' => 'superadmin',
            ],
            [
                'name' => 'Super Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]
        );

        $roleName = 'super-admin';
        $guardName = 'admin';

        try {
            $role = Role::findByName($roleName, $guardName);
            $user->assignRole($role);
        } catch (RoleDoesNotExist $e) {
            $this->command->error("Role '$roleName' with guard '$guardName' not found. Did you run the migration?");
        }
    }
}
