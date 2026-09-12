<?= $this->extend('project_b/crud/layouts/main') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="col-md-6">
        <div class="col-12">
            <?php if(isset($message)):?>
                <div class="col-12">
                    <div class="alert alert-info" role="alert">
                        <?= $message?>
                    </div>
                </div>
                <br>
            <?php endif;?>
            <h4>Click Submit Button for insert Dummy User Data</h4>
            <form action="<?php echo base_url() ?>seeder" method="POST">
                <div class="form-group">
                    <input type="number" name="number" id="number" value="" max="20" min="1" >
                </div>
                <div>
                    <a href="<?php echo base_url() ?>seeder">
                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>