<?= $this->extend('project_b/crud/layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h4 class="mb-0">
            <i class="fa fa-tasks me-2"></i>
            Create Assignment
        </h4>

        <a href="<?= base_url('admin/index') ?>"
           class="btn btn-secondary btn-sm">
            <i class="fa fa-arrow-left"></i>
            Back
        </a>

    </div>


    <!-- Validation Errors -->
    <?php if (!empty($validation)): ?>

        <div class="alert alert-danger">

            <?= $validation->listErrors() ?>

        </div>

    <?php endif; ?>


    <div class="card shadow-sm">

        <div class="card-header">
            <strong>
                Assignment Details
            </strong>
        </div>

        <div class="card-body">

            <form
                action="<?= base_url('admin/assignments/create') ?>"
                method="post"
            >

                <?= csrf_field() ?>


                <div class="row g-3">

                    <!-- Title -->
                    <div class="col-md-8">

                        <label for="title" class="form-label">
                            Assignment Title
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="title"
                            id="title"
                            class="form-control"
                            value="<?= esc(old('title')) ?>"
                            placeholder="Enter assignment title"
                            required
                        >

                    </div>


                    <!-- Technology -->
                    <div class="col-md-4">

                        <label for="technology" class="form-label">
                            Technology
                        </label>

                        <input
                            type="text"
                            name="technology"
                            id="technology"
                            class="form-control"
                            value="<?= esc(old('technology')) ?>"
                            placeholder="e.g. PHP Laravel"
                        >

                    </div>


                    <!-- Description -->
                    <div class="col-12">

                        <label for="description" class="form-label">
                            Description
                        </label>

                        <textarea
                            name="description"
                            id="description"
                            rows="5"
                            class="form-control"
                            placeholder="Enter assignment details..."
                        ><?= esc(old('description')) ?></textarea>

                    </div>


                    <!-- Assign To -->
                    <div class="col-md-4">

                        <label for="assigned_to" class="form-label">
                            Assign To
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="assigned_to"
                            id="assigned_to"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Select User
                            </option>

                            <?php if (!empty($users)): ?>

                                <?php foreach ($users as $user): ?>

                                    <option
                                        value="<?= esc($user['id']) ?>"
                                        <?= old('assigned_to') == $user['id']
                                            ? 'selected'
                                            : '' ?>
                                    >
                                        <?= esc($user['user_name']) ?>
                                    </option>

                                <?php endforeach; ?>

                            <?php endif; ?>

                        </select>

                    </div>


                    <!-- Priority -->
                    <div class="col-md-4">

                        <label for="priority" class="form-label">
                            Priority
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="priority"
                            id="priority"
                            class="form-select"
                            required
                        >

                            <option
                                value="low"
                                <?= old('priority', 'medium') === 'low'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Low
                            </option>

                            <option
                                value="medium"
                                <?= old('priority', 'medium') === 'medium'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Medium
                            </option>

                            <option
                                value="high"
                                <?= old('priority') === 'high'
                                    ? 'selected'
                                    : '' ?>
                            >
                                High
                            </option>

                        </select>

                    </div>


                    <!-- Due Date -->
                    <div class="col-md-4">

                        <label for="due_date" class="form-label">
                            Due Date
                        </label>

                        <input
                            type="date"
                            name="due_date"
                            id="due_date"
                            class="form-control"
                            value="<?= esc(old('due_date')) ?>"
                        >

                    </div>

                </div>


                <hr class="my-4">


                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="<?= base_url('admin/index') ?>"
                        class="btn btn-secondary"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <i class="fa fa-save me-1"></i>
                        Create Assignment
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>