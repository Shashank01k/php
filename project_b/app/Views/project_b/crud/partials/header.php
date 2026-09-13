<head>
    <meta charset="UTF-8">
    <meta name="viewport"content="width=device-width, initial-scale=1.0">
    <meta name="<?= csrf_header() ?>" content="<?= csrf_hash() ?>">
    <meta name="csrf-header" content="<?= csrf_header() ?>">
    <meta name="csrf-hash" content="<?= csrf_hash() ?>">

    <title><?= esc($title ?? 'My Website') ?></title>

    <!-- Font Awesome -->
    <link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- Bootstrap 5 -->
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">


    <!-- Project CSS -->
    <link rel="stylesheet" href="<?= base_url('project_b/assets/css/style.css') ?>">

    <link rel="stylesheet" href="<?= base_url('project_b/assets/css/sign_up.css') ?>">
    
    <link rel="stylesheet" href="<?= base_url('project_b/assets/css/sign_in.css') ?>">
    
    <link rel="stylesheet" href="<?= base_url('project_b/assets/css/footer.css') ?>">
    
    <link rel="stylesheet" href="<?= base_url('project_b/assets/css/dashboard.css') ?>">
    
    <link rel="stylesheet" href="<?= base_url('project_b/assets/css/welcome.css') ?>">

    <link rel="stylesheet" href="<?= base_url('project_b/assets/css/sidebar.css') ?>">

    <link rel="stylesheet" href="<?= base_url('project_b/assets/css/update.css') ?>">
</head>