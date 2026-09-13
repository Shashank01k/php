<?= $this->extend('project_b/crud/layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h4 class="mb-0">
            Assignment Details
        </h4>

        <a
            href="<?= base_url('users/assignments') ?>"
            class="btn btn-outline-secondary btn-sm"
        >
            <i class="fa fa-arrow-left"></i>
            Back to Assignments
        </a>

    </div>


    <div class="card shadow-sm">

        <div class="card-header bg-white">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0">
                    <?= esc($assignment['title']) ?>
                </h5>

                <?php
                    $statusClass = match ($assignment['status']) {
                        'completed'   => 'bg-success',
                        'in_progress' => 'bg-warning text-dark',
                        'cancelled'   => 'bg-danger',
                        default       => 'bg-secondary',
                    };
                ?>

                <span class="badge <?= $statusClass ?>">
                    <?= esc(
                        ucwords(
                            str_replace('_', ' ', $assignment['status'])
                        )
                    ) ?>
                </span>

            </div>

        </div>


        <div class="card-body">

            <div class="row">

                <div class="col-md-8">

                    <h6 class="fw-bold">
                        Description
                    </h6>

                    <p class="text-muted">
                        <?= nl2br(esc($assignment['description'] ?? 'No description available.')) ?>
                    </p>

                </div>


                <div class="col-md-4">

                    <div class="border rounded p-3">

                        <p class="mb-2">
                            <strong>Technology:</strong><br>
                            <?= esc($assignment['technology'] ?? '-') ?>
                        </p>

                        <p class="mb-2">
                            <strong>Priority:</strong><br>
                            <?= esc(ucfirst($assignment['priority'])) ?>
                        </p>

                        <p class="mb-0">
                            <strong>Due Date:</strong><br>

                            <?= !empty($assignment['due_date'])
                                ? esc(date('d M Y', strtotime($assignment['due_date'])))
                                : 'No due date'
                            ?>
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>