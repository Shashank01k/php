<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Admin Login' }}</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <style>
        body {
            min-height: 100vh;
            margin: 0;
            background: #f5f5f5;
        }

        .login-page {
            min-height: 100vh;
            display: flex;
        }

        /* Left side */
        .login-brand {
            width: 50%;
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            background:
                linear-gradient(
                    135deg,
                    rgba(255, 70, 0, 0.95),
                    rgba(220, 0, 0, 0.95)
                ),
                url("{{ asset('assets/images/stn/shree_t_n.svg') }}");

            background-size: cover;
            background-position: center;
        }

        .brand-content {
            text-align: center;
            color: #000;
        }

        .brand-content img {
            width: 280px;
            max-width: 80%;
            height: auto;
            display: block;
            margin: 0 auto 20px;
        }

        .brand-content h2 {
            font-weight: 800;
            margin: 0;
        }

        .brand-content p {
            margin-top: 5px;
            font-size: 14px;
            font-weight: 600;
        }

        /* Right side */
        .login-section {
            width: 50%;
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #ffffff;
            padding: 30px;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 10px;
        }

        .login-card .card-header {
            background: transparent;
            border-bottom: 1px solid #eeeeee;
            padding: 20px 0;
        }

        .login-card .card-header h4 {
            color: #111;
            font-weight: 700;
        }

        .login-card .card-body {
            padding: 25px 0;
        }

        .form-control {
            height: 45px;
            border-radius: 6px;
        }

        .form-control:focus {
            border-color: #ff3d00;
            box-shadow: 0 0 0 0.2rem rgba(255, 61, 0, 0.15);
        }

        .btn-login {
            height: 45px;
            background: #e60000;
            border: none;
            font-weight: 600;
            border-radius: 6px;
        }

        .btn-login:hover {
            background: #c90000;
        }

        /* Mobile */
        @media (max-width: 768px) {

            .login-page {
                display: block;
            }

            .login-brand {
                width: 100%;
                min-height: 260px;
            }

            .brand-content img {
                width: 180px;
            }

            .brand-content h2,
            .brand-content p {
                display: none;
            }

            .login-section {
                width: 100%;
                min-height: auto;
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>

<div class="login-page">

    <!-- LEFT: LOGO / BRAND -->
    <div class="login-brand">

        <div class="brand-content">

            <img
                src="{{ asset('assets/images/stn/shree_t_n.svg') }}"
                alt="SHREE T N">

            <h2>SHREE T N</h2>
            <p>since 2024</p>

        </div>

    </div>


    <!-- RIGHT: LOGIN FORM -->
    <div class="login-section">

        <div class="card shadow-sm login-card">

            <div class="card-header">
                <h4 class="mb-0">Admin Login</h4>
            </div>

            <div class="card-body">

                {{-- Success Message / Error Message --}}
                @include('components.flash_alert_message')


                <form method="POST"
                      action="{{ route('admin.login.submit') }}">

                    @csrf

                    <div class="mb-3">

                        <label for="email" class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email">

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="mb-3">

                        <label for="password" class="form-label">
                            Password
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            required
                            autocomplete="current-password">

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="d-grid gap-2">

                        <button
                            type="submit"
                            class="btn btn-login text-white">
                            Login
                        </button>

                        <a
                            href="{{ url('/') }}"
                            class="btn btn-outline-secondary">
                            <i class="fa fa-home"></i>
                            Home Page
                        </a>

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

</body>
</html>