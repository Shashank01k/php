
<?php
    $totalUsers = 0;
    $totalAssignments = 0;
    $pendingAssignments = 0;
    $pendingAssignments = 0;
    $completedAssignments = 0;
?>
<div class="row g-3 mb-4">

    <!-- Total Users -->
    <div class="col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted">Total Users</h6>
                        <h2 class="mb-0"><?= esc($totalUsers) ?></h2>
                    </div>
                    <i class="fa fa-users fa-2x text-muted"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Assignments -->
    <div class="col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted">Assignments</h6>
                        <h2 class="mb-0"><?= esc($totalAssignments) ?></h2>
                    </div>
                    <i class="fa fa-tasks fa-2x text-muted"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending -->
    <div class="col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted">Pending</h6>
                        <h2 class="mb-0"><?= esc($pendingAssignments) ?></h2>
                    </div>
                    <i class="fa fa-clock-o fa-2x text-muted"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Completed -->
    <div class="col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted">Completed</h6>
                        <h2 class="mb-0"><?= esc($completedAssignments) ?></h2>
                    </div>
                    <i class="fa fa-check-circle fa-2x text-muted"></i>
                </div>
            </div>
        </div>
    </div>

</div>