<?= $this->extend('project_b/crud/layouts/main') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="col-md-12">
        <div class="col-6">
            <legend>
                <b>Update User Data</b>
            </legend>
            <br>
            <?php if(isset($validation)):?>
                <div class="alert alert-danger" role="alert">
                    <?= $validation->listErrors() ?>
                </div>
                <div class="col-12">
                </div>
                <br>
            <?php endif;?>

            <?php if(isset($flashMessage)):?>
                <div class="alert alert-success" role="alert">
                <?= $flashMessage ?>
                </div>
                <br>
            <?php endif;?>

            <?php if (session()->has('updateMessage')):?>
                <div class="alert alert-success" role="alert">
                    <?= session()->get('updateMessage') ?>
                </div>
                <br>
            <?php endif;?>

            <form action="<?php echo base_url(); ?>update/<?php echo $userDataArray['id'];?>" method="POST">
                <!-- <form action="/register" method="POST"> -->

                        <div class="form-group">
                            <label for="firstname">First Name:</label>
                            <br>
                            <input type="text" name="firstname" placeholder="First Name" value="<?php echo $userDataArray['first_name'];?>" class="form-control" >
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="text">Last Name:</label>
                            <br>
                            <input type="text" name="lastname" placeholder="Last Name" value="<?php echo $userDataArray['last_name'];?>" class="form-control" >
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="text">Phone Number:</label>
                            <br>
                            <input type="phone" name="phone" placeholder="Enter Your Mobile Number" value="<?php echo $userDataArray['phone'];?>" class="form-control" >
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <br>
                            <input type="email" name="email" placeholder="Email" value="<?php echo $userDataArray['email'];?>" class="form-control" >
                        </div>
                        <br>
                        <div class="for-group">
                            <p>Please select your Gender:</p>
                            <input type="radio" name="gender" id="gender_male" value="male" <?= set_radio('gender', 'male', ($userDataArray['gender'] == 'male')) ?> >
                            <label for="male">Male</label>
                            <input type="radio" name="gender" id="gender_female" value="female" <?= set_radio('gender', 'female', ($userDataArray['gender'] == 'female')) ?> >
                            <label for="female">Female</label>
                            <input type="radio" name="gender" id="gender_other" value="other" <?= set_radio('gender', 'other',($userDataArray['gender'] == 'other')) ?> >
                            <label for="other">Other</label>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="state">State:</label>
                            <br>
                            <select id="state" name="state" required>
                            <!-- <select id="state" name="state"> -->
                                <option value="">Select State</option>
                                    <?php
                                        foreach($statesArrayData as $statesArrayKey => $statesArrayValue){
                                            $stateName = $statesArrayValue['name'];
                                            $stateId = $statesArrayValue['id'];
                                            ?>
                                                <option value="<?= $stateId ?>" <?= set_select('state', $stateId, ($userDataArray['state'] == $stateId)) ?>><?php echo $stateName;?></option>
                                            <?php
                                        }
                                    ?>
                            </select>
                        </div>
                        <br />
                        <div class="form-group buttons">
                            <button type="submit" class="btn btn-dark">UPDATE</button>
                        </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>