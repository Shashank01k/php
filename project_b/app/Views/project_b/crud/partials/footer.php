<footer class="site-footer">

    <!-- Main Footer -->
    <div class="container-fluid footer-main">

        <div class="row">

            <!-- ABOUT -->
            <div class="col-6 col-md-3 col-lg-2 footer-column">

                <h6>ABOUT</h6>

                <a href="<?= site_url('contact') ?>">Contact Us</a>
                <a href="<?= site_url('about') ?>">About Us</a>
                <a href="<?= site_url('careers') ?>">Careers</a>
                <a href="<?= site_url('terms') ?>">Terms</a>
                <a href="<?= site_url('privacy') ?>">Privacy</a>

            </div>


            <!-- QUICK LINKS -->
            <div class="col-6 col-md-3 col-lg-2 footer-column">

                <h6>QUICK LINKS</h6>

                <a href="<?= site_url('/') ?>">Home</a>
                <a href="<?= site_url('dashboard') ?>">Dashboard</a>
                <a href="<?= site_url('sign_up') ?>">Register</a>

                <?php if (session()->get('isLoggedIn')): ?>

                    <a href="<?= site_url('profile') ?>">
                        My Profile
                    </a>

                <?php else: ?>

                    <a href="<?= site_url('login') ?>">
                        Login
                    </a>

                <?php endif; ?>

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
                        <?= esc(commonData('companyName')) ?>
                    </strong>
                </p>

                <p>
                    Email:
                    <a href="mailto:support@example.com">
                        support@example.com
                    </a>
                </p>

                <p>
                    Phone:
                    <a href="tel:+919999999999">
                        +91 99999 99999
                    </a>
                </p>

                <p>
                    Address: Your Company Address,
                    India
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
                        © <?= date('Y') ?>
                        <?= esc(commonData('companyName')) ?>
                    </span>

                </div>


                <!-- Center -->
                <div class="col-md-4 text-center">

                    <a href="<?= site_url('terms') ?>">
                        Terms
                    </a>

                    <span class="mx-2">|</span>

                    <a href="<?= site_url('privacy') ?>">
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