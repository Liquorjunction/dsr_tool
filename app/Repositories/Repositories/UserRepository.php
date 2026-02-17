<?php

namespace App\Repositories\Repositories;

use App\Models\User;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class UserRepository implements UserRepositoryInterface
{
    public function findById($id)
    {
        try {
            return User::findOrFail($id);
        } catch (\Exception $e) {
            Log::error("Error finding user by ID: {$e->getMessage()}");
            return null;
        }
    }

    public function findByEmail($email)
    {
        try {
            return User::where('email', $email)->first();
        } catch (\Exception $e) {
            Log::error("Error finding user by email: {$e->getMessage()}");
            return null;
        }
    }

    public function createAdminUser($request)
    {
        try {
            $loggedInAdmin = Auth::guard('admin')->user();

            if (!$loggedInAdmin->can('userManagement.create')) {
                throw new \Exception('Unauthorized to create admin user');
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->email, // Temporary
                'phone_number' => $request->phone_number,
                'date_of_birth' => $request->date_of_birth,
                'remarks' => $request->remarks,
                'password' => Hash::make($request->password),
                'status' => 'active',
            ]);

            $baseUsername = explode('@', $request->email)[0];
            $paddedId = str_pad($user->id, 4, '0', STR_PAD_LEFT);
            $user->username = $baseUsername . $paddedId;
            $user->save();

            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $path = $image->store('profile_images', 'public');
                $user->profile_picture = $path;
                $user->save();
            }

            $user->assignRole($request->role);
            return $user;
        } catch (\Exception $e) {
            Log::error("Error creating admin user: {$e->getMessage()}");
            return null;
        }
    }

    public function updateAdminUser($request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $loggedInAdmin = Auth::guard('admin')->user();

            if (!$loggedInAdmin->can('userManagement.edit')) {
                throw new \Exception('Unauthorized to update admin user');
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->date_of_birth = $request->date_of_birth;
            $user->remarks = $request->remarks;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $path = $image->store('profile_images', 'public');
                $user->profile_picture = $path;
            }

            $user->save();
            $user->syncRoles($request->role);
            return $user;
        } catch (\Exception $e) {
            Log::error("Error updating admin user: {$e->getMessage()}");
            return null;
        }
    }

    public function deleteAdminUser($id)
    {
        try {
            $user = User::findOrFail($id);
            $loggedInAdmin = Auth::guard('admin')->user();

            if (!$loggedInAdmin->can('userManagement.delete')) {
                throw new \Exception('Unauthorized to delete admin user');
            }

            $user->delete();
            return true;
        } catch (\Exception $e) {
            Log::error("Error deleting admin user: {$e->getMessage()}");
            return false;
        }
    }

    public function toggleAdminUserStatus($id)
    {
        try {
            $user = User::findOrFail($id);
            $loggedInAdmin = Auth::guard('admin')->user();

            if (!$loggedInAdmin->can('userManagement.edit')) {
                throw new \Exception('Unauthorized to toggle admin user status');
            }

            $user->status = $user->status === 'active' ? 'inactive' : 'active';
            $user->save();
            return $user;
        } catch (\Exception $e) {
            Log::error("Error toggling admin user status: {$e->getMessage()}");
            return null;
        }
    }

    public function getAllAdminUsers()
    {
        try {
            return User::with('roles')->get();
        } catch (\Exception $e) {
            Log::error("Error fetching all admin users: {$e->getMessage()}");
            return null;
        }
    }

    public function getAdminUserById($id)
    {
        try {
            return User::with('roles')->findOrFail($id);
        } catch (\Exception $e) {
            Log::error("Error fetching admin user by ID: {$e->getMessage()}");
            return null;
        }
    }

    public function updateSelfProfile($request, $id)
    {
        try {
            $user = User::findOrFail($id);

            if ($user->id !== Auth::guard('admin')->id()) {
                throw new \Exception('Unauthorized to update this profile');
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->date_of_birth = $request->date_of_birth;
            $user->remarks = $request->remarks;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $path = $image->store('profile_images', 'public');
                $user->profile_image = $path;
            }

            $user->save();
            return $user;
        } catch (\Exception $e) {
            Log::error("Error updating self profile: {$e->getMessage()}");
            return null;
        }
    }

    public function getDataforDataTable($request)
    {
        Log::debug('UserRepository@getDataforDataTable called', ['query' => $request->query()]);
        try {
            return User::with('roles')->select('*');
        } catch (\Exception $e) {
            Log::error("Error fetching data for DataTable: {$e->getMessage()}");
            return User::query(); // Return empty query on error
        }
    }
}
