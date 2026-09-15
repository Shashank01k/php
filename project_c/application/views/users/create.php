<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create User</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card">

                <div class="card-header">
                    <h4 class="mb-0">Registration Form</h4>
                </div>

                <div class="card-body">

                    <?php if (validation_errors()): ?>

                        <div class="alert alert-danger">
                            <?= validation_errors(); ?>
                        </div>

                    <?php endif; ?>

                    <?= form_open('users/register'); ?>


                    <!-- Name -->
                    <div class="mb-3">

                        <label for="name" class="form-label">
                            Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control"
                            value="<?= set_value('name'); ?>"
                            placeholder="Enter name"
                        >

                    </div>


                    <!-- Email -->
                    <div class="mb-3">

                        <label for="email" class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control"
                            value="<?= set_value('email'); ?>"
                            placeholder="Enter email"
                        >

                    </div>


                    <!-- Mobile -->
                    <div class="mb-3">

                        <label for="mobile" class="form-label">
                            Mobile
                        </label>

                        <input
                            type="text"
                            name="mobile"
                            id="mobile"
                            class="form-control"
                            value="<?= set_value('mobile'); ?>"
                            placeholder="Enter mobile number"
                            maxlength="15"
                        >

                    </div>


                    <!-- Gender -->
                    <div class="mb-3">

                        <label class="form-label d-block">
                            Gender
                        </label>

                        <div class="form-check form-check-inline">

                            <input
                                class="form-check-input"
                                type="radio"
                                name="gender"
                                id="male"
                                value="Male"
                                <?= set_radio('gender', 'Male'); ?>
                            >

                            <label class="form-check-label" for="male">
                                Male
                            </label>

                        </div>

                        <div class="form-check form-check-inline">

                            <input
                                class="form-check-input"
                                type="radio"
                                name="gender"
                                id="female"
                                value="Female"
                                <?= set_radio('gender', 'Female'); ?>
                            >

                            <label class="form-check-label" for="female">
                                Female
                            </label>

                        </div>

                        <div class="form-check form-check-inline">

                            <input
                                class="form-check-input"
                                type="radio"
                                name="gender"
                                id="other"
                                value="Other"
                                <?= set_radio('gender', 'Other'); ?>
                            >

                            <label class="form-check-label" for="other">
                                Other
                            </label>

                        </div>

                    </div>


                    <!-- State -->
                    <div class="mb-3">

                        <label for="state_id" class="form-label">
                            State
                        </label>

                        <select
                            name="state_id"
                            id="state_id"
                            class="form-select"
                        >

                            <option value="">
                                Select State
                            </option>

                            <?php foreach ($states as $state): ?>

                                <option
                                    value="<?= $state->id; ?>"
                                    <?= set_select('state_id', $state->id); ?>
                                >
                                    <?= html_escape($state->name); ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Register
                    </button>

                    <a href="<?= site_url('users'); ?>" class="btn btn-secondary ms-2">
                        View Users List
                    </a>

                    <?= form_close(); ?>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>