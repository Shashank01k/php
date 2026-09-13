<div class="card shadow-sm mb-4">

    <div class="card-header">
        <h5 class="mb-0">
            <i class="fa fa-user me-2"></i>
            My Profile
        </h5>
    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-3">
                <strong>Name</strong>
                <p><?= esc($userModel['user_name'] ?? '-') ?></p>
            </div>

            <div class="col-md-3">
                <strong>Email</strong>
                <p><?= esc($userModel['email'] ?? '-') ?></p>
            </div>

            <div class="col-md-3">
                <strong>Phone</strong>
                <p><?= esc($userModel['phone'] ?? '-') ?></p>
            </div>

            <div class="col-md-3">
                <strong>Role</strong>
                <p>Admin</p>
            </div>
        </div>
    </div>
</div>