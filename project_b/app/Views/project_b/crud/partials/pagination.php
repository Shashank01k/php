<!-- Bottom section -->
<?php
$totalPages = (int) ceil($total / $perPage);
$range = 2; // pages to show before/after current page
?>

<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mt-4">

    <!-- Total -->
    <div>
        <strong>Total Users:</strong>
        <span class="badge bg-primary fs-6">
            <?= $total ?>
        </span>
    </div>

    <!-- <div class="d-flex justify-content-between align-items-center mb-3"> -->

        <div>
            <label for="perPage" class="form-label mb-0">
                Records per page:
            </label>

            <select
                id="perPage"
                class="form-select form-select-sm d-inline-block"
                style="width: 100px;"
                onchange="changePerPage(this.value)"
            >
                <?php foreach ([5, 10, 20, 50, 100] as $limit): ?>
                    <option
                        value="<?= $limit ?>"
                        <?= ($perPage == $limit) ? 'selected' : '' ?>
                    >
                        <?= $limit ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <script>
            function changePerPage(limit) {
                window.location.href = '<?= base_url('admin/index') ?>?page=1&perPage=' + limit;
            }
        </script>

    <!-- </div> -->


    <!-- Pagination -->
    <nav aria-label="User pagination">

        <ul class="pagination mb-0">

            <!-- Previous -->
            <?php if ($page > 1): ?>

                <li class="page-item">

                    <a class="page-link"
                    href="<?= base_url('admin/index?page=' . ($page - 1) . '&perPage=' . $perPage) ?>">
                        Previous
                    </a>

                </li>

            <?php else: ?>

                <li class="page-item disabled">

                    <span class="page-link">
                        Previous
                    </span>

                </li>

            <?php endif; ?>

            <!-- Pages -->

            <!-- First page -->
            <?php if ($page > $range + 1): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= base_url('admin/index?page=1') ?>">1</a>
                </li>

                <?php if ($page > $range + 2): ?>
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                <?php endif; ?>
            <?php endif; ?>


            <?php
                $start = max(1, $page - $range);
                $end = min($totalPages, $page + $range);

                for ($i = $start; $i <= $end; $i++):
                    ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="<?= base_url('admin/index?page=' . $i) ?>">
                            <?= $i ?>
                        </a>
                    </li>
            <?php endfor; ?>

            <!-- Last page -->
            <?php if ($page < $totalPages - $range): ?>

                <?php if ($page < $totalPages - $range - 1): ?>
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                <?php endif; ?>

                <li class="page-item">
                    <a class="page-link" href="<?= base_url('admin/index?page=' . $totalPages) ?>">
                        <?= $totalPages ?>
                    </a>
                </li>

            <?php endif; ?>


            <!-- Next -->
            <?php if ($page < $totalPages): ?>

                <li class="page-item">

                    <a class="page-link"
                        href="<?= base_url('admin/index?page=' . ($page + 1) . '&perPage=' . $perPage) ?>">
                            Next
                    </a>

                </li>

            <?php else: ?>

                <li class="page-item disabled">

                    <span class="page-link">
                        Next
                    </span>

                </li>

            <?php endif; ?>


            <!-- Last -->
            <?php if ($page < $totalPages): ?>

                <li class="page-item">

                    <a class="page-link" href="<?= base_url('admin/index?page=' . $totalPages) ?>">
                        Last
                    </a>

                </li>

            <?php endif; ?>

        </ul>
    </nav>

</div>
<!-- Record count -->
<?php
    $start = (($page - 1) * $perPage) + 1;
    $end   = min($page * $perPage, $total);
?>

<div class="text-muted mt-2">
    <?php if ($total > 0): ?>
        Showing <?= $start ?> to <?= $end ?> of <?= $total ?> users
    <?php else: ?>
        No users found
    <?php endif; ?>
</div>