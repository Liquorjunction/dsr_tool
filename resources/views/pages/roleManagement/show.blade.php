@extends('layouts.app')

@section('title', 'View Role')

@section('content')
    <div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div class="d-flex align-items-center gap-3 grow">
            <h3 class="page-title mb-0">View Role</h3>
        </div>
        <div class="d-flex align-items-center gap-2">
            <nav aria-label="breadcrumb" class="mb-0">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Roles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Role</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Role Details</h4>
                    <dl class="row">
                        <dt class="col-sm-3">Name</dt>
                        <dd class="col-sm-9">{{ $role->name }}</dd>
                        <dt class="col-sm-3">Permissions</dt>
                        <dd class="col-sm-9">{{ $role->permissions->pluck('name')->implode(', ') }}</dd>
                    </dl>
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary btn-sm">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
