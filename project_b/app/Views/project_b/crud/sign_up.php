<?= $this->extend('project_b/crud/layouts/main') ?>

<?= $this->section('content') ?>

<div class="signup-page">

    <div class="signup-wrapper">

        <div class="signup-card">

            <div class="row g-0">

                <!-- LEFT SIDE -->
                <div class="col-md-5 signup-left">

                    <h2>Create an Account</h2>

                    <i class="fa fa-user-plus signup-icon"></i>

                    <h4>Create an Account</h4>

                    <p>
                        Join us today and create your account.
                    </p>

                </div>


                <!-- RIGHT SIDE -->
                <div class="col-md-7 signup-right">

                    <h3>Create your account</h3>

                    <form
                        action="<?= site_url('sign_up') ?>"
                        method="post"
                        class="signup-form"
                        >

                        <!-- Error Message -->
                        <?php if(isset($validation)):?>
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    <?= $validation->listErrors() ?>
                                </div>
                            </div>
                            <br>
                        <?php endif;?>

                        <!-- Success Message -->
                        <?php if(isset($flashMessage)):?>
                            <div class="col-12">
                                <div class="alert alert-success" role="alert">
                                    Registered Successfully...
                                </div>
                            </div>
                            <br>
                        <?php endif;?>

                        <!-- First Name -->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>

                                <input
                                    type="text"
                                    name="firstname"
                                    class="form-control"
                                    placeholder="First Name"
                                    value="<?= set_value('firstname') ?>"
                                >

                            </div>

                        </div>


                        <!-- Last Name -->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>

                                <input
                                    type="text"
                                    name="lastname"
                                    class="form-control"
                                    placeholder="Last Name"
                                    value="<?= set_value('lastname') ?>"
                                >

                            </div>

                        </div>


                        <!-- Email -->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="fa fa-envelope"></i>
                                </span>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="Email Address"
                                    value="<?= set_value('email') ?>"
                                >

                            </div>

                        </div>


                        <!-- Phone -->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="fa fa-phone"></i>
                                </span>

                                <span class="input-group-text">
                                    +91
                                </span>

                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    placeholder="Phone Number"
                                    value="<?= set_value('phone') ?>"
                                >

                            </div>

                        </div>


                        <!-- Gender -->
                        <div class="form-group">

                            <label class="me-3">
                                Gender:
                            </label>

                            <div class="form-check form-check-inline">

                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="gender"
                                    value="male"
                                >

                                <label class="form-check-label">
                                    Male
                                </label>

                            </div>

                            <div class="form-check form-check-inline">

                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="gender"
                                    value="female"
                                >

                                <label class="form-check-label">
                                    Female
                                </label>

                            </div>

                            <div class="form-check form-check-inline">

                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="gender"
                                    value="other"
                                >

                                <label class="form-check-label">
                                    Other
                                </label>

                            </div>

                        </div>


                        <!-- State -->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="fa fa-map-marker"></i>
                                </span>

                                <select
                                    name="state"
                                    class="form-select"
                                >

                                    <option value="">
                                        Select State
                                    </option>

                                    <?php if (!empty($statesArrayData)): ?>

                                        <?php foreach ($statesArrayData as $state): ?>

                                            <option
                                                value="<?= $state['id'] ?>"
                                                <?= set_select(
                                                    'state',
                                                    $state['id'],
                                                    set_value('state') == $state['id']
                                                ) ?>
                                            >
                                                <?= esc($state['name']) ?>
                                            </option>

                                        <?php endforeach; ?>

                                    <?php endif; ?>

                                </select>

                            </div>

                        </div>


                        <!-- Password -->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="fa fa-lock"></i>
                                </span>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Password"
                                >

                            </div>

                        </div>


                        <!-- Confirm Password -->
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="fa fa-lock"></i>
                                </span>

                                <input
                                    type="password"
                                    name="confirmpassword"
                                    class="form-control"
                                    placeholder="Confirm Password"
                                >

                            </div>

                        </div>


                        <!-- Submit -->
                        <button
                            type="submit"
                            class="btn btn-primary signup-submit"
                        >
                            Create your account
                        </button>

                    </form>


                    <!-- Divider -->
                    <div class="signup-divider">
                        OR
                    </div>


                    <!-- Login -->
                    <p class="signup-login">

                        Already Registered?

                        <a href="<?= site_url('users/login') ?>">
                            Log in
                        </a>

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>