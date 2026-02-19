<?php

namespace App\Repositories\Repositories;

use App\Repositories\Interface\RoleRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    protected $guard = 'admin';

    public function getAdmin($id)
    {
        return Role::find($id);
    }

    public function getAllAdmins()
    {
        return Role::where('guard_name', $this->guard)->get();
    }

    public function getPermissions()
    {
        return Permission::where('guard_name', $this->guard)->get();
    }


    public function getRoles()
    {
        return Role::where('guard_name', $this->guard)->get();
    }

    public function getRoleById($id)
    {
        return Role::where('guard_name', $this->guard)->where('id', $id)->first();
    }

    public function updateRole($request, $id)
    {
        $role = Role::findorFail($id);

        $role->update([
            'name' => $request->input('name'),
        ]);

        if ($request->has('permissions')) {
            $permissions = Permission::where('guard_name', $this->guard)->whereIn('id', $request->input('permissions'))->get();
            $role->syncPermissions($permissions);
    }
        return $role;
    }

    public function createRole($request)
    {
        $role = Role::create([
            'name' => $request->input('name'),
            'guard_name' => $this->guard,
        ]);

        if ($request->has('permissions')) {
            $permissions = Permission::where('guard_name', $this->guard)->whereIn('id', $request->input('permissions'))->get();
            $role->syncPermissions($permissions);
        }
        return $role;
    }

    public function deleteRole($request)
    {
        $role = Role::findOrFail($request->query('id'));
        $role->delete();
        return $role;
    }

    public function getDataForDataTable($request)
    {
        $query = Role::where('guard_name', $this->guard)->with('permissions')->get();
        Log::info($query);
        return $query;
    }
}
