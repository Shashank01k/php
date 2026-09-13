<?= $this->extend('project_b/crud/layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">
    <div class="row justify-content-center">

        <div class="mb-4">
            <h3 class="fw-bold">Dashboard</h3>
            <p class="text-muted mb-0">
                Welcome, <?= esc(session()->get('firstname')) ?>!
            </p>
        </div>

        <div class="row g-4">

            <!-- Profile -->
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fa fa-user-circle fa-2x me-3"></i>
                            <h5 class="mb-0">My Profile</h5>
                        </div>

                        <p class="text-muted">
                            View and manage your profile information.
                        </p>

                        <a href="<?= base_url('users/profile') ?>"
                        class="btn btn-dark">
                            View Profile
                        </a>
                    </div>
                </div>
            </div>

            <!-- Account -->
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fa fa-cog fa-2x me-3"></i>
                            <h5 class="mb-0">Account Settings</h5>
                        </div>

                        <p class="text-muted">
                            Manage your account settings.
                        </p>

                        <a href="<?= base_url('users/profile/update/'. session()->get('id')) ?>"
                        class="btn btn-dark">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <!-- Logout -->
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fa fa-sign-out fa-2x me-3"></i>
                            <h5 class="mb-0">Logout</h5>
                        </div>

                        <p class="text-muted">
                            Logout from your account.
                        </p>

                        <a href="<?= base_url('users/logout') ?>"
                        class="btn btn-danger">
                            Logout
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>