<aside id="sidebar" class="sidebar">

    <div class="sidebar-header">
        <span class="sidebar-title">Menu</span>
    </div>

    <div class="sidebar-menu">

        @php
            $userType = (int) session('user_type');
        @endphp


        @if (
            $userType === \App\Models\User::SUPER_ADMIN ||
            $userType === \App\Models\User::ADMIN ||
            $userType === \App\Models\User::SUB_ADMIN
        )

            <!-- Admin Dashboard -->
            <a href="{{ url('admin/index') }}" class="sidebar-link">
                <i class="fa fa-dashboard"></i>
                <span>Admin Dashboard</span>
            </a>

        @else

            <!-- Normal User Dashboard -->
            <a href="{{ url('users/dashboard') }}" class="sidebar-link">
                <i class="fa fa-dashboard"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ url('users/assignments') }}" class="sidebar-link">
                <i class="fa fa-tasks"></i>
                <span>My Assignments</span>
            </a>

        @endif


        @if ($userType === \App\Models\User::ADMIN)

            <a href="{{ url('admin/users/register') }}" class="sidebar-link">
                <i class="fa fa-user-plus"></i>
                <span>Add User</span>
            </a>

            <a href="{{ url('admin/seeder') }}" class="sidebar-link">
                <i class="fa fa-database"></i>
                <span>Seeder</span>
            </a>

            <a href="{{ url('admin/assignments') }}" class="sidebar-link">
                <i class="fa fa-tasks"></i>
                <span>Assignments</span>
            </a>

            <a href="{{ url('admin/documentation') }}" class="sidebar-link">
                <i class="fa fa-book"></i>
                <span>Documentation</span>
            </a>

        @endif

    </div>

</aside>