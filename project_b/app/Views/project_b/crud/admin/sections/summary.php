<div class="row mb-4">

    <!-- Total Users -->
    <div class="col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted">Total Users</h6>
                        <h2 class="mb-0"><?= esc($summary['totalUsers']) ?></h2>
                    </div>

                    <i class="fa fa-users fa-2x text-muted"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Assignments -->
    <div class="col-md-9">

        <div class="card shadow-sm h-100">

            <div class="card-header">
                <strong>Assignments</strong>
            </div>

            <div class="card-body">

                <div class="row">

                    <!-- Total Assignments -->
                    <div class="col-md-4">
                        <div class="border rounded p-3 h-100">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="text-muted">Total</h6>
                                    <h2 class="mb-0">
                                        <?= esc($summary['totalAssignments']) ?>
                                    </h2>
                                </div>

                                <i class="fa fa-tasks fa-2x text-muted"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Pending -->
                    <div class="col-md-4">
                        <div class="border rounded p-3 h-100">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="text-muted">Pending</h6>
                                    <h2 class="mb-0">
                                        <?= esc($summary['pendingAssignments']) ?>
                                    </h2>
                                </div>

                                <i class="fa fa-clock-o fa-2x text-muted"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Completed -->
                    <div class="col-md-4">
                        <div class="border rounded p-3 h-100">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="text-muted">Completed</h6>
                                    <h2 class="mb-0">
                                        <?= esc($summary['completedAssignments']) ?>
                                    </h2>
                                </div>

                                <i class="fa fa-check-circle fa-2x text-muted"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>