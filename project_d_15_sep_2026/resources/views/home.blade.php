<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ commonData('companyName') ?? 'Our Website' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f8f9fa;
        }

        .navbar-brand {
            font-weight: 700;
        }

        .hero {
            min-height: 600px;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #0d6efd, #084298);
            color: #fff;
        }

        .hero h1 {
            font-size: 52px;
            font-weight: 700;
        }

        .hero p {
            font-size: 19px;
            max-width: 650px;
            line-height: 1.7;
        }

        .hero-buttons .btn {
            padding: 12px 28px;
            margin-right: 10px;
        }

        .section-title {
            font-weight: 700;
            margin-bottom: 15px;
        }

        .feature-card {
            background: #fff;
            border: 0;
            border-radius: 12px;
            padding: 35px 25px;
            height: 100%;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            font-size: 40px;
            margin-bottom: 20px;
            color: #0d6efd;
        }

        .about-section {
            background: #fff;
        }

        footer {
            background: #212529;
            color: #fff;
            padding: 25px 0;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <div class="container">

            <a class="navbar-brand d-flex align-items-center"
               href="{{ route('home') }}">

                <img
                    src="{{ commonData('stnLogoPath') }}"
                    alt="SHREE T N"
                    height="50"
                    class="me-2"
                >

                {{ commonData('companyName') ?? 'Our Website' }}

            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar"
                aria-controls="mainNavbar"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">

                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item">
                        <a class="nav-link active"
                           href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#about">
                            About
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#services">
                            Services
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#contact">
                            Contact
                        </a>
                    </li>

                    <li class="nav-item ms-lg-3">
                        <a href="{{ url('users/login') }}"
                           class="btn btn-primary">
                            Sign In
                        </a>
                    </li>

                </ul>

            </div>

        </div>

    </nav>


    <!-- Hero -->
    <section class="hero">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-8">

                    <h1>
                        Welcome to Our Website
                    </h1>

                    <p>
                        Welcome to our website. We provide a simple, secure and
                        user-friendly platform designed to make your experience
                        easy and efficient.
                    </p>

                    <div class="hero-buttons mt-4">

                        <a href="{{ url('users/register') }}"
                           class="btn btn-light">
                            Get Started
                        </a>

                        <a href="{{ url('users/login') }}"
                           class="btn btn-outline-light">
                            Sign In
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- Services -->
    <section id="services" class="py-5">

        <div class="container">

            <div class="text-center mb-5">

                <h2 class="section-title">
                    What We Offer
                </h2>

                <p class="text-muted">
                    Everything you need in one simple platform.
                </p>

            </div>

            <div class="row g-4">

                <div class="col-md-4">

                    <div class="feature-card text-center">

                        <i class="fa fa-user feature-icon"></i>

                        <h4>
                            User Management
                        </h4>

                        <p class="text-muted">
                            Easily manage your account and personal information
                            from one place.
                        </p>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="feature-card text-center">

                        <i class="fa fa-lock feature-icon"></i>

                        <h4>
                            Secure Platform
                        </h4>

                        <p class="text-muted">
                            Your account and information are protected with
                            secure authentication.
                        </p>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="feature-card text-center">

                        <i class="fa fa-dashboard feature-icon"></i>

                        <h4>
                            Easy Dashboard
                        </h4>

                        <p class="text-muted">
                            Access important information and features through
                            a simple dashboard.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- About -->
    <section id="about" class="about-section py-5">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-md-6">

                    <h2 class="section-title">
                        About Our Website
                    </h2>

                    <p class="text-muted">
                        Our platform is designed to provide users with a
                        convenient and reliable online experience. Whether you
                        are creating an account, managing your profile or
                        accessing your dashboard, everything is kept simple
                        and easy to use.
                    </p>

                    <a href="{{ url('users/register') }}"
                       class="btn btn-primary">
                        Join Us
                    </a>

                </div>

                <div class="col-md-6 text-center">

                    <i class="fa fa-globe"
                       style="font-size:180px;color:#0d6efd;">
                    </i>

                </div>

            </div>

        </div>

    </section>


    <!-- Contact -->
    <section id="contact" class="py-5">

        <div class="container text-center">

            <h2 class="section-title">
                Get Started Today
            </h2>

            <p class="text-muted mb-4">
                Create your account and start using our platform.
            </p>

            <a href="{{ url('users/register') }}"
               class="btn btn-primary btn-lg">
                Create Account
            </a>

        </div>

    </section>


    <!-- Footer -->
    <footer>

        <div class="container text-center">

            <p class="mb-0">

                &copy; {{ date('Y') }}

                {{ commonData('companyName') ?? 'Our Website' }}.

                All Rights Reserved.

            </p>

        </div>

    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>