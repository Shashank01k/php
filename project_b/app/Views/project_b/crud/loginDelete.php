
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="<?php echo base_url()?>/project_b/assets/css/style.css">
    <title>Codeigniter User Login</title>
</head>
<body>
    <div class="container martop">
        <div class="col-md-6 center_div">
            <h2>Admin Login </h2>
            <?php if(isset($validation)):?>
                <?PHP 
                    // PRINT_r($validation); die;
                ?>
                <div class="alert alert-danger" role="alert">
                    <?= $validation ?>
                </div>
                <br>
            <?php endif;?>

            <?php if(isset($flashMessage)):?>
                <div class="alert alert-success" role="alert">
                Entered Password not match!
                </div>
                <br>
            <?php endif;?>

            <!-- <form action="<?php // echo base_url(); ?>register" method="post"> -->
            <form action="<?php echo base_url(); ?>login" method="post">
                <div class="form-group">
                    <label for="email"></label>
                    <input type="email" name="email" id = "email" value="<?= set_value('email') ?>" placeholder="Emial" class="form-control" >
                </div>
                <br>
                <div class="form-group">
                    <label for="password"></label>
                    <input type="password" name="password" id = "password" placeholder="Password" value="<?= set_value('password') ?>" class="form-control" >
                </div>
                <br />
                <div class="form-group">
                    <button type="submit" class="btn btn-success" class="form-control" >LOGIN</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>