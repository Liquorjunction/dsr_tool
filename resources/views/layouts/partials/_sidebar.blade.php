<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="{{ url('/') }}">
      <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" />
    </a>
    <a class="sidebar-brand brand-logo-mini" href="{{ url('/') }}">
      <img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" />
    </a>
  </div>
  <ul class="nav">
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
            <img class="img-xs rounded-circle" src="{{ asset('assets/images/faces/face15.jpg') }}" alt="">
            <span class="count bg-success"></span>
          </div>
          <div class="profile-name">
            <h5 class="mb-0 font-weight-normal">{{ Auth::user()->name ?? 'Henry Klein' }}</h5>
            <span>Gold Member</span>
          </div>
        </div>
        <a href="#" id="profile-dropdown" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-cog text-primary"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-onepassword text-info"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
            </div>
          </a>
        </div>
      </div>
    </li>

    <li class="nav-item nav-category">
      <span class="nav-link">Navigation</span>
    </li>

    <li class="nav-item menu-items {{ request()->is('dashboard') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <li class="nav-item menu-items {{ request()->is('ui/*') ? 'active' : '' }}">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="{{ request()->is('ui/*') ? 'true' : 'false' }}" aria-controls="ui-basic">
        <span class="menu-icon">
          <i class="mdi mdi-laptop"></i>
        </span>
        <span class="menu-title">Basic UI Elements</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ request()->is('ui/*') ? 'show' : '' }}" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('ui.buttons') }}">Buttons</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('ui.dropdowns') }}">Dropdowns</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('ui.typography') }}">Typography</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item menu-items {{ request()->is('forms/*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('forms.basic') }}">
        <span class="menu-icon">
          <i class="mdi mdi-playlist-play"></i>
        </span>
        <span class="menu-title">Form Elements</span>
      </a>
    </li>

    <li class="nav-item menu-items {{ request()->is('tables/*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('tables.basic') }}">
        <span class="menu-icon">
          <i class="mdi mdi-table-large"></i>
        </span>
        <span class="menu-title">Tables</span>
      </a>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" href="{{ url('docs/documentation.html') }}">
        <span class="menu-icon">
          <i class="mdi mdi-file-document"></i>
        </span>
        <span class="menu-title">Documentation</span>
      </a>
    </li>
  </ul>
</nav>
