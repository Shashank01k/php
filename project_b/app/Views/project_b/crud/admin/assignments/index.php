<?= $this->extend('project_b/crud/layouts/main') ?>

<?= $this->section('content') ?>

<style>
   .assignment-pagination .pagination {
        gap: 6px !important;
    }
</style>

<div class="container-fluid py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h4 class="mb-0">
            <i class="fa fa-tasks me-2"></i>
            All Assignments
        </h4>

        <a
            href="<?= base_url('admin/assignments/create') ?>"
            class="btn btn-primary"
        >
            <i class="fa fa-plus me-1"></i>
            Add Assignment
        </a>

    </div>


    <!-- Success Message -->
    <?php if (session()->getFlashdata('success')): ?>

        <div class="alert alert-success">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>

    <?php endif; ?>


    <!-- Error Message -->
    <?php if (session()->getFlashdata('error')): ?>

        <div class="alert alert-danger">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>

    <?php endif; ?>


    <!-- Assignment Cards -->
    <?php if (!empty($assignments)): ?>

        <div class="row g-4">

            <?php foreach ($assignments as $assignment): ?>

                <div class="col-xl-4 col-lg-6 col-md-6">

                    <div class="card shadow-sm h-100">

                        <!-- Card Header -->
                        <div class="card-header d-flex justify-content-between align-items-center">

                            <h5 class="mb-0">
                                <?= esc($assignment['title']) ?>
                            </h5>

                            <?php
                            $statusClass = match ($assignment['status']) {
                                'pending'     => 'bg-warning text-dark',
                                'in_progress' => 'bg-primary',
                                'completed'   => 'bg-success',
                                'cancelled'   => 'bg-danger',
                                default       => 'bg-secondary',
                            };
                            ?>

                            <span class="badge <?= $statusClass ?>">
                                <?= esc(ucwords(str_replace('_', ' ', $assignment['status']))) ?>
                            </span>

                        </div>


                        <!-- Card Body -->
                        <div class="card-body">

                            <!-- Description -->
                            <p class="text-muted mb-3">
                                <?= esc($assignment['description'] ?? '-') ?>
                            </p>


                            <!-- Details -->
                            <div class="small">

                                <div class="mb-2">
                                    <strong>
                                        <i class="fa fa-code me-1"></i>
                                        Technology:
                                    </strong>

                                    <?= esc($assignment['technology'] ?? '-') ?>
                                </div>


                                <div class="mb-2">
                                    <strong>
                                        <i class="fa fa-user me-1"></i>
                                        Assigned To:
                                    </strong>

                                    <?= esc($assignment['assigned_user_name'] ?? '-') ?>
                                </div>


                                <div class="mb-2">
                                    <strong>
                                        <i class="fa fa-flag me-1"></i>
                                        Priority:
                                    </strong>

                                    <?= esc(ucfirst($assignment['priority'])) ?>
                                </div>


                                <div class="mb-2">
                                    <strong>
                                        <i class="fa fa-calendar me-1"></i>
                                        Due Date:
                                    </strong>

                                    <?= !empty($assignment['due_date'])
                                        ? esc($assignment['due_date'])
                                        : '-' ?>
                                </div>


                                <div>
                                    <strong>
                                        <i class="fa fa-clock-o me-1"></i>
                                        Created:
                                    </strong>

                                    <?= !empty($assignment['created_at'])
                                        ? esc(date('d M Y', strtotime($assignment['created_at'])))
                                        : '-' ?>
                                </div>

                            </div>

                        </div>


                        <!-- Card Footer -->
                        <div class="card-footer bg-white">

                            <div class="d-flex justify-content-end gap-2">

                                <!-- Edit -->
                                <a
                                    href="<?= base_url('admin/assignments/edit/' . $assignment['id']) ?>"
                                    class="btn btn-sm btn-outline-primary"
                                >
                                    <i class="fa fa-edit me-1"></i>
                                    Edit
                                </a>

                                <!-- Delete -->
                                <form
                                    action="<?= base_url('admin/assignments/delete/' . $assignment['id']) ?>"
                                    method="post"
                                    onsubmit="return confirm('Are you sure you want to delete this assignment?');"
                                >

                                    <?= csrf_field() ?>

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                    >
                                        <i class="fa fa-trash me-1"></i>
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>


        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4 assignment-pagination">
            <?= $pager->links() ?>
        </div>


        <!-- Count -->
        <?php
        $currentPage = $pager->getCurrentPage();
        $perPage     = $pager->getPerPage();
        $total       = $pager->getTotal();

        $start = (($currentPage - 1) * $perPage) + 1;
        $end   = min($currentPage * $perPage, $total);
        ?>

        <div class="text-muted text-center mt-2">

            <?php if ($total > 0): ?>

                Showing <?= $start ?>
                to <?= $end ?>
                of <?= $total ?> assignments

            <?php endif; ?>

        </div>


    <?php else: ?>

        <div class="card shadow-sm">

            <div class="card-body text-center py-5">

                <i class="fa fa-tasks fa-3x text-muted mb-3"></i>

                <h5>No assignments found</h5>

                <p class="text-muted">
                    There are currently no active assignments.
                </p>

                <a
                    href="<?= base_url('admin/assignments/create') ?>"
                    class="btn btn-primary"
                >
                    <i class="fa fa-plus me-1"></i>
                    Add Assignment
                </a>

            </div>

        </div>

    <?php endif; ?>

</div>

<?= $this->endSection() ?>