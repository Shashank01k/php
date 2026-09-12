<?= $this->extend('project_b/crud/layouts/main') ?>

<?= $this->section('content') ?>

<h4>Welcome To User Dashboard</h4>

<div class="container">
    <?php if($total > 0):?>

    <table class="table">
        <thead>
        <tr>
            <th>
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <button class="dropdown-item" onclick="selects()">SELECT</button>
                        <button class="dropdown-item" onclick="deSelect()">DESELECT</button>
                        <button class="dropdown-item" onclick="deleteAllRows()">DELETE</button>
                    </div>
                </div>
            </th>
            <th>Sr.No.</th>
            <th>USER NAME</th>
            <th>PHONE</th>
            <th>EMAIL ID</th>
            <th>GENDER</th>
            <th>STATE</th>
            <th>CREATED DATE</th>
            <!-- <th>MODIFIED DATE</th> -->
            <th>ACTION</th>
        </tr>
        </thead>
        <tbody>
            <?php 
                foreach($userDataArray as $userDataKey => $userDataValue) {
                    $userId = $userDataValue->u_id;
                    $tempUserName = $userDataValue->user_name;
                    $userName = $userDataValue->user_name;
                    $tempStateName = $userDataValue->name;
                    $stateName = $userDataValue->name;

                    if(strlen($userName) >= 10){
                        $userName = substr($userName,0,10).'...';
                    }
                    if(strlen($stateName) >= 12){
                        $stateName = substr($stateName,0,12).'...';
                    }
                    ?>
                    <tr>
                        <td>
                            <!-- Checkbox for selecting individual user -->
                            <input type="checkbox" name="chkRowId" value="<?php echo $userId; ?>">
                        </td>
                        <td><?php echo $userId ?></td>
                        <td>
                            <div data-toggle="tooltip" value="<?= $tempUserName ?>" title="<?= $tempUserName ?>" id="myInput" onclick="copyUserNameValue('<?=  $tempUserName ?>')">
                                <?php echo ucwords($userName); ?> 
                            </div>
                        </td>
                        <td><?php echo $userDataValue->phone; ?></td>
                        <td><?php echo $userDataValue->email; ?></td>
                        <td><?php echo ucfirst($userDataValue->gender); ?></td>
                        <td>
                            <div data-toggle="tooltip" title="<?= $tempStateName ?>">
                                <?php echo $stateName; ?> 
                            </div>
                        </td>
                        <td><?php echo date('d F Y', strtotime($userDataValue->created_at)); ?></td>
                        <td>
                            <a href="<?php echo base_url() ?>update/<?php echo $userDataValue->u_id;?>">
                                <button type="submit" class="btn btn-primary">EDIT</button>
                            </a>
                            <a onclick="return confirm('Are you sure want to move to trash?')" href="<?php echo base_url() ?>delete/<?php echo $userDataValue->u_id;?>">
                                <button type="submit" class="btn btn-danger">DELETE</button>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
    <h3>Total Users: <?= $total ?></h3>

    <?php
        $totalPages = (int) ceil($total / $perPage);
    ?>

    <div class="pagination">

        <!-- Previous -->
        <?php if ($page > 1): ?>
            <a href="<?= base_url('dashboard?page=' . ($page - 1)) ?>">
                Previous
            </a>
        <?php endif; ?>


        <!-- Page Numbers -->
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>

            <a href="<?= base_url('dashboard?page=' . $i) ?>"
            class="<?= ($i == $page) ? 'active' : '' ?>">
                <?= $i ?>
            </a>

        <?php endfor; ?>


        <!-- Next -->
        <?php if ($page < $totalPages): ?>
            <a href="<?= base_url('dashboard?page=' . ($page + 1)) ?>">
                Next
            </a>
        <?php endif; ?>


        <!-- Last -->
        <?php if ($page < $totalPages): ?>
            <a href="<?= base_url('dashboard?page=' . $totalPages) ?>">
                Last
            </a>
        <?php endif; ?>

    </div>
    
    <?php else: echo "<h4><center> No Data Found 😐</center> </h4>"; endif;?>        
</div>

<script src="<?php echo 'project_b/assets/js/dashboard.js'; ?>" ></script>

<?= $this->endSection() ?>