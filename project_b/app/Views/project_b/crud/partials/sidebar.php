<aside id="sidebar" class="sidebar">

    <div class="sidebar-header">
        <span class="sidebar-title">Menu</span>
    </div>

    <div class="sidebar-menu">
        <?php 
            $userType = (int) session()->get('user_type');

            if ($userType === App\Models\User::SUPER_ADMIN ||
                  $userType === App\Models\User::ADMIN ||
                  $userType === App\Models\User::SUB_ADMIN): ?>

            <!-- Admin Dashboard -->
            <a href="<?= base_url('admin/index') ?>" class="sidebar-link">
                <i class="fa fa-dashboard"></i>
                <span>Admin Dashboard</span>
            </a>

        <?php else: ?>
            <!-- Normal User Dashboard -->
            <a href="<?= base_url('users/dashboard') ?>" class="sidebar-link">
                <i class="fa fa-dashboard"></i>
                <span>Dashboard</span>
            </a>
            <a href="<?= base_url('users/assignments') ?>" class="sidebar-link">
                <i class="fa fa-tasks"></i>
                <span>
                    My Assignments
                </span>
            </a>
        <?php endif; ?>

        <?php 
            if ($userType === App\Models\User::ADMIN): ?>
                <a href="<?= base_url('admin/users/register') ?>" class="sidebar-link">
                    <i class="fa fa-user-plus"></i>
                    <span>Add User</span>
                </a>

                <a href="<?= base_url('admin/seeder') ?>" class="sidebar-link">
                    <i class="fa fa-database"></i>
                    <span>Seeder</span>
                </a>

                <a href="<?= base_url('admin/assignments') ?>" class="sidebar-link">
                    <i class="fa fa-tasks"></i>
                    <span>Assignments</span>
                </a>

                <a href="<?= base_url('admin/documentation') ?>" class="sidebar-link">
                    <i class="fa fa-book"></i>
                    <span>Documentation</span>
                </a>
            <?php endif; 
        ?>
    </div>
</aside>