<?= $this->extend('project_b/crud/layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Edit Assignment</h4>

        <a href="<?= base_url('admin/assignments') ?>"
           class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i>
            Back
        </a>
    </div>

    <?php if (isset($validation)): ?>
        <div class="alert alert-danger">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">

        <div class="card-header">
            <strong>Edit Assignment</strong>
        </div>

        <div class="card-body">

            <form method="post"
                  action="<?= base_url('admin/assignments/edit/' . $assignment['id']) ?>">

                <?= csrf_field() ?>

                <div class="row">

                    <!-- Title -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Title <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="title"
                            class="form-control"
                            value="<?= esc(old('title', $assignment['title'])) ?>"
                            placeholder="Enter assignment title"
                        >
                    </div>

                    <!-- Technology -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Technology
                        </label>

                        <input
                            type="text"
                            name="technology"
                            class="form-control"
                            value="<?= esc(old('technology', $assignment['technology'])) ?>"
                            placeholder="e.g. PHP, Laravel, MySQL"
                        >
                    </div>

                    <!-- Assigned To -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Assign To <span class="text-danger">*</span>
                        </label>

                        <select name="assigned_to" class="form-select">

                            <option value="">Select User</option>

                            <?php foreach ($users as $user): ?>

                                <option
                                    value="<?= $user['id'] ?>"
                                    <?= old('assigned_to', $assignment['assigned_to']) == $user['id'] ? 'selected' : '' ?>
                                >
                                    <?= esc($user['user_name']) ?>
                                </option>

                            <?php endforeach; ?>

                        </select>
                    </div>

                    <!-- Status -->
                    <div class="col-md-3 mb-3">
                        <label class="form-label">
                            Status
                        </label>

                        <select name="status" class="form-select">

                            <?php
                            $statuses = [
                                'pending'     => 'Pending',
                                'in_progress' => 'In Progress',
                                'completed'   => 'Completed',
                                'cancelled'   => 'Cancelled',
                            ];
                            ?>

                            <?php foreach ($statuses as $value => $label): ?>

                                <option
                                    value="<?= $value ?>"
                                    <?= old('status', $assignment['status']) === $value ? 'selected' : '' ?>
                                >
                                    <?= $label ?>
                                </option>

                            <?php endforeach; ?>

                        </select>
                    </div>

                    <!-- Priority -->
                    <div class="col-md-3 mb-3">
                        <label class="form-label">
                            Priority
                        </label>

                        <select name="priority" class="form-select">

                            <?php
                            $priorities = [
                                'low'    => 'Low',
                                'medium' => 'Medium',
                                'high'   => 'High',
                            ];
                            ?>

                            <?php foreach ($priorities as $value => $label): ?>

                                <option
                                    value="<?= $value ?>"
                                    <?= old('priority', $assignment['priority']) === $value ? 'selected' : '' ?>
                                >
                                    <?= $label ?>
                                </option>

                            <?php endforeach; ?>

                        </select>
                    </div>

                    <!-- Due Date -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Due Date
                        </label>

                        <input
                            type="date"
                            name="due_date"
                            class="form-control"
                            value="<?= esc(old('due_date', $assignment['due_date'])) ?>"
                        >
                    </div>

                    <!-- Description -->
                    <div class="col-12 mb-3">
                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="5"
                            class="form-control"
                            placeholder="Enter assignment description"
                        ><?= esc(old('description', $assignment['description'])) ?></textarea>
                    </div>

                </div>

                <div class="d-flex justify-content-end gap-2">

                    <a href="<?= base_url('admin/assignments') ?>"
                       class="btn btn-secondary">
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        Update Assignment
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

<?= $this->endSection() ?>