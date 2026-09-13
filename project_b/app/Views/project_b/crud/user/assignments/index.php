<?= $this->extend('project_b/crud/layouts/main') ?>

<?= $this->section('content') ?>

<style>
    .assignment-card {
        border: 1px solid #e5e5e5;
        border-radius: 10px;
        transition: 0.2s;
    }

    .assignment-card:hover {
        box-shadow: 0 5px 18px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }

    .assignment-title {
        font-size: 18px;
        font-weight: 700;
        color: #222;
    }

    .assignment-description {
        color: #777;
        font-size: 14px;
    }

    .assignment-label {
        font-size: 12px;
        color: #888;
        margin-bottom: 2px;
    }

    .assignment-value {
        font-size: 14px;
        font-weight: 600;
    }
</style>


<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">
                My Assignments
            </h4>

            <p class="text-muted mb-0">
                Assignments given to you by Admin
            </p>
        </div>

    </div>


    <?php if (session()->getFlashdata('error')): ?>

        <div class="alert alert-danger">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>

    <?php endif; ?>


    <?php if (!empty($assignments)): ?>

        <div class="row g-4">

            <?php foreach ($assignments as $assignment): ?>

                <div class="col-md-6 col-lg-4">

                    <div class="card assignment-card h-100">

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-start mb-3">

                                <div class="assignment-title">
                                    <?= esc($assignment['title']) ?>
                                </div>

                                <?php
                                    $statusClass = match ($assignment['status']) {
                                        'completed'  => 'bg-success',
                                        'in_progress' => 'bg-warning text-dark',
                                        'cancelled'  => 'bg-danger',
                                        default      => 'bg-secondary',
                                    };
                                ?>

                                <span class="badge <?= $statusClass ?>">
                                    <?= esc(ucwords(str_replace('_', ' ', $assignment['status']))) ?>
                                </span>

                            </div>


                            <p class="assignment-description">
                                <?= esc(
                                    strlen($assignment['description'] ?? '') > 120
                                        ? substr($assignment['description'], 0, 120) . '...'
                                        : ($assignment['description'] ?? 'No description available.')
                                ) ?>
                            </p>


                            <div class="row mt-3">

                                <div class="col-6 mb-3">

                                    <div class="assignment-label">
                                        Technology
                                    </div>

                                    <div class="assignment-value">
                                        <?= esc($assignment['technology'] ?? '-') ?>
                                    </div>

                                </div>


                                <div class="col-6 mb-3">

                                    <div class="assignment-label">
                                        Priority
                                    </div>

                                    <div class="assignment-value">
                                        <?= esc(ucfirst($assignment['priority'])) ?>
                                    </div>

                                </div>


                                <div class="col-12">

                                    <div class="assignment-label">
                                        Due Date
                                    </div>

                                    <div class="assignment-value">
                                        <?= !empty($assignment['due_date'])
                                            ? esc(date('d M Y', strtotime($assignment['due_date'])))
                                            : 'No due date'
                                        ?>
                                    </div>

                                </div>

                            </div>

                        </div>


                        <div class="card-footer bg-white border-0 pt-0 pb-3">

                            <a
                                href="<?= base_url('users/assignments/view/' . $assignment['id']) ?>"
                                class="btn btn-sm btn-primary"
                            >
                                <i class="fa fa-eye"></i>
                                View & Open
                            </a>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    <?php else: ?>

        <div class="text-center py-5">

            <i class="fa fa-tasks fa-3x text-muted mb-3"></i>

            <h5>
                No Assignments
            </h5>

            <p class="text-muted">
                You don't have any assignments yet.
            </p>

        </div>

    <?php endif; ?>

</div>

<?= $this->endSection() ?>