<!-- Success Message -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show auto-dismiss-alert" role="alert">
        <?= esc(session()->getFlashdata('success')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Error Message -->
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show auto-dismiss-alert" role="alert">
        <?= esc(session()->getFlashdata('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const alerts = document.querySelectorAll('.auto-dismiss-alert');

    alerts.forEach((alert) => {
        let dismissTimer = null;
        const displayDuration = 4000; // Time in milliseconds (4 seconds)

        // Function to start or resume the dismissal timer
        const startTimer = () => {
            dismissTimer = setTimeout(() => {
                // Use Bootstrap's alert instance if available, otherwise fall back to JS fade
                if (window.bootstrap && bootstrap.Alert) {
                    const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                    bsAlert.close();
                } else {
                    alert.classList.remove('show');
                    setTimeout(() => alert.remove(), 300);
                }
            }, displayDuration);
        };

        // Function to pause the timer when the mouse enters
        const pauseTimer = () => {
            if (dismissTimer) {
                clearTimeout(dismissTimer);
            }
        };

        // Attach hover listeners
        alert.addEventListener('mouseenter', pauseTimer);
        alert.addEventListener('mouseleave', startTimer);

        // Start initial auto-dismiss timer
        startTimer();
    });
});
</script>