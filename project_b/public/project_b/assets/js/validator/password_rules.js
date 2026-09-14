//TODO:remove unwanted code
document.addEventListener('DOMContentLoaded', () => {
    const passwordInput = document.getElementById('password');

    if (!passwordInput) {
        console.error("Password input field with id='password' was not found.");
        return;
    }

    let csrfHeader = document.querySelector('meta[name="csrf-header"]')?.getAttribute('content') || 'X-CSRF-TOKEN';
    
    passwordInput.addEventListener('input', async () => {

        // const latestCsrfToken = await getCsrfToken();

        latestCsrfToken = await getCsrfToken();
        // if (!latestCsrfToken) {
        //     latestCsrfToken = await getCsrfToken();
        // }

        const password = passwordInput.value;

        // console.log('passwordInput_new',passwordInput.value, password);
        console.log(latestCsrfToken.csrfHash);
        

        if (!latestCsrfToken) {
            return;
        }
        // const latestCsrfTokenHash = latestCsrfToken.hash;
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
                body: JSON.stringify({ password })
            });

            if (!response.ok) {
                resetChecklist();

                return;
            }

            const result = await response.json();

            // Refresh CSRF Token if returned
            // if (result.csrfName && result.csrfHash) {
            //     csrfTokenName = result.csrfName;
            //     csrfHash = result.csrfHash;
            // }

            // Check if server returned a success status and checks object
            if (result.status === 'success' || result.checks) {
                updateChecklist(result.checks);
            } else {
                resetChecklist();
            }
        } catch (error) {
            console.error('Validation error:', error);

            alert('Something went wrong. Please try again later.');

            resetChecklist(); // Reset checklist on fetch exception
        }
    });

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

    let latestCsrfToken = null;

    async function getCsrfToken()
    {
        const response = await fetch('/csrf-token');

        if (!response.ok) {
            throw new Error('Unable to get CSRF token');
        }

        return await response.json();
    }

    //TODO:remove
    async function getCsrfToken1()
    {
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