@php
    use App\Models\User;

    $loggedInUser = getLoggedInUser();
    $user = $loggedInUser['userModel'] ?? null;

    $loggedinUserid = $user?->id;
    $userType = $user?->user_type;

    $userTypeUrl = 'users';

    if ($userType === User::ADMIN) {
        $userTypeUrl = 'admin';
    }
@endphp

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">

        <div class="d-flex align-items-center">

            <!-- Sidebar Toggle -->
            <button
                type="button"
                class="btn btn-dark me-2"
                id="sidebarToggle"
            >
                <i class="fa fa-bars"></i>
            </button>

            <!-- Company Name -->
            <a
                class="navbar-brand d-flex align-items-center"
                href="{{ url('/') }}"
            >
                <img
                    src="{{ commonData('stnLogoPath') }}"
                    alt="SHREE T N"
                    height="50"
                    class="me-2"
                >

                {{ commonData('companyName') }}
            </a>

        </div>


        <!-- Right Side Profile -->
        <div class="dropdown">

            <button
                class="btn btn-dark dropdown-toggle"
                type="button"
                id="profileDropdown"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >
                <i class="fa fa-user-circle me-1"></i>
                User
            </button>


            <ul
                class="dropdown-menu dropdown-menu-end shadow"
                aria-labelledby="profileDropdown"
            >

                <li>
                    <a
                        class="dropdown-item"
                        href="{{ url($userTypeUrl . '/profile') }}"
                    >
                        <i class="fa fa-user me-2"></i>
                        My Profile
                    </a>
                </li>


                <li>
                    <a
                        class="dropdown-item"
                        href="{{ url($userTypeUrl . '/profile/update/' . $loggedinUserid) }}"
                    >
                        <i class="fa fa-edit me-2"></i>
                        Edit Profile
                    </a>
                </li>


                <li>
                    <hr class="dropdown-divider">
                </li>


                <li>
                    <a
                        class="dropdown-item text-danger"
                        href="{{ url($userTypeUrl . '/logout') }}"
                    >
                        <i class="fa fa-sign-out me-2"></i>
                        Logout
                    </a>
                </li>

            </ul>

        </div>

    </div>
</nav>