<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\ReadRoleRequest;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\EditRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Requests\Role\DestroyRoleRequest;
use App\Repositories\Interface\RoleRepositoryInterface as RoleRepo;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        return view('pages.roleManagement.index');
    }

    public function show(ReadRoleRequest $request, RoleRepo $roleRepo)
    {
        $id = $request->query('id');
        $role = $roleRepo->getRoleById($id);
        if (!$role) {
            return redirect()->route('admin.roles.index')->withErrors('Role not found.');
        }
        return view('pages.roleManagement.show', compact('role'));
    }

    public function create(RoleRepo $roleRepo)
    {
        $permissions = $roleRepo->getPermissions();
        return view('pages.roleManagement.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request, RoleRepo $roleRepo)
    {
        try {
            $role = $roleRepo->createRole($request);
            if (!$role) {
                return redirect()->route('admin.roles.index')->withErrors('Failed to create role. Please try again.');
            }
            return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.roles.index')->withErrors('An error occurred: ' . $e->getMessage());
        }
    }

    public function edit(EditRoleRequest $request, RoleRepo $roleRepo)
    {
        $id = $request->input('id');
        $role = $roleRepo->getRoleById($id);
        $permissions = $roleRepo->getPermissions();
        if (!$permissions) {
            return redirect()->route('admin.roles.index')->withErrors('Failed to fetch permissions. Please try again.');
        }
        if (!$role) {
            return redirect()->route('admin.roles.index')->withErrors('Role not found.');
        }
        return view('pages.roleManagement.edit', compact('role', 'permissions'));
    }

    public function update(UpdateRoleRequest $request, RoleRepo $roleRepo)
    {
        $id = $request->input('id');
        try {
            $role = $roleRepo->updateRole($request, $id);
            if (!$role) {
                return redirect()->route('admin.roles.index')->withErrors('Failed to update role. Please try again.');
            }
            return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.roles.index')->withErrors('An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy(DestroyRoleRequest $request, RoleRepo $roleRepo)
    {
        try {
            $id = $request->input('id');
            $role = Role::where('guard_name', 'admin')->findOrFail($id);

            if (in_array($role->name, ['super-admin'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete this system role.',
                ], 422);
            }

            $roleRepo->deleteRole($request);

            return response()->json([
                'success' => true,
                'message' => 'Role deleted successfully.',
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to delete role: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete',
            ], 500);
        }
    }

    // DataTable endpoint for roles
    public function dataTable(ReadRoleRequest $request, RoleRepo $roleRepo)
    {
        try {
            $roles = $roleRepo->getDataForDataTable($request);
            return DataTables::of($roles)
                ->addIndexColumn()
                ->addColumn('permissions', function ($role) {
                    $grouped = [];
                    foreach ($role->permissions as $perm) {
                        $parts = explode('.', $perm->name);
                        $module = $parts[0] ?? 'other';
                        $action = $parts[1] ?? $perm->name;
                        $grouped[$module][] = $action;
                    }
                    $crudSet = ['create', 'read', 'update', 'edit', 'delete'];
                    $colors = ['user' => 'primary', 'role' => 'success', 'userManagement' => 'info', 'other' => 'secondary'];
                    $out = [];
                    foreach ($grouped as $module => $actions) {
                        $color = $colors[$module] ?? 'secondary';
                        $actionsLower = array_map('strtolower', $actions);
                        $hasCreate = in_array('create', $actionsLower);
                        $hasRead = in_array('read', $actionsLower);
                        $hasUpdate = in_array('update', $actionsLower) || in_array('edit', $actionsLower);
                        $hasDelete = in_array('delete', $actionsLower);
                        $isCrud = $hasCreate && $hasRead && $hasUpdate && $hasDelete;
                        $otherActions = array_diff($actionsLower, ['create', 'read', 'update', 'edit', 'delete']);
                        $badges = [];
                        if ($isCrud) {
                            $badges[] = '<span class="badge rounded-pill bg-light text-dark border me-1 mb-1" style="font-weight:400;">crud</span>';
                        } else {
                            if ($hasCreate) $badges[] = '<span class="badge rounded-pill bg-light text-dark border me-1 mb-1" style="font-weight:400;">create</span>';
                            if ($hasRead) $badges[] = '<span class="badge rounded-pill bg-light text-dark border me-1 mb-1" style="font-weight:400;">read</span>';
                            if ($hasUpdate) $badges[] = '<span class="badge rounded-pill bg-light text-dark border me-1 mb-1" style="font-weight:400;">update</span>';
                            if ($hasDelete) $badges[] = '<span class="badge rounded-pill bg-light text-dark border me-1 mb-1" style="font-weight:400;">delete</span>';
                        }
                        foreach ($otherActions as $action) {
                            $badges[] = '<span class="badge rounded-pill bg-light text-dark border me-1 mb-1" style="font-weight:400;">' . $action . '</span>';
                        }
                        $out[] = '<div style="margin-bottom:2px;"><span class="badge bg-' . $color . ' me-2" style="font-size:90%;">' . ucfirst($module) . '</span>' . implode(' ', $badges) . '</div>';
                    }
                    return implode('', $out);
                })
                ->addColumn('action', function ($role) use ($request) {
                    $data['id'] = $role->id;
                    $data['view_url'] = $request->user()->can('role.read') ? route('admin.roles.show', ['id' => $role->id]) : null;
                    $data['edit_url'] = $request->user()->can('role.edit') ? route('admin.roles.edit', ['id' => $role->id]) : null;
                    $data['delete_url'] = $request->user()->can('role.delete') ? route('admin.roles.destroy', ['id' => $role->id]) : null;
                    return view('components.datatable-actions', $data)->render();
                })
                ->rawColumns(['permissions', 'action'])
                ->make(true);
        } catch (\Exception $e) {
            Log::error('Error fetching roles for DataTable: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching data.'], 500);
        }
    }
}
