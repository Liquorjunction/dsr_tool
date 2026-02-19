@extends('layouts.app')

@section('title', 'Create Role')

@push('custom-styles')
<link rel="stylesheet" href="{{ asset('assets/css/role-create.css') }}">
@endpush

@section('content')
<div class="rc-wrap">

  {{-- Page Header --}}
  <div class="page-header">
    <h3 class="rc-page-title">
      <i class="mdi mdi-shield-plus-outline" style="color:#7b9ef5;margin-right:.4rem;vertical-align:middle;"></i>
      Create Role
    </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ route('admin.roles.index') }}" style="color:#3d64dd;">Roles</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Create Role</li>
      </ol>
    </nav>
  </div>

  {{-- Card --}}
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">

          {{-- Header --}}
          <div class="rc-head">
            <div class="rc-head-icon">
              <i class="mdi mdi-shield-account-outline"></i>
            </div>
            <div>
              <p class="rc-head-title">New Role</p>
              <p class="rc-head-sub">Define a role and assign permissions to control access.</p>
            </div>
          </div>

          <form method="POST" action="{{ route('admin.roles.store') }}" id="roleForm">
            @csrf

            {{-- ── Role Details ── --}}
            <div class="rc-section">
              <i class="mdi mdi-shield-outline"></i> Role Details
            </div>

            <div class="row g-3 mb-4">
              <div class="col-md-6">
                <div class="form-floating">
                  <input type="text"
                         class="form-control @error('name') is-invalid @enderror"
                         id="name" name="name" placeholder="x"
                         value="{{ old('name') }}" required autocomplete="off">
                  <label for="name">Role Name</label>
                  @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
              </div>
            </div>

            {{-- ── Permissions ── --}}
            <div class="rc-section">
              <i class="mdi mdi-lock-open-outline"></i> Permissions
            </div>

            {{-- Controls bar --}}
            <div class="rc-perm-controls">
              <p class="rc-perm-count">
                <strong id="selectedCount">0</strong> of <strong>{{ count($permissions) }}</strong> selected
              </p>
              <div class="rc-perm-actions">
                <button type="button" class="rc-link-btn" id="selectAll">
                  <i class="mdi mdi-checkbox-multiple-marked-outline me-1"></i>Select All
                </button>
                <button type="button" class="rc-link-btn" id="deselectAll">
                  <i class="mdi mdi-checkbox-multiple-blank-outline me-1"></i>Deselect All
                </button>
              </div>
            </div>

            {{-- Permission table grouped by module --}}
            @php
              // Group permissions by module (extract prefix before the dot)
              $grouped = $permissions->groupBy(function($perm) {
                // e.g., "userManagement.create" → "User Management"
                $parts = explode('.', $perm->name);
                if (count($parts) > 1) {
                  // Convert camelCase to Title Case
                  return ucwords(preg_replace('/([a-z])([A-Z])/', '$1 $2', $parts[0]));
                }
                return 'General';
              });
            @endphp

            @foreach($grouped as $moduleName => $modulePermissions)
              <div class="rc-perm-table mb-3">
                {{-- Group header --}}
                <div class="rc-perm-group-header">
                  <div>
                    <p class="rc-group-title">
                      <i class="mdi mdi-folder-outline"></i>
                      {{ $moduleName }}
                    </p>
                  </div>
                  <div class="rc-group-actions">
                    <span class="rc-group-count" data-group="{{ $moduleName }}">
                      <span class="group-selected">0</span> / {{ count($modulePermissions) }}
                    </span>
                    <button type="button" class="rc-group-link group-select-all" data-group="{{ $moduleName }}">
                      Select All
                    </button>
                    <button type="button" class="rc-group-link group-deselect-all" data-group="{{ $moduleName }}">
                      Clear
                    </button>
                  </div>
                </div>

                {{-- Permission rows --}}
                <div class="rc-perm-rows">
                  @foreach($modulePermissions as $permission)
                    <label class="rc-perm-row"
                           data-permission-id="{{ $permission->id }}"
                           data-group="{{ $moduleName }}">
                      <input type="checkbox"
                             name="permissions[]"
                             value="{{ $permission->id }}"
                             {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
                      <span class="rc-checkbox">
                        <i class="mdi mdi-check rc-checkbox-icon"></i>
                      </span>
                      <div class="rc-perm-info">
                        <p class="rc-perm-name">{{ $permission->name }}</p>
                        @php
                          // Generate a description from the permission name
                          $parts = explode('.', $permission->name);
                          $action = count($parts) > 1 ? ucfirst($parts[1]) : 'Access';
                          $resource = count($parts) > 1 ? ucwords(preg_replace('/([a-z])([A-Z])/', '$1 $2', $parts[0])) : $permission->name;
                          $desc = "$action $resource";
                        @endphp
                        <p class="rc-perm-desc">{{ $desc }}</p>
                      </div>
                    </label>
                  @endforeach
                </div>
              </div>
            @endforeach

            @error('permissions')
              <div class="text-danger mt-2" style="font-size:.78rem;">{{ $message }}</div>
            @enderror

            {{-- Footer --}}
            <div class="rc-footer">
              <a href="{{ route('admin.roles.index') }}" class="rc-btn-secondary">
                <i class="mdi mdi-close"></i> Cancel
              </a>
              <button type="submit" class="rc-btn-primary">
                <i class="mdi mdi-check"></i> Create Role
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection

@push('custom-scripts')
<script src="{{ asset('assets/js/role-create.js') }}"></script>
@endpush
