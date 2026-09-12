<?= $this->extend('project_b/crud/layouts/main') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="content">
        <h1>Welcome to Our Website!</h1>
        <p>Get started by logging in or registering.</p>
        <div class="links">
            <a href="<?php echo base_url()?>sign_in">Login</a>
            <a href="<?php echo base_url()?>sign_up">Register</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
