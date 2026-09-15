<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit User</title>

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
                    <h4 class="mb-0">Edit User</h4>
                </div>

                <div class="card-body">

                    <?php if (!empty($error)): ?>

                        <div class="alert alert-danger">
                            <?= html_escape($error); ?>
                        </div>

                    <?php endif; ?>


                    <?php if (validation_errors()): ?>

                        <div class="alert alert-danger">
                            <?= validation_errors(); ?>
                        </div>

                    <?php endif; ?>


                    <?= form_open('users/edit/' . $user->id); ?>


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
                            value="<?= set_value('name', $user->name); ?>"
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
                            value="<?= html_escape($user->email); ?>"
                            readonly
                        >

                        <small class="text-muted">
                            Email cannot be changed.
                        </small>

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
                            value="<?= set_value('mobile', $user->mobile); ?>"
                            maxlength="15"
                            placeholder="Enter mobile number"
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
                                <?= set_radio('gender', 'Male', $user->gender === 'Male'); ?>
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
                                <?= set_radio('gender', 'Female', $user->gender === 'Female'); ?>
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
                                <?= set_radio('gender', 'Other', $user->gender === 'Other'); ?>
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
                                    <?= set_select(
                                        'state_id',
                                        $state->id,
                                        $user->state_id == $state->id
                                    ); ?>
                                >
                                    <?= html_escape($state->name); ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <!-- Buttons -->
                    <div class="d-flex gap-2">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Update
                        </button>

                        <a
                            href="<?= site_url('users'); ?>"
                            class="btn btn-secondary"
                        >
                            Cancel
                        </a>

                    </div>


                    <?= form_close(); ?>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>