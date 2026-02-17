<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\DestroyAdminUserRequest;
use App\Http\Requests\User\EditAdminUserRequest;
use App\Http\Requests\User\ReadAdminUserRequest;
use App\Http\Requests\User\StoreAdminUserRequest;
use App\Http\Requests\User\UpdateAdminUserRequest;
use App\Repositories\Interface\UserRepositoryInterface as UserRepo;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.userManagement.index');
    }

    public function create()
    {
        return view('pages.userManagement.create');
    }

    public function store(StoreAdminUserRequest $request, UserRepo $userRepo)
    {
        try {
            $user = $userRepo->createAdminUser($request);
            if (!$user) {
                return redirect()->route('admin.users.index')->withErrors('Failed to create user. Please try again.');
            }
            return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->withErrors('An error occurred: ' . $e->getMessage());
        }
    }

    public function edit(EditAdminUserRequest $request, UserRepo $userRepo)
    {
        $id = $request->query('id');
        $user = $userRepo->getAdminUserById($id);
        if (!$user) {
            return redirect()->route('admin.users.index')->withErrors('User not found.');
        }
        return view('pages.userManagement.edit', compact('user'));
    }

    public function update(UpdateAdminUserRequest $request, UserRepo $userRepo)
    {
        try {
            $id = $request->query('id');
            $user = $userRepo->updateAdminUser($request, $id);
            if (!$user) {
                return redirect()->route('admin.users.index')->withErrors('Failed to update user. Please try again.');
            }
            return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->withErrors('An error occurred: ' . $e->getMessage());
        }
    }


    public function destroy(DestroyAdminUserRequest $request, UserRepo $userRepo)
    {
        try {
            $id = $request->query('id');
            if (!$userRepo->deleteAdminUser($id)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete user. Please try again.'
                ], 400);
            }
            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    public function toggleStatus(DestroyAdminUserRequest $request, UserRepo $userRepo)
    {
        try {
            $id = $request->query('id');
            $user = $userRepo->toggleAdminUserStatus($id);
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to toggle user status. Please try again.'
                ], 400);
            }
            return response()->json([
                'success' => true,
                'message' => 'User status toggled successfully.',
                'status' => $user->status
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    public function dataTable(ReadAdminUserRequest $request, UserRepo $userRepo)
    {
        Log::debug('UserController@dataTable called', ['query' => $request->query()]);
        try {
            $data = $userRepo->getDataforDataTable($request);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('email', function ($row) {
                    return $row->email;
                })
                ->addColumn('phone', function ($row) {
                    return $row->phone;
                })
                ->addColumn('roles', function ($row) {
                        return $row->roles->pluck('name')->join(', ');
                })
                ->addColumn('status', function ($row) use ($request) {
                    $data['id'] = $row->id;
                    $data['status'] = $row->status;
                    $data['statusClass'] = $row->status === 'active' ? 'badge-success' : 'badge-secondary';
                    $data['toggle_status_url'] = $request->user()->can('userManagement.edit') ? route('admin.users.toggleStatus', ['id' => $row->id]) : null;
                    return view('components.datatable-status', $data)->render();
                })
                ->addColumn('action', function ($row) use ($request) {
                    $data['id'] = $row->id;
                    $data['edit_url'] = $request->user()->can('userManagement.update') ? route('admin.users.edit', ['id' => $row->id]) : null;
                    $data['delete_url'] = $request->user()->can('userManagement.delete') ? route('admin.users.destroy', ['id' => $row->id]) : null;
                    $data['view_url'] = $request->user()->can('userManagement.read') ? route('admin.users.show', ['id' => $row->id]) : null;

                    return view('components.datatable_actions', $data)->render();
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        } catch (\Exception $e) {
            Log::error('UserController@dataTable error', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }
}
