<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?? 'My Website' ?></title>
</head>

<body>

    <?= $this->include('project_b/crud/partials/header') ?>

    <?= $this->include('project_b/crud/partials/navbar') ?>

    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <?= $this->include('project_b/crud/partials/footer') ?>

</body>

</html>