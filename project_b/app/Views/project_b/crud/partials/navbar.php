<?php use App\Models\User; ?>

<?php
    $userModal = getLoggedInUser()['userModel'];
    $loggedinUserid = $userModal['id'];
    $userType = $userModal['user_type'];

    $userTypeUrl = 'users';
    if($userType == User::ADMIN) {
        $userTypeUrl = 'admin';
    }
?>

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <!-- Sidebar Toggle -->
            <button type="button"
                    class="btn btn-dark me-2"
                    id="sidebarToggle">
                <i class="fa fa-bars"></i>

            </button>

            <!-- Company Name -->
            <a class="navbar-brand fw-bold"
               href="<?= site_url('/') ?>">
                <a class="navbar-brand d-flex align-items-center" href="<?= base_url('/') ?>">
                   <img
                       src="<?= base_url('project_b/assets/images/stn/shree_tn_logo.svg') ?>"
                       alt="SHREE T N"
                       height="50"
                       class="me-2"
                   >
                   <?= commonData('companyName') ?>
               </a>
            </a>
        </div>

        <!-- Right Side Profile -->
        <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle"
                    type="button"
                    id="profileDropdown"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">

                <i class="fa fa-user-circle me-1"></i>
                User

            </button>

            <ul class="dropdown-menu dropdown-menu-end shadow"
                aria-labelledby="profileDropdown">
                <li>
                    <a class="dropdown-item"
                       href="<?= site_url($userTypeUrl.'/profile') ?>">
                        <i class="fa fa-user me-2"></i>
                        My Profile
                    </a>
                </li>
                <li>
                    <a class="dropdown-item"
                       href="<?= site_url($userTypeUrl.'/profile/update/' . $loggedinUserid) ?>">
                        <i class="fa fa-edit me-2"></i>
                        Edit Profile
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item text-danger"
                       href="<?= site_url($userTypeUrl.'/logout') ?>">
                        <i class="fa fa-sign-out me-2"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>