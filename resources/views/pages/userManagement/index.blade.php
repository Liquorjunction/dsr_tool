@extends('layouts.app')

@section('title', 'User Management')

@section('content')
    <div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div class="d-flex align-items-center gap-3 grow">
            <h3 class="page-title mb-0">User Management</h3>
        </div>
        <div class="d-flex align-items-center gap-2">
            <nav aria-label="breadcrumb" class="mb-0">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Management</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-0">Users</h4>
                        @can('userManagement.create')
                            <a href="{{ route('admin.users.create') }}"
                                class="btn btn-primary btn-sm rounded-pill shadow-sm">
                                <i class="mdi mdi-plus fs-5 me-1"></i> Add User
                            </a>
                        @endcan
                    </div>
                    <table class="table table-striped" id="users-table" data-url="{{ route('admin.users.dataTable') }}">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Profile Image </th>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Phone </th>
                                <th> Roles </th>
                                <th> Status </th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- DataTables will populate this -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script src="{{ asset('assets/js/datableJs/user.js') }}"></script>
@endpush
