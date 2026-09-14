<!-- Success Message -->
<?php if ($message = session()->getFlashdata('success')): ?>

    <div class="alert alert-success alert-dismissible fade show auto-hide-alert"
         role="alert">

        <?= esc($message) ?>

        <button
            type="button"
            class="btn-close"
            aria-label="Close">
        </button>

    </div>

<?php endif; ?>

<!-- Error Message -->
<?php if ($message = session()->getFlashdata('error')): ?>

    <div class="alert alert-danger alert-dismissible fade show auto-hide-alert"
         role="alert">

        <?= esc($message) ?>

        <button
            type="button"
            class="btn-close"
            aria-label="Close">
        </button>

    </div>

<?php endif; ?>

<?php if (isset($errors)): ?>

    <div class="alert alert-danger alert-dismissible fade show auto-hide-alert">

        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>

        <button
            type="button"
            class="btn-close"
            aria-label="Close">
        </button>

    </div>

<?php endif; ?>

<!-- Multiple Validation Errors -->
<?php if ($errors = session()->getFlashdata('errors')): ?>

    <div class="alert alert-danger alert-dismissible fade show auto-hide-alert"
         role="alert">

        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>

        <button
            type="button"
            class="btn-close"
            aria-label="Close">
        </button>

    </div>

<?php endif; ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {

    const alerts = document.querySelectorAll('.auto-hide-alert');

    alerts.forEach(function (alert) {

        let hideTimer;

        function startTimer() {
            hideTimer = setTimeout(function () {

                alert.classList.remove('show');

                setTimeout(function () {
                    alert.remove();
                }, 150);

            }, 5000); // 5 seconds
        }

        function stopTimer() {
            clearTimeout(hideTimer);
        }

        // Close button
        const closeButton = alert.querySelector('.btn-close');

        if (closeButton) {
            closeButton.addEventListener('click', function () {
                stopTimer();

                alert.classList.remove('show');

                setTimeout(function () {
                    alert.remove();
                }, 150);
            });
        }

        // Pause when mouse is over alert
        alert.addEventListener('mouseenter', stopTimer);

        // Restart timer when mouse leaves
        alert.addEventListener('mouseleave', startTimer);

        // Start auto-hide timer
        startTimer();
    });

});
</script>