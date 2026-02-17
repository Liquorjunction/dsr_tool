@extends('layouts.app')
@section('title', 'Create User')
@section('content')

<div class="uc-wrap">

  {{-- Page Header --}}
  <div class="page-header">
    <h3 class="uc-page-title">
      <i class="mdi mdi-account-plus-outline" style="color:#7b9ef5;margin-right:.4rem;vertical-align:middle;"></i>
      Create User
    </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ route('admin.users.index') }}" style="color:#3d64dd;">Users</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Create User</li>
      </ol>
    </nav>
  </div>

  {{-- Card --}}
  <div class="row">
    <div class="col-xl-12 col-lg-10 col-12">
      <div class="card">
        <div class="card-body">

          {{-- Inner header --}}
          <div class="uc-head">
            <div class="uc-head-icon">
              <i class="mdi mdi-account-circle-outline"></i>
            </div>
            <div>
              <p class="uc-head-title">New User</p>
              <p class="uc-head-sub">Fill in the details below to create a new account.</p>
            </div>
          </div>

          <form class="row g-3" action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- ── Personal Info ── --}}
            <div class="col-12">
              <div class="uc-section">
                <i class="mdi mdi-account-outline"></i> Personal Info
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="text"
                       class="form-control @error('name') is-invalid @enderror"
                       id="name" name="name" placeholder="x"
                       value="{{ old('name') }}" required autocomplete="off">
                <label for="name">Full Name</label>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       id="email" name="email" placeholder="x"
                       value="{{ old('email') }}" required autocomplete="off">
                <label for="email">Email Address</label>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                  <input type="text"
                    class="form-control @error('phone_number') is-invalid @enderror"
                    id="phone_number" name="phone_number" placeholder="x"
                    value="{{ old('phone_number') }}">
                  <label for="phone_number">Phone Number</label>
                  @error('phone_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="date"
                       class="form-control @error('date_of_birth') is-invalid @enderror"
                       id="date_of_birth" name="date_of_birth" placeholder="x"
                       value="{{ old('date_of_birth') }}">
                <label for="date_of_birth">Date of Birth</label>
                @error('date_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="col-12">
              <div class="form-floating">
                <textarea class="form-control @error('remarks') is-invalid @enderror"
                          id="remarks" name="remarks"
                          placeholder="x">{{ old('remarks') }}</textarea>
                <label for="remarks">
                  Remarks <span style="color:#5a6474;font-weight:400;">(optional)</span>
                </label>
                @error('remarks')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>

            {{-- ── Account Settings ── --}}
            <div class="col-12 mt-1">
              <div class="uc-section">
                <i class="mdi mdi-shield-lock-outline"></i> Account Settings
              </div>
            </div>

            {{-- Password (eye toggle sits OUTSIDE form-floating, positioned via .uc-pw) --}}
            <div class="col-md-6">
              <div class="uc-pw">
                <div class="form-floating">
                  <input type="password"
                         class="form-control @error('password') is-invalid @enderror"
                         id="password" name="password" placeholder="x" required>
                  <label for="password">Password</label>
                  @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <button type="button" class="uc-pw-btn" data-target="password" tabindex="-1">
                  <i class="mdi mdi-eye-outline"></i>
                </button>
              </div>
            </div>

            <div class="col-md-6">
              <div class="uc-pw">
                <div class="form-floating">
                  <input type="password"
                         class="form-control @error('password_confirmation') is-invalid @enderror"
                         id="password_confirmation" name="password_confirmation"
                         placeholder="x" required>
                  <label for="password_confirmation">Confirm Password</label>
                  @error('password_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <button type="button" class="uc-pw-btn" data-target="password_confirmation" tabindex="-1">
                  <i class="mdi mdi-eye-outline"></i>
                </button>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <select class="form-select @error('role') is-invalid @enderror"
                        id="role" name="role" required>
                  <option value="" disabled selected></option>
                  @foreach(Spatie\Permission\Models\Role::all() as $role)
                    <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                      {{ $role->name }}
                    </option>
                  @endforeach
                </select>
                <label for="role">Assign Role</label>
                @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>

            {{-- File upload --}}
            <div class="col-md-6">
              <label class="uc-file-lbl">
                Profile Image <span style="color:#5a6474;font-weight:400;">(optional)</span>
              </label>
              <div class="uc-file-zone">
                {{-- font-size:0 hides "No file chosen"; only the zone content shows --}}
                <input type="file" id="profile_image" name="profile_image"
                       accept="image/*" style="font-size:0;">
                <div class="uc-file-inner">
                  <i class="mdi mdi-cloud-upload-outline uc-file-icon"></i>
                  <p class="uc-file-hint">
                    <strong>Click to upload</strong> or drag &amp; drop<br>
                    PNG, JPG or GIF &mdash; max 2 MB
                  </p>
                  <span class="uc-file-chosen" id="uc-chosen"></span>
                </div>
              </div>
            </div>

            {{-- Footer --}}
            <div class="col-12">
              <div class="uc-footer">
                <a href="{{ route('admin.users.index') }}" class="uc-btn-secondary">
                  <i class="mdi mdi-close"></i> Cancel
                </a>
                <button type="submit" class="uc-btn-primary">
                  <i class="mdi mdi-check"></i> Create User
                </button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection

