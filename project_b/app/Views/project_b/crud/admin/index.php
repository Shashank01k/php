<?= $this->extend('project_b/crud/layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <h4 class="mb-4">Welcome To User Dashboard</h4>

    <?php if ($total > 0): ?>

        <!-- Table -->
        <div class="card shadow-sm border-0">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover table-bordered align-middle mb-0">
                    <!-- <table class="table table-bordered table-hover align-middle"> -->

                        <thead class="table-dark">

                            <tr>

                                <!-- Actions -->
                                <th class="text-center" style="width: 80px;">

                                    <div class="dropdown">

                                        <button
                                            class="btn btn-sm btn-light dropdown-toggle"
                                            type="button"
                                            id="dropdownMenuButton"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"
                                        >
                                            Actions
                                        </button>

                                        <ul
                                            class="dropdown-menu"
                                            aria-labelledby="dropdownMenuButton"
                                        >
                                            <li>
                                                <button
                                                    class="dropdown-item"
                                                    type="button"
                                                    onclick="selects()"
                                                >
                                                    Select
                                                </button>
                                            </li>

                                            <li>
                                                <button
                                                    class="dropdown-item"
                                                    type="button"
                                                    onclick="deSelect()"
                                                >
                                                    Deselect
                                                </button>
                                            </li>

                                            <li>
                                                <button
                                                    class="dropdown-item text-danger"
                                                    type="button"
                                                    onclick="deleteAllRows()"
                                                >
                                                    Delete
                                                </button>
                                            </li>

                                        </ul>

                                    </div>

                                </th>

                                <th class="text-center">Sr.No.</th>
                                <th>User Name</th>
                                <th>Phone</th>
                                <th>Email ID</th>
                                <th>Gender</th>
                                <th>State</th>
                                <th>Created Date</th>
                                <th class="text-center">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($userDataArray as $userDataValue): ?>

                                <?php

                                $userId = $userDataValue->u_id;

                                $tempUserName = $userDataValue->user_name;
                                $userName = $userDataValue->user_name;

                                $tempStateName = $userDataValue->name;
                                $stateName = $userDataValue->name;

                                if (strlen($userName) >= 10) {
                                    $userName = substr($userName, 0, 10) . '...';
                                }

                                if (strlen($stateName) >= 12) {
                                    $stateName = substr($stateName, 0, 12) . '...';
                                }

                                ?>

                                <tr>

                                    <!-- Checkbox -->
                                    <td class="text-center">

                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            name="chkRowId"
                                            value="<?= $userId ?>"
                                        >

                                    </td>

                                    <!-- ID -->
                                    <td class="text-center">
                                        <?= $userId ?>
                                    </td>

                                    <!-- Name -->
                                    <td>

                                        <span
                                            data-bs-toggle="tooltip"
                                            title="<?= esc($tempUserName) ?>"
                                            onclick="copyUserNameValue('<?= esc($tempUserName) ?>')"
                                            style="cursor:pointer;"
                                        >
                                            <?= esc(ucwords($userName)) ?>
                                        </span>

                                    </td>

                                    <!-- Phone -->
                                    <td class="text-nowrap">
                                        <?= esc($userDataValue->phone) ?>
                                    </td>

                                    <!-- Email -->
                                    <td>
                                        <?= esc($userDataValue->email) ?>
                                    </td>

                                    <!-- Gender -->
                                    <td class="text-nowrap">
                                        <?= esc(ucfirst($userDataValue->gender)) ?>
                                    </td>

                                    <!-- State -->
                                    <td>

                                        <span
                                            data-bs-toggle="tooltip"
                                            title="<?= esc($tempStateName) ?>"
                                        >
                                            <?= esc($stateName) ?>
                                        </span>

                                    </td>

                                    <!-- Created Date -->
                                    <td class="text-nowrap">

                                        <?= date(
                                            'd M Y',
                                            strtotime($userDataValue->created_at)
                                        ) ?>

                                    </td>

                                    <!-- Actions -->
                                    <td class="text-center text-nowrap">
                                        

                                        <a
                                            href="<?= base_url('admin/users/profile/update/' . $userId) ?>"
                                            class="btn btn-primary btn-sm"
                                        >
                                            <i class="fa fa-edit"></i>
                                            Edit
                                        </a>

                                        <a
                                            href="<?= base_url('admin/users/delete/' . $userId) ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to move this user to trash?')"
                                        >
                                            <i class="fa fa-trash"></i>
                                            Delete
                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        <!-- Bottom section -->
        <?php
            $totalPages = (int) ceil($total / $perPage);
        ?>

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mt-4">

            <!-- Total -->
            <div>
                <strong>Total Users:</strong>
                <span class="badge bg-primary fs-6">
                    <?= $total ?>
                </span>
            </div>


            <!-- Pagination -->
            <nav aria-label="User pagination">

                <ul class="pagination mb-0">

                    <!-- Previous -->
                    <?php if ($page > 1): ?>

                        <li class="page-item">

                            <a
                                class="page-link"
                                href="<?= base_url('admin/index?page=' . ($page - 1)) ?>"
                            >
                                Previous
                            </a>

                        </li>

                    <?php else: ?>

                        <li class="page-item disabled">

                            <span class="page-link">
                                Previous
                            </span>

                        </li>

                    <?php endif; ?>


                    <!-- Pages -->
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>

                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">

                            <a
                                class="page-link"
                                href="<?= base_url('admin/index?page=' . $i) ?>"
                            >
                                <?= $i ?>
                            </a>

                        </li>

                    <?php endfor; ?>


                    <!-- Next -->
                    <?php if ($page < $totalPages): ?>

                        <li class="page-item">

                            <a
                                class="page-link"
                                href="<?= base_url('admin/index?page=' . ($page + 1)) ?>"
                            >
                                Next
                            </a>

                        </li>

                    <?php else: ?>

                        <li class="page-item disabled">

                            <span class="page-link">
                                Next
                            </span>

                        </li>

                    <?php endif; ?>


                    <!-- Last -->
                    <?php if ($page < $totalPages): ?>

                        <li class="page-item">

                            <a
                                class="page-link"
                                href="<?= base_url('admin/index?page=' . $totalPages) ?>"
                            >
                                Last
                            </a>

                        </li>

                    <?php endif; ?>

                </ul>

            </nav>

        </div>


    <?php else: ?>

        <div class="alert alert-info text-center">
            No Data Found 😐
        </div>

    <?php endif; ?>

</div>
<script>
    const baseUrlForAllDelete = '<?= base_url('admin/users/delete/all') ?>';
    const csrfTokenName = '<?= csrf_token() ?>';
    const csrfHash = '<?= csrf_hash() ?>';
</script>

<script src="<?= base_url('project_b/assets/js/admin/index.js') ?>"></script>

<?= $this->endSection() ?>