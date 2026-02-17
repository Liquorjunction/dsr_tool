@extends('layouts.app')
@section('title', 'User Details')

@push('custom-styles')
<style>
  /* All scoped under .uv-wrap — no theme class overrides */

  .uv-page-title {
    font-size: 1.45rem;
    font-weight: 700;
    color: #fff;
    margin: 0 0 .25rem;
  }

  /* Card extras */
  .uv-wrap .card {
    border-radius: .75rem !important;
    box-shadow: 0 6px 30px rgba(0,0,0,.4) !important;
  }

  .uv-wrap .card-body {
    padding: 1.75rem 2rem !important;
  }

  /* ── Profile hero strip ── */
  .uv-hero {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid rgba(255,255,255,.07);
    margin-bottom: 1.75rem;
  }

  .uv-avatar {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid rgba(61,100,221,.4);
    flex-shrink: 0;
  }

  .uv-avatar-placeholder {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: rgba(61,100,221,.18);
    color: #7b9ef5;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.25rem;
    flex-shrink: 0;
    border: 3px solid rgba(61,100,221,.25);
  }

  .uv-hero-info {}

  .uv-hero-name {
    font-size: 1.15rem;
    font-weight: 700;
    color: #e2e8f2;
    margin: 0 0 .2rem;
    line-height: 1.2;
  }

  .uv-hero-email {
    font-size: .8125rem;
    color: #5a6474;
    margin: 0 0 .45rem;
  }

  .uv-hero-badges {
    display: flex;
    flex-wrap: wrap;
    gap: .4rem;
  }

  .uv-badge-role {
    display: inline-flex;
    align-items: center;
    padding: .2rem .65rem;
    border-radius: 2rem;
    font-size: .72rem;
    font-weight: 600;
    background: rgba(61,100,221,.18);
    color: #7b9ef5;
    letter-spacing: .15px;
  }

  .uv-badge-status-active {
    display: inline-flex;
    align-items: center;
    gap: .3rem;
    padding: .2rem .65rem;
    border-radius: 2rem;
    font-size: .72rem;
    font-weight: 600;
    background: rgba(26,158,94,.15);
    color: #34d399;
  }

  .uv-badge-status-inactive {
    display: inline-flex;
    align-items: center;
    gap: .3rem;
    padding: .2rem .65rem;
    border-radius: 2rem;
    font-size: .72rem;
    font-weight: 600;
    background: rgba(217,79,61,.15);
    color: #f87171;
  }

  .uv-badge-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: currentColor;
    flex-shrink: 0;
  }

  /* ── Section label ── */
  .uv-section {
    font-size: .6875rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .9px;
    color: #5a6474;
    display: flex;
    align-items: center;
    gap: .5rem;
    margin-bottom: 1rem;
  }

  .uv-section::after {
    content: '';
    flex: 1;
    height: 1px;
    background: rgba(255,255,255,.07);
  }

  /* ── Readonly fields — floating label fix ── */
  /*
   * readonly inputs don't support :placeholder-shown in some browsers.
   * We force the label to always be in its floated position.
   */
  .uv-wrap .form-floating > .form-control[readonly] ~ label,
  .uv-wrap .form-floating > textarea.form-control[readonly] ~ label {
    color: #5a6474 !important;
    transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem) !important;
    opacity: 1 !important;
  }

  .uv-wrap .form-floating > .form-control[readonly] ~ label::after,
  .uv-wrap .form-floating > textarea.form-control[readonly] ~ label::after {
    background-color: #2A3038 !important; /* matches theme input bg */
  }

  /* Push text down so it doesn't overlap the floated label */
  .uv-wrap .form-floating > .form-control[readonly],
  .uv-wrap .form-floating > textarea.form-control[readonly] {
    padding-top: 1.625rem !important;
    padding-bottom: 0.625rem !important;
    cursor: default;
  }

  /* Dim readonly inputs slightly */
  .uv-wrap .form-control[readonly] {
    opacity: .85;
  }

  /* Textarea readonly */
  .uv-wrap .form-floating > textarea.form-control[readonly] {
    height: 90px !important;
    min-height: 90px !important;
    resize: none;
  }

  /* ── Info tile (alternative to floating label for simple key/value) ── */
  .uv-tile {
    background: rgba(255,255,255,.03);
    border: 1px solid rgba(255,255,255,.07);
    border-radius: .5rem;
    padding: .75rem 1rem;
  }

  .uv-tile-label {
    font-size: .6875rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .7px;
    color: #5a6474;
    margin-bottom: .25rem;
  }

  .uv-tile-value {
    font-size: .9rem;
    color: #c8d0dc;
    font-weight: 500;
    margin: 0;
  }

  .uv-tile-value.empty {
    color: #3d4655;
    font-style: italic;
  }

  /* ── Footer ── */
  .uv-footer {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: .65rem;
    padding-top: 1.375rem;
    border-top: 1px solid rgba(255,255,255,.07);
    margin-top: 1.5rem;
  }

  .uv-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: .375rem;
    height: 40px;
    padding: 0 1.5rem;
    border-radius: .5rem;
    font-size: .875rem;
    font-weight: 600;
    background: #3d64dd;
    border: none;
    color: #fff !important;
    cursor: pointer;
    text-decoration: none;
    box-shadow: 0 3px 12px rgba(61,100,221,.38);
    transition: background .18s, transform .14s, box-shadow .18s;
    line-height: 1;
  }

  .uv-btn-primary:hover {
    background: #2e52c4;
    color: #fff !important;
    box-shadow: 0 5px 18px rgba(61,100,221,.48);
    transform: translateY(-1px);
  }

  .uv-btn-primary:active { transform: translateY(0); }

  .uv-btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: .375rem;
    height: 40px;
    padding: 0 1.25rem;
    border-radius: .5rem;
    font-size: .875rem;
    font-weight: 600;
    background: transparent;
    border: 1px solid rgba(255,255,255,.12);
    color: #8a94a6 !important;
    text-decoration: none;
    transition: border-color .18s, background .18s, color .18s;
    line-height: 1;
  }

  .uv-btn-secondary:hover {
    border-color: rgba(255,255,255,.22);
    background: rgba(255,255,255,.05);
    color: #e2e8f2 !important;
  }
