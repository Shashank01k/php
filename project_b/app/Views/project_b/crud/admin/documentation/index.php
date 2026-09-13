<?= $this->extend('project_b/crud/layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fa fa-book"></i>
                Project Documentation
            </h5>
        </div>

        <div class="card-body">

            <h5>Project Overview</h5>

            <p>
                This application is built using CodeIgniter 4,
                PHP and MySQL for user and assignment management.
            </p>

            <hr>

            <h5>User Roles</h5>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User Type</th>
                        <th>Role</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Super Admin</td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>Admin</td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>Sub Admin</td>
                    </tr>

                    <tr>
                        <td>4</td>
                        <td>User</td>
                    </tr>
                </tbody>
            </table>

            <hr>

            <h5>CRUD Operations</h5>

            <ul>
                <li>Create User</li>
                <li>View Users</li>
                <li>Edit User</li>
                <li>Delete User</li>
                <li>Bulk Delete Users</li>
            </ul>

            <hr>

            <h5>Assignment Management</h5>

            <ul>
                <li>Admin creates assignments.</li>
                <li>Admin assigns assignments to users.</li>
                <li>Users can view their assigned assignments.</li>
                <li>Users cannot access another user's assignment.</li>
            </ul>

            <hr>

            <h5>Security</h5>

            <ul>
                <li>Password hashing using <code>password_hash()</code></li>
                <li>Password verification using <code>password_verify()</code></li>
                <li>CSRF protection</li>
                <li>Server-side validation</li>
                <li>CodeIgniter Query Builder</li>
                <li>Session-based authentication</li>
                <li>Role-based access control</li>
            </ul>

            <hr>

            <h5>Technologies</h5>

            <span class="badge bg-secondary">PHP</span>
            <span class="badge bg-secondary">CodeIgniter 4</span>
            <span class="badge bg-secondary">MySQL</span>
            <span class="badge bg-secondary">Bootstrap 5</span>
            <span class="badge bg-secondary">JavaScript</span>

        </div>
    </div>

</div>

<?= $this->endSection() ?>