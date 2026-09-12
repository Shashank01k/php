<?= $this->extend('project_b/crud/layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="fa fa-user me-2"></i>
                        My Profile
                    </h5>
                </div>

                <div class="card-body">

                    <div class="text-center mb-4">
                        <i class="fa fa-user-circle fa-5x text-secondary"></i>
                        <h4 class="mt-2 mb-0">
                            <?= esc($userDataArray['first_name'] . ' ' . $userDataArray['last_name']) ?>
                        </h4>
                        <small class="text-muted">
                            <?= esc($userDataArray['user_name']) ?>
                        </small>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">First Name</div>
                        <div class="col-sm-8">
                            <?= esc($userDataArray['first_name']) ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Last Name</div>
                        <div class="col-sm-8">
                            <?= esc($userDataArray['last_name']) ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Username</div>
                        <div class="col-sm-8">
                            <?= esc($userDataArray['user_name']) ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Email</div>
                        <div class="col-sm-8">
                            <?= esc($userDataArray['email']) ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Phone</div>
                        <div class="col-sm-8">
                            <?= esc($userDataArray['phone']) ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Gender</div>
                        <div class="col-sm-8">
                            <?= esc($userDataArray['gender']) ?>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-4 fw-bold">State</div>
                        <div class="col-sm-8">
                            <?= esc($userDataArray['state_name']) ?>
                        </div>
                    </div>

                    <div class="text-end">
                        <a href="<?= site_url('users/profile/update/' . $userDataArray['id']) ?>"
                           class="btn btn-dark">
                            <i class="fa fa-edit me-1"></i>
                            Edit Profile
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>