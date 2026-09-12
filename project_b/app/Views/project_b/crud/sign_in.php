<?= $this->extend('project_b/crud/layouts/main') ?>

<?= $this->section('content') ?>

<div class="wrapper">
    <?php if(isset($validation)):?>
        <div class="alert alert-danger" role="alert" style="font-size: 12px;">
            <?= $validation ?>
        </div>
        <br>
    <?php endif;?>

    <?php if(isset($flashMessage)):?>
        <div class="alert alert-danger" role="alert" style="font-size: 12px;">Entered Password not match!</div>
        <br>
    <?php endif;?>
    <h5><center>Users Login</center></h5>
    <div class="logo">
        <img src="<?php echo base_url()?>project_b/assets/images/innsight_logo.png" alt="">
    </div>
    <div class="text-center mt-4 name">
        InNSight
    </div>
    <form action="<?php echo base_url(); ?>sign_in" method="post" class="p-3 mt-3">
        <div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input type="email" name="email" id="email" value="<?= set_value('email') ?>" placeholder="Email">
        </div>
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input type="password" name="password" id="pwd" value="<?= set_value('password') ?>" placeholder="Password">
        </div>
        <button type="submit" class="btn mt-3">Log in</button>
    </form>
    <div class="text-center fs-6">
        <!-- <a href="#">Forget password?</a> or  -->
         
        <a href="<?php echo base_url()?>sign_up">Sign up</a>
    </div>
</div>

<?= $this->endSection() ?>
