@php
    $footerContactUs = commonData('footerDetails')['contactUs'];
@endphp

<footer class="site-footer">

    <!-- Main Footer -->
    <div class="container-fluid footer-main">

        <div class="row">

            <!-- ABOUT -->
            <div class="col-6 col-md-3 col-lg-2 footer-column">

                <h6>ABOUT</h6>

                <a href="{{ route('contact') }}">Contact Us</a>
                <a href="{{ route('about') }}">About Us</a>
                <a href="{{ route('careers') }}">Careers</a>
                <a href="{{ route('terms') }}">Terms</a>
                <a href="{{ route('privacy') }}">Privacy</a>

            </div>


            <!-- QUICK LINKS -->
            <div class="col-6 col-md-3 col-lg-2 footer-column">

                <h6>QUICK LINKS</h6>

                <a href="{{ url('/') }}">Home</a>
                <a href="{{ route('users.register') }}">Register</a>
                
                @if (session('isLoggedIn'))
                    <a href="{{ route('users.dashboard') }}">Dashboard</a>

                    <a href="{{ route('login') }}">
                        My Profile
                    </a>

                @else

                    <a href="{{ route('login') }}">
                        Login
                    </a>

                @endif

            </div>


            <!-- HELP -->
            <div class="col-6 col-md-3 col-lg-2 footer-column">

                <h6>HELP</h6>

                <a href="#">Payments</a>
                <a href="#">Shipping</a>
                <a href="#">FAQ</a>
                <a href="#">Support</a>
                <a href="#">Contact Us</a>

            </div>


            <!-- COMPANY -->
            <div class="col-6 col-md-3 col-lg-2 footer-column">

                <h6>COMPANY</h6>

                <a href="#">Our Services</a>
                <a href="#">Technology</a>
                <a href="#">Blog</a>
                <a href="#">Updates</a>

            </div>


            <!-- CONTACT -->
            <div class="col-12 col-lg-4 footer-contact">

                <h6>CONTACT US</h6>

                <p>
                    <strong>
                        {{ commonData('companyName') }}
                    </strong>
                </p>

                <p>
                    Email:
                    <a href="mailto:{{ $footerContactUs['email'] }}">
                        {{ $footerContactUs['email'] }}
                    </a>
                </p>

                <p>
                    Phone:
                    <a href="tel:{{ $footerContactUs['phone'] }}">
                        {{ $footerContactUs['phone'] }}
                    </a>
                </p>

                <p>
                    Address: {{ $footerContactUs['address'] }}
                </p>


                <!-- Social -->
                <div class="footer-social">

                    <a href="#" aria-label="Facebook">
                        <i class="fa fa-facebook"></i>
                    </a>

                    <a href="#" aria-label="Twitter">
                        <i class="fa fa-twitter"></i>
                    </a>

                    <a href="#" aria-label="LinkedIn">
                        <i class="fa fa-linkedin"></i>
                    </a>

                    <a href="#" aria-label="GitHub">
                        <i class="fa fa-github"></i>
                    </a>

                    <a href="#" aria-label="Instagram">
                        <i class="fa fa-instagram"></i>
                    </a>

                </div>

            </div>

        </div>

    </div>


    <!-- Bottom Footer -->
    <div class="footer-bottom">

        <div class="container-fluid">

            <div class="row align-items-center">

                <!-- Left -->
                <div class="col-md-4 text-center text-md-start">

                    <span>
                        © {{ date('Y') }}
                        {{ commonData('companyName') }}
                    </span>

                </div>


                <!-- Center -->
                <div class="col-md-4 text-center">

                    <a href="{{ route('terms') }}">
                        Terms
                    </a>

                    <span class="mx-2">|</span>

                    <a href="{{ route('privacy') }}">
                        Privacy
                    </a>

                </div>


                <!-- Right -->
                <div class="col-md-4 text-center text-md-end">

                    <span>
                        All rights reserved.
                    </span>

                </div>

            </div>

        </div>

    </div>

</footer>