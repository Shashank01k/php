

<!DOCTYPE html>
<html lang="en">

<body>
    <?php
        // dd(session()->get('isLoggedIn'), getLoggedInUser());
    ?>
    <div class="page-with-sidebar">
        <!-- Header -->
        <?= $this->include('project_b/crud/partials/header') ?>

        <!-- Navbar -->
  
        <?php if (session()->get('isLoggedIn') && !empty(getLoggedInUser()['userModel'])): ?>
            <?= $this->include('project_b/crud/partials/navbar') ?>
        <?php endif; ?>
        
        <!-- Sidebar | Side Menus -->
        <?= $this->include('project_b/crud/partials/sidebar') ?>

        <!-- Main Page Content -->
        <main>
            <?= $this->renderSection('content') ?>
        </main>

        <!-- Footer -->
        <?= $this->include('project_b/crud/partials/footer') ?>
    </div>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="<?= base_url('project_b/assets/js/sidebar.js') ?>"></script>
</body>

</html>