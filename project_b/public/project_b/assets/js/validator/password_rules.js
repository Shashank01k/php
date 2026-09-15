//TODO:remove unwanted code
document.addEventListener('DOMContentLoaded', () => {

    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirmpassword');

    if (!passwordInput || !confirmPasswordInput) {
        console.error('Password or confirm password input not found.');
        return;
    }

    let csrfHeader = document.querySelector('meta[name="csrf-header"]')?.getAttribute('content') || 'X-CSRF-TOKEN';

    passwordInput.addEventListener('input', validatePasswordFields);
    confirmPasswordInput.addEventListener('input', validatePasswordFields);
    
    async function validatePasswordFields() {

        const latestCsrfToken = await getCsrfToken();

        if (!latestCsrfToken) {
            return;
        }

        const latestCsrfTokenHash = latestCsrfToken.csrfHash;

        try {
            const response = await fetch('/api/validate-password', {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    [csrfHeader]: latestCsrfTokenHash
                },

                // KEEP YOUR EXISTING REQUEST BODY
                body: JSON.stringify({
                    password: passwordInput.value,
                    confirmpassword: confirmPasswordInput.value
                })
            });

            const result = await response.json();

            // console.log('Full response:', result);
            // console.log('CSRF name:', result.csrfName);
            // console.log('CSRF hash:', result.csrfHash);

            // Always update CSRF token
            const csrfInput = document.querySelector(
                `input[name="${result.csrfName}"]`
            );
            // console.log(csrfInput, result.csrfName, result.csrfHash);

            if (csrfInput) {
                csrfInput.value = result.csrfHash;
            }

            if (!response.ok) {
                resetChecklist();
                return;
            }

            // KEEP YOUR EXISTING RESPONSE HANDLING
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

    // let latestCsrfToken = null;

    async function getCsrfToken()
    {
        const response = await fetch('/csrf-token');

        if (!response.ok) {
            throw new Error('Unable to get CSRF token');
        }

        return await response.json();
    }

    function checkPasswordMatch()
    {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        updateRule(
            'match_password',
            confirmPassword !== '' && password === confirmPassword
        );
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

    //TODO:remove
    async function getCsrfToken1()
    {
         // if (!latestCsrfToken) {
        //     latestCsrfToken = await getCsrfToken();
        // }

        // const password = passwordInput.value;

        // console.log('passwordInput_new',passwordInput.value, password);
        console.log(latestCsrfToken.csrfHash);
        try {

            const response = await fetch('http://localhost:8080/csrf-token', {
                method: 'GET',
                credentials: 'same-origin',
                headers: {
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Failed to get CSRF token');
            }

            const result = await response.json();

            return {
                name: result.csrfName,
                hash: result.csrfHash
            };

        } catch (error) {

            console.error('CSRF token error:', error);

            return null;
        }
    }
});