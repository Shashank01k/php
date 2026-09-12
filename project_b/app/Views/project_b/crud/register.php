<!-- <!doctype html>
<html lang="en"> -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url()?>/project_b/assets/css/style.css">
    <title>Codeigniter User Registration</title>
</head>

<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>


<body>
    <div class="container martop">
        <div class="col-md-6 center_div">
            <div class="col-5">
                <legend>
                    <b>Register User</b>
                </legend>
                <br>
                <?php if(isset($validation)):?>
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <?= $validation->listErrors() ?>
                        </div>
                    </div>
                    <br>
                <?php endif;?>

                <?php if(isset($flashMessage)):?>
                    <div class="alert alert-success" role="alert">
                         Registered Successfully...
                    </div>
                    <br>
                <?php endif;?>

                <form action="<?php echo base_url(); ?>register" method="POST">
                    <!-- <form action="/register" method="POST"> -->

                            <div class="form-group">
                                <label for="firstname">First Name:</label>
                                <br>
                                <input type="text" name="firstname" placeholder="First Name" value="<?= set_value('firstname') ?>" class="form-control" >
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="text">Last Name:</label>
                                <br>
                                <input type="text" name="lastname" placeholder="Last Name" value="<?= set_value('lastname') ?>" class="form-control" >
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="text">Phone Number:</label>
                                <br>
                                <input type="phone" name="phone" placeholder="Enter Your Mobile Number" value="<?= set_value('phone') ?>" class="form-control" >
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <br>
                                <input type="email" name="email" placeholder="Email" value="<?= set_value('email') ?>" class="form-control" >
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <br>
                                <input type="password" name="password" placeholder="Password" value="<?= set_value('password') ?>" class="form-control" >
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="password">Confirm Password:</label>
                                <br>
                                <input type="password" name="confirmpassword" placeholder="Confirm Password" value="<?= set_value('confirmpassword') ?>" class="form-control" >
                            </div>
                            <br>
                            <div class="for-group">
                                <p>Please select your Gender:</p>
                                <input type="radio" name="gender" id="gender_male" value="male" <?= set_radio('gender', 'male', (set_value('gender') == 'male')) ?> >
                                <label for="male">Male</label>
                                <input type="radio" name="gender" id="gender_female" value="female" <?= set_radio('gender', 'female', (set_value('gender') == 'female')) ?> >
                                <label for="female">Female</label>
                                <input type="radio" name="gender" id="gender_other" value="other" <?= set_radio('gender', 'other', (set_value('gender') == 'other')) ?>>
                                <label for="other">Other</label>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="state">State:</label>
                                <!-- <select id="state" name="state" required> -->
                                <select id="state" name="state">
                                    <option value="">Select State</option>
                                    <?php
                                        foreach($statesArrayData as $statesArrayKey => $statesArrayValue){
                                            // print_R($statesArrayValue); die;
                                            $stateName = $statesArrayValue['state_name'];
                                            $stateId = $statesArrayValue['id'];
                                            ?>
                                                <option value= "<?= $stateId ?>" <?= set_select('state', $stateId, (set_value('state') == $stateId)) ?>><?php echo $stateName;?> </option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <br />
                            <div class="form-group buttons">
                                <button type="submit" class="btn btn-dark">SIGNUP</button>
                            <!-- </div>
                            <div class="form-group"> -->
                                <button type="reset" class="btn btn-black">RESET</button>
                            </div>
                </form>
            </div>
        </div>
    </div>
</body>
<!-- </html> -->

<?= $this->endSection() ?>