</style>
@endpush

@section('content')
<div class="uv-wrap">

  {{-- Page Header --}}
  <div class="page-header">
    <h3 class="uv-page-title">
      <i class="mdi mdi-account-circle-outline" style="color:#7b9ef5;margin-right:.4rem;vertical-align:middle;"></i>
      User Details
    </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ route('admin.users.index') }}" style="color:#3d64dd;">Users</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">User Details</li>
      </ol>
    </nav>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">

          {{-- ── Profile Hero ── --}}
          <div class="uv-hero">
            {{-- Avatar --}}
            @if($user->profile_image)
              <img src="{{ asset('storage/' . $user->profile_image) }}"
                   alt="{{ $user->name }}"
                   class="uv-avatar">
            @else
              <div class="uv-avatar-placeholder">
                <i class="mdi mdi-account"></i>
              </div>
            @endif

            {{-- Name / email / badges --}}
            <div class="uv-hero-info">
              <p class="uv-hero-name">{{ $user->name }}</p>
              <p class="uv-hero-email">{{ $user->email }}</p>
              <div class="uv-hero-badges">
                @foreach($user->roles as $role)
                  <span class="uv-badge-role">
                    <i class="mdi mdi-shield-outline me-1"></i>{{ $role->name }}
                  </span>
                @endforeach

                @if(strtolower($user->status) === 'active')
                  <span class="uv-badge-status-active">
                    <span class="uv-badge-dot"></span> Active
                  </span>
                @else
                  <span class="uv-badge-status-inactive">
                    <span class="uv-badge-dot"></span> {{ ucfirst($user->status) }}
                  </span>
                @endif
              </div>
            </div>
          </div>

          {{-- ── Personal Info ── --}}
          <div class="uv-section">
            <i class="mdi mdi-account-outline"></i> Personal Info
          </div>

          <div class="row g-3 mb-4">
            <div class="col-md-6">
              <div class="uv-tile">
                <div class="uv-tile-label">Full Name</div>
                <p class="uv-tile-value {{ $user->name ? '' : 'empty' }}">
                  {{ $user->name ?: '—' }}
                </p>
              </div>
            </div>

            <div class="col-md-6">
              <div class="uv-tile">
                <div class="uv-tile-label">Email Address</div>
                <p class="uv-tile-value {{ $user->email ? '' : 'empty' }}">
                  {{ $user->email ?: '—' }}
                </p>
              </div>
            </div>

            <div class="col-md-6">
              <div class="uv-tile">
                <div class="uv-tile-label">Phone Number</div>
                <p class="uv-tile-value {{ $user->phone_number ? '' : 'empty' }}">
                  {{ $user->phone_number ?: '—' }}
                </p>
              </div>
            </div>

            <div class="col-md-6">
              <div class="uv-tile">
                <div class="uv-tile-label">Date of Birth</div>
                <p class="uv-tile-value {{ $user->date_of_birth ? '' : 'empty' }}">
                  {{ $user->date_of_birth
                      ? \Carbon\Carbon::parse($user->date_of_birth)->format('d M Y')
                      : '—' }}
                </p>
              </div>
            </div>

            <div class="col-12">
              <div class="uv-tile">
                <div class="uv-tile-label">Remarks</div>
                <p class="uv-tile-value {{ $user->remarks ? '' : 'empty' }}"
                   style="white-space:pre-line;">
                  {{ $user->remarks ?: '—' }}
                </p>
              </div>
            </div>
          </div>

          {{-- ── Account Settings ── --}}
          <div class="uv-section">
            <i class="mdi mdi-shield-lock-outline"></i> Account Settings
          </div>

          <div class="row g-3 mb-2">
            <div class="col-md-6">
              <div class="uv-tile">
                <div class="uv-tile-label">Assigned Role(s)</div>
                <p class="uv-tile-value {{ $user->roles->count() ? '' : 'empty' }}">
                  {{ $user->roles->pluck('name')->join(', ') ?: '—' }}
                </p>
              </div>
            </div>

            <div class="col-md-6">
              <div class="uv-tile">
                <div class="uv-tile-label">Account Status</div>
                <p class="uv-tile-value">
                  @if(strtolower($user->status) === 'active')
                    <span class="uv-badge-status-active">
                      <span class="uv-badge-dot"></span> Active
                    </span>
                  @else
                    <span class="uv-badge-status-inactive">
                      <span class="uv-badge-dot"></span> {{ ucfirst($user->status) }}
                    </span>
                  @endif
                </p>
              </div>
            </div>
          </div>

          {{-- ── Footer ── --}}
          <div class="uv-footer">
            <a href="{{ route('admin.users.index') }}" class="uv-btn-secondary">
              <i class="mdi mdi-arrow-left"></i> Back to Users
            </a>
            @can('userManagement.edit')
              <a href="{{ route('admin.users.edit', ['id' => $user->id]) }}" class="uv-btn-primary">
                <i class="mdi mdi-pencil"></i> Edit User
              </a>
            @endcan
          </div>

        </div>
      </div>
    </div>
  </div>

</div>
@endsection
