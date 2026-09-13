<?= $this->extend('project_b/crud/layouts/main') ?>

<?= $this->section('content') ?>

<div class="user-login-wrapper">
    <?php if (isset($validation)): ?>
        <div class="alert alert-danger" role="alert" style="font-size: 12px;">
            <?= $validation ?>
        </div>
    <?php endif; ?>

    <?php if (isset($flashMessage)): ?>
        <div class="alert alert-danger" role="alert" style="font-size: 12px;">
            Entered Password not match!
        </div>
    <?php endif; ?>

    <h5 class="user-login-title">
        Users Login
    </h5>


    <!-- SHREE T N LOGO -->
    <div class="user-login-logo">
        <img
            src="<?= base_url('project_b/assets/images/stn/shree_tn_logo.svg') ?>"
            alt="SHREE T N">
    </div>

    <form
        action="<?= base_url('users/login') ?>"
        method="post"
        class="p-2">

        <?= csrf_field() ?>


        <!-- Email -->
        <div class="user-login-form-field">

            <i class="fa fa-user" aria-hidden="true"></i>

            <input
                type="email"
                name="email"
                id="email"
                value="<?= esc(old('email')) ?>"
                placeholder="Email"
                required>

        </div>


        <!-- Password -->
        <div class="user-login-form-field">

            <i class="fa fa-key" aria-hidden="true"></i>

            <input
                type="password"
                name="password"
                id="pwd"
                value="<?= esc(old('password')) ?>"
                placeholder="Password"
                required>

        </div>

        <button
            type="submit"
            class="user-login-btn mt-2">
            Login
        </button>
    </form>

    <div class="user-login-signup">
        Don't have an account?
        <a href="<?= base_url('users/register') ?>">
            Sign up
        </a>
    </div>
</div>

<?= $this->endSection() ?>