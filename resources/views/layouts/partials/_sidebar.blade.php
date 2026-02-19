<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-start fixed-top">
        <h2 class="sidebar-brand-text mb-0" style="color: #fff;">DSR TOOL</h2>
    </div>
    <ul class="nav">
        <li class="nav-item">
            <div class="m-3">
                <form action="#" method="POST">
                    @csrf
                    <label for="dsrType" class="font-weight-bold mb-2">Select DSR Type</label>
                    <small class="text-muted d-block mb-2">Choose which DSR you want to work on.</small>
                    <div class="w-100">
                        <select name="dsr_type" id="dsrType" class="dsr-pill-select mb-3" style="width:100%; border-radius: 999px; background: #23232b; color: #fff; border: none;">
                            <option value="daily">Daily DSR</option>
                            <option value="weekly">Weekly DSR</option>
                            <option value="monthly">Monthly DSR</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm w-100 mt-3" style="border-radius: 999px;">
                        <i class="mdi mdi-check"></i> Apply
                    </button>
                </form>
            </div>
        </li>

        <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
        </li>

        <!-- Dashboard -->
        <li class="nav-item menu-items {{ request()->is('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="menu-icon"><i class="mdi mdi-speedometer"></i></span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <!-- User Management -->
        <li class="nav-item menu-items {{ request()->is('users*') ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#user-management"
                aria-expanded="{{ request()->is('users*') ? 'true' : 'false' }}" aria-controls="user-management">
                <span class="menu-icon"><i class="mdi mdi-account-multiple"></i></span>
                <span class="menu-title">User Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ request()->is('users*') ? 'show' : '' }}" id="user-management">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">All Users</a></li>
                </ul>
            </div>
        </li>
            <!-- Role Management -->
            <li class="nav-item menu-items {{ request()->is('roles*') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#role-management"
                    aria-expanded="{{ request()->is('roles*') ? 'true' : 'false' }}" aria-controls="role-management">
                    <span class="menu-icon"><i class="mdi mdi-shield-account"></i></span>
                    <span class="menu-title">Role Management</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse {{ request()->is('roles*') ? 'show' : '' }}" id="role-management">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.roles.index') }}">All Roles</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.roles.create') }}">Add Role</a></li>
                    </ul>
                </div>
            </li>

        <!-- UI Elements -->
        <li class="nav-item menu-items {{ request()->is('ui/*') ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic"
                aria-expanded="{{ request()->is('ui/*') ? 'true' : 'false' }}" aria-controls="ui-basic">
                <span class="menu-icon"><i class="mdi mdi-laptop"></i></span>
                <span class="menu-title">Basic UI Elements</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ request()->is('ui/*') ? 'show' : '' }}" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('ui.buttons') }}">Buttons</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('ui.dropdowns') }}">Dropdowns</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('ui.typography') }}">Typography</a></li>
                </ul>
            </div>
        </li>

        <!-- Forms -->
        <li class="nav-item menu-items {{ request()->is('forms/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('forms.basic') }}">
                <span class="menu-icon"><i class="mdi mdi-playlist-play"></i></span>
                <span class="menu-title">Form Elements</span>
            </a>
        </li>

        <!-- Tables -->
        <li class="nav-item menu-items {{ request()->is('tables/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('tables.basic') }}">
                <span class="menu-icon"><i class="mdi mdi-table-large"></i></span>
                <span class="menu-title">Tables</span>
            </a>
        </li>

        <!-- Charts -->
        <li class="nav-item menu-items {{ request()->is('charts/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('charts.chartjs') }}">
                <span class="menu-icon"><i class="mdi mdi-chart-bar"></i></span>
                <span class="menu-title">Charts</span>
            </a>
        </li>

        <!-- Icons -->
        <li class="nav-item menu-items {{ request()->is('icons/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('icons.fontawesome') }}">
                <span class="menu-icon"><i class="mdi mdi-emoticon"></i></span>
                <span class="menu-title">Font Awesome Icons</span>
            </a>
        </li>

        <!-- Blank Page -->
        <li class="nav-item menu-items {{ request()->is('blank-page') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('samples.blank') }}">
                <span class="menu-icon"><i class="mdi mdi-file-outline"></i></span>
                <span class="menu-title">Blank Page</span>
            </a>
        </li>

        <!-- Documentation -->
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('docs/documentation.html') }}">
                <span class="menu-icon"><i class="mdi mdi-file-document"></i></span>
                <span class="menu-title">Documentation</span>
            </a>
        </li>
    </ul>
</nav>
