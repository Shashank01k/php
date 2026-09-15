<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Users List</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Users List</h2>

        <a href="<?= site_url('users/register'); ?>"
           class="btn btn-primary">
            Add User
        </a>

    </div>

    <div class="card">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped align-middle">

                    <thead class="table-dark">

                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Gender</th>
                            <th>State</th>
                            <th>Action</th>
                        </tr>

                    </thead>

                    <tbody>

                    <?php if (!empty($users)): ?>

                        <?php $i = 1; ?>

                        <?php foreach ($users as $user): ?>

                            <tr>

                                <td>
                                    <?= $i++; ?>
                                </td>

                                <td>
                                    <?= html_escape($user->name); ?>
                                </td>

                                <td>
                                    <?= html_escape($user->email); ?>
                                </td>

                                <td>
                                    <?= html_escape($user->mobile); ?>
                                </td>

                                <td>
                                    <?= html_escape($user->gender); ?>
                                </td>

                                <td>
                                    <?= html_escape($user->state_name); ?>
                                </td>

                                <td>

                                    <a href="<?= site_url('users/edit/' . $user->id); ?>"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <?= form_open(
                                        'users/delete/' . $user->id,
                                            [
                                                'method' => 'post',
                                                'style' => 'display:inline-block;'
                                            ]
                                        ); ?>

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this user?');"
                                        >
                                            Delete
                                        </button>

                                    <?= form_close(); ?>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="7" class="text-center">
                                No users found.
                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</body>

</html>