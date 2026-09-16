//TODO:remove unwanted code
document.addEventListener('DOMContentLoaded', () => {

    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirmpassword');

    if (!passwordInput || !confirmPasswordInput) {
        console.error('Password or confirm password input not found.');
        return;
    }

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute('content');

    if (!csrfToken) {
        console.error('CSRF token not found.');
        return;
    }

    passwordInput.addEventListener('input', validatePasswordFields);
    confirmPasswordInput.addEventListener('input', validatePasswordFields);

    async function validatePasswordFields() {

        try {
            const response = await fetch('/api/v1/auth/validate-password', {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    password: passwordInput.value,
                    confirmpassword: confirmPasswordInput.value
                })
            });

            const result = await response.json();

            if (!response.ok) {
                resetChecklist();
                return;
            }

            if (result.status === 'success' || result.checks) {
                updateChecklist(result.checks);
            } else {
                resetChecklist();
            }


        } catch (error) {
            console.error('Validation error:', error);

            alert('Something went wrong. Please try again later.');

            resetChecklist();
        }
    }

    function updateChecklist(checks) {
        for (const [rule, passed] of Object.entries(checks)) {
            const element = document.getElementById(`rule-${rule}`);
            if (!element) continue;

            const icon = element.querySelector('.icon');
            if (passed) {
                element.classList.add('valid');
                icon.textContent = '✓';
            } else {
                element.classList.remove('valid');
                icon.textContent = '✕';
            }
        }
    }

    // Resets all rules back to default error state (Red + ✕)
    function resetChecklist() {
        const rules = document.querySelectorAll('#checklist .rule-item');
        rules.forEach(element => {
            element.classList.remove('valid');
            const icon = element.querySelector('.icon');
            if (icon) {
                icon.textContent = '✕';
            }
        });
    }

    document.querySelectorAll('.password-toggle').forEach(button => {

        button.addEventListener('click', () => {

            const input = document.getElementById(button.dataset.target);
            const icon = button.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';

                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');

                button.setAttribute('aria-label', 'Hide password');
            } else {
                input.type = 'password';

                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');

                button.setAttribute('aria-label', 'Show password');
            }
        });

    });
});