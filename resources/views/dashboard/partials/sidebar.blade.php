<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/images/ba.jpg') }}" class="logo-icon" alt="logo icon" width='50'> 
        </div>
        <div class="toggle-icon ms-auto"><i class="bi bi-list"></i></div>
    </div>

    <!-- Navigation -->
    <ul class="metismenu" id="menu">

        <!-- Dashboard Section -->
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-house-fill"></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
            @can('dashboard_1') <!-- Checking permission for dashboard_1 -->
                <ul>
                    <li><a href="{{ route('dashboard.index') }}"><i class="bi bi-circle"></i> Non </a></li>
                </ul>
            @endcan
        </li>

        <li class="menu-label">Users & Roles</li>

        <!-- Users Menu -->
        @can('view_users') <!-- Checking permission for viewing users -->
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
                <div class="menu-title">Users</div>
            </a>
            <ul>
                @can('create_users') <!-- Permission for creating users -->
                    <li><a href="{{ route('dashboard.users.create') }}"><i class="bi bi-circle"></i> Create New User</a></li>
                @endcan
                @can('edit_users') <!-- Permission for editing users -->
                    <li><a href="{{ route('dashboard.users.index') }}"><i class="bi bi-circle"></i> Users Management</a></li>
                @endcan
            </ul>
        </li>
        @endcan

        <!-- Roles Menu -->
        @can('role-list') <!-- Checking permission for viewing roles -->
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-shield-lock"></i></div>
                <div class="menu-title">Roles</div>
            </a>
            <ul>
                @can('role-create') <!-- Permission for creating roles -->
                    <li><a href="{{ route('dashboard.roles.create') }}"><i class="bi bi-circle"></i> Create New Role</a></li>
                @endcan
                @can('role-edit') <!-- Permission for editing roles -->
                    <li><a href="{{ route('dashboard.roles.index') }}"><i class="bi bi-circle"></i> Role Management</a></li>
                @endcan
            </ul>
        </li>
        @endcan

        <li class="menu-label">Posts & Blogs</li>

        <!-- Blog Management -->
        @can('view_blog') <!-- Checking permission for viewing blogs -->
        <li>
            <a href="{{ route('dashboard.blogs.index') }}" class="">
                <div class="parent-icon"><i class="bi bi-book-fill"></i></div>
                <div class="menu-title">Blogs</div>
            </a>
        </li>
        @endcan

        <!-- Blog Creation -->
        @can('create_blog') <!-- Checking permission for creating blogs -->
        <li>
            <a href="{{ route('dashboard.blogs.create') }}" class="">
                <div class="parent-icon"><i class="bi bi-pencil-fill"></i></div>
                <div class="menu-title">Create Blog</div>
            </a>
        </li>
        @endcan

        <!-- Blog Export -->
        @can('export_blog') <!-- Checking permission for exporting blogs -->
        <li>
            <a href="{{ route('dashboard.blogs.export') }}" class="">
                <div class="parent-icon"><i class="bi bi-download"></i></div>
                <div class="menu-title">Export Blogs</div>
            </a>
        </li>
        @endcan

        <!-- Blog Import -->
        {{-- @can('import_blog') <!-- Checking permission for importing blogs -->
        <li>
            <a href="{{ route('dashboard.blogs.import') }}" class="">
                <div class="parent-icon"><i class="bi bi-upload"></i></div>
                <div class="menu-title">Import Blogs</div>
            </a>
        </li>
        @endcan --}}

    </ul>
</aside>
