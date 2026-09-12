<?= $this->extend('project_b/crud/layouts/main') ?>

<?= $this->section('content') ?>

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h4 class="mb-2">
                        <i class="fa fa-database me-2"></i>
                        Dummy User Seeder
                    </h4>
                    <p class="text-muted mb-4">
                        Enter the number of dummy users you want to insert.
                        You can insert up to 20 users at a time.
                    </p>
                    <?php if (isset($message)): ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?= esc($message) ?>
                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close">
                            </button>
                        </div>
                    <?php endif; ?>
                    <form action="<?= base_url('admin/seeder') ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="number" class="form-label">
                                Number of Users
                            </label>
                            <input
                                type="number"
                                name="number"
                                id="number"
                                class="form-control"
                                min="1"
                                max="20"
                                value="<?= old('number') ?>"
                                placeholder="Enter number of users"
                                required
                            >
                            <div class="form-text">
                                Minimum 1 and maximum 20 users.
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-database me-1"></i>
                                Generate Users
                            </button>
                            <a href="<?= base_url('seeder') ?>"
                               class="btn btn-outline-secondary">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>