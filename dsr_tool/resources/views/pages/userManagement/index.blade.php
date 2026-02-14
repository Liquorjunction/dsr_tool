@extends('layouts.app')

@section('title', 'User Management')

@section('content')
<div class="page-header">
  <h3 class="page-title"> User Management </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Users</a></li>
      <li class="breadcrumb-item active" aria-current="page">User Management</li>
    </ol>
  </nav>
</div>
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Users</h4>
        <div class="table-responsive">
          <table class="table table-striped" id="users-table"
                 data-url="{{ route('admin.users.dataTable') }}">
            <thead>
              <tr>
                <th> # </th>
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
</div>
@endsection

@push('custom-scripts')
    <script src="{{ asset('assets/js/datableJs/user.js') }}"></script>
@endpush
