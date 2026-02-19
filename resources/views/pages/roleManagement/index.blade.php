@extends('layouts.app')

@section('title', 'Role Management')

@section('content')
    <div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div class="d-flex align-items-center gap-3 grow">
            <h3 class="page-title mb-0">Role Management</h3>
        </div>
        <div class="d-flex align-items-center gap-2">
            <nav aria-label="breadcrumb" class="mb-0">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Roles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Role Management</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-0">Roles</h4>
                        @can('roleManagement.create')
                            <a href="{{ route('admin.roles.create') }}"
                                class="btn btn-primary btn-sm rounded-pill shadow-sm">
                                <i class="mdi mdi-plus fs-5 me-1"></i> Add Role
                            </a>
                        @endcan
                    </div>
                    <table class="table table-striped" id="roles-table" data-url="{{ route('admin.roles.dataTable') }}">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Name </th>
                                <th> Permissions </th>
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
    <script src="{{ asset('assets/js/datableJs/role.js') }}"></script>
@endpush
