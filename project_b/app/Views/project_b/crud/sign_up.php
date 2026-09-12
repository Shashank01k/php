<?= $this->extend('project_b/crud/layouts/main') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row py-2 mt-2 align-items-center">
        <!-- For Demo Purpose -->
        <div class="col-md-5 pr-lg-5 mb-5 mb-md-0 text-center">
            <img src="https://bootstrapious.com/i/snippets/sn-registeration/illustration.svg" alt="" class="img-fluid mb-3 d-none d-md-block">
            <h1>Create an Account</h1>
               <i class="fa fa-user-plus"
                style="font-size: 150px; color: #007bff;">
                </i>

                <h1 class="mt-4">Create an Account</h1>

                <p class="text-muted">
                    Join us today and create your account.
                </p>
        </div>

        <!-- Registeration Form -->
        <div class="col-md-7 col-lg-6 ml-auto">
            <form action="<?php echo base_url(); ?>sign_up" method="POST">
                <div class="row">
                    
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
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>
                        <input type="text" name="firstname" placeholder="First Name" value="<?= set_value('firstname') ?>" class="form-control bg-white border-left-0 border-md">
                    </div>
                        
                    <!-- Last Name -->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>
                        <input type="text" name="lastname" placeholder="Last Name" value="<?= set_value('lastname') ?>" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- Email Address -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-envelope text-muted"></i>
                            </span>
                        </div>
                        <input id="email" type="email" name="email" value="<?= set_value('email') ?>" placeholder="Email Address" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- Phone Number -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-phone-square text-muted"></i>
                            </span>
                        </div>
                        <select id="countryCode" name="countryCode" style="max-width: 80px" class="custom-select form-control bg-white border-left-0 border-md h-100 font-weight-bold text-muted">
                            <option value="">+91</option>
                            <option value="">91</option>
                        </select>
                        <input id="phone" type="tel" name="phone" placeholder="Phone Number" value="<?= set_value('phone') ?>" class="form-control bg-white border-md border-left-0 pl-3">
                    </div>

                    <!-- Gender -->
                    <div class="input-group col-lg-12 mb-4" class="form-control">
                        <p class ="px-2">Gender:</p>
                        <div class="input-group-prepend">
                            <span class="px-2">
                                <input type="radio" name="gender" id="gender_male" value="male" <?= set_radio('gender', 'male', (set_value('gender') == 'male')) ?> >
                                <label for="male">Male</label>
                            </span>
                            <span class="px-2">
                                <input type="radio" name="gender" id="gender_female" value="female" <?= set_radio('gender', 'female', (set_value('gender') == 'female')) ?> >
                                <label for="female">Female</label>
                            </span>
                            <span class="px-2">
                                <input type="radio" name="gender" id="gender_other" value="other" <?= set_radio('gender', 'other', (set_value('gender') == 'other')) ?>>
                                <label for="other">Other</label>
                            </span>
                        </div>
                    </div>

                    <!-- State -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-black-tie text-muted"></i>
                            </span>
                        </div>
                        <select id="state" name="state" class="form-control custom-select bg-white border-left-0 border-md">
                            <option value="">Select State</option>
                            <?php if (!empty($statesArrayData)): ?>

                                <?php
                                    foreach($statesArrayData as $statesArrayKey => $statesArrayValue){
                                        $stateName = $statesArrayValue['name'];
                                        $stateId = $statesArrayValue['id'];
                                        ?>
                                            <option value= "<?= $stateId ?>" <?= set_select('state', $stateId, (set_value('state') == $stateId)) ?>><?php echo $stateName;?> </option>
                                        <?php
                                    }
                                ?>
                            <?php else: ?>
                                <option value="">No states available</option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <!-- Password -->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>
                        <input id="password" type="password" name="password" value="<?= set_value('password') ?>" placeholder="Password" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- Password Confirmation -->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>
                        <input id="confirmpassword" type="text" name="confirmpassword" value="<?= set_value('confirmpassword') ?>" placeholder="Confirm Password" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group col-lg-12 mx-auto mb-0">
                        <button type="submit" class=" btn btn-primary btn-block py-2 font-weight-bold">Create your account</button>
                    </div>

                    <!-- Divider Text -->
                    <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-4">
                        <div class="border-bottom w-100 ml-5"></div>
                        <span class="px-2 small text-muted font-weight-bold text-muted">OR</span>
                        <div class="border-bottom w-100 mr-5"></div>
                    </div>

                    <!-- Already Registered -->
                    <div class="text-center w-100">
                        <p class="text-muted font-weight-bold">Already Registered? <a href="<?php echo base_url(); ?>sign_in" class="text-primary ml-2">Log in</a></p>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('input, select').on('focus', function () {
            $(this).parent().find('.input-group-text').css('border-color', '#80bdff');
        });
        $('input, select').on('blur', function () {
            $(this).parent().find('.input-group-text').css('border-color', '#ced4da');
        });
    });
</script>

<?= $this->endSection() ?>