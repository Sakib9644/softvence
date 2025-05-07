<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="/dashboard" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset($website_settings->site_icon ?? 'No Site Icon') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset($website_settings->logo ?? 'No Site Icon') }}" alt="" height="50">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                {{-- Dashboard --}}
                @can('dashboard')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/dashboard">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                @endcan

                {{-- System Settings --}}
                @canany(['profile-settings.', 'security-settings.', 'notification-settings.','admin-settings'])
                @php
                    $isSystemSettingsActive = Route::is('backend.edit') || Route::is('profile.edit');
                @endphp

                <li class="nav-item">
                    <a class="nav-link menu-link {{ $isSystemSettingsActive ? '' : 'collapsed' }}"
                       href="#sidebarSystemSettings" data-bs-toggle="collapse" role="button"
                       aria-expanded="{{ $isSystemSettingsActive ? 'true' : 'false' }}"
                       aria-controls="sidebarSystemSettings">
                        <i class="ri-settings-3-line"></i>
                        <span data-key="t-system-settings">System Settings</span>
                    </a>

                    <div class="collapse menu-dropdown {{ $isSystemSettingsActive ? 'show' : '' }}"
                         id="sidebarSystemSettings">
                        <ul class="nav nav-sm flex-column">
                            @can('admin-settings')
                            <li class="nav-item">
                                <a href="{{ route('backend.edit') }}"
                                   class="nav-link {{ Route::is('backend.edit') ? 'active' : '' }}"
                                   data-key="t-system">Admin Settings</a>
                            </li>
                            @endcan
                            @can('profile-settings')
                            <li class="nav-item">
                                <a href="{{ route('profile.edit') }}"
                                   class="nav-link {{ Route::is('profile.edit') ? 'active' : '' }}"
                                   data-key="t-profile">Profile Settings</a>
                            </li>
                            @endcan
                            @can('security-settings')
                            <li class="nav-item">
                                <a 
                                   class="nav-link {{ Route::is('security.edit') ? 'active' : '' }}"
                                   data-key="t-security">Security Settings</a>
                            </li>
                            @endcan
                            @can('notification-settings')
                            <li class="nav-item">
                                <a 
                                   class="nav-link {{ Route::is('notification.edit') ? 'active' : '' }}"
                                   data-key="t-notification">Notification Settings</a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>

                @endcanany

                {{-- Role and Permission --}}
                @canany(['role.create', 'permission.create', 'user.create'])
                @php
                    $isRolePermissionActive = Route::is('permissions.index') || Route::is('roles.index') || Route::is('users.create');
                @endphp

                <li class="nav-item">
                    <a class="nav-link menu-link {{ $isRolePermissionActive ? '' : 'collapsed' }}"
                       href="#sidebarRolePermission" data-bs-toggle="collapse" role="button"
                       aria-expanded="{{ $isRolePermissionActive ? 'true' : 'false' }}"
                       aria-controls="sidebarRolePermission">
                        <i class="ri-shield-user-line"></i>
                        <span data-key="t-role-permission">Role Permission</span>
                    </a>

                    <div class="collapse menu-dropdown {{ $isRolePermissionActive ? 'show' : '' }}"
                         id="sidebarRolePermission">
                        <ul class="nav nav-sm flex-column">
                            @can('role.create')
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}"
                                   class="nav-link {{ Route::is('roles.index') ? 'active' : '' }}"
                                   data-key="t-create-role">Create Role</a>
                            </li>
                            @endcan
                            @can('permission.create')
                            <li class="nav-item">
                                <a href="{{ route('permissions.index') }}"
                                   class="nav-link {{ Route::is('permissions.index') ? 'active' : '' }}"
                                   data-key="t-create-permission">Create Permission</a>
                            </li>
                            @endcan
                            @can('user.create')
                            <li class="nav-item">
                                <a href="{{ route('users.create') }}"
                                   class="nav-link {{ Route::is('users.create') ? 'active' : '' }}"
                                   data-key="t-create-user">Create User</a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcanany

            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>
