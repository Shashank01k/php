// select all table row checkbox 
function selects(){  
    var ele=document.getElementsByName('chkRowId');  
    for(var i=0; i<ele.length; i++){  
        if(ele[i].type=='checkbox')  
            ele[i].checked=true;  
    }  
}

// deselect all table row checkbox
function deSelect(){  
    var ele=document.getElementsByName('chkRowId');  
    for(var i=0; i<ele.length; i++){  
        if(ele[i].type=='checkbox')  
            ele[i].checked=false;  
            
    }  
}

// delete selected checkbox
function deleteAllRows111() {//TODO:this function is not completed::

     var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
        var selectedValues = [];
        checkboxes.forEach(function(checkbox) {
            selectedValues.push(checkbox.value);
            // You can also remove the row from the table here if needed
            checkbox.parentNode.parentNode.remove();
        });

    fetch('users/delete/all/', {
        method: 'POST',
        body: JSON.stringify({ checkboxValue: selectedValues }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.jsonParse())
    .then(data => {
        console.log(data); // Log the response data
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:'+ error);
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');

    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

// var titleText = '';
function copyUserNameValue(titleText) {
    console.log(titleText)
    // Create a temporary input element
    var input = document.createElement("input");
    input.setAttribute("value", titleText);
    document.body.appendChild(input);

    // Select the text inside the input element
    input.select();

    // Copy the selected text
    document.execCommand("copy");

    // Remove the temporary input element
    document.body.removeChild(input);

    // Alert the user (optional)
    var messageDiv = document.getElementById("messageDiv");
    messageDiv.textContent = "Copied: " + titleText;

    // alert("Copied the text: " + titleText);
}


function deleteAllRows() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');

    const selectedValues = [];
    checkboxes.forEach(function (checkbox) {
        selectedValues.push(checkbox.value);
    });

    if (selectedValues.length === 0) {
        alert('Please select at least one user.');
        return;
    }

    // Build Form Data
    const params = new URLSearchParams();
    selectedValues.forEach(function (id) {
        params.append('checkboxValue[]', id);
    });

    // Add CSRF Token
    params.append(csrfTokenName, csrfHash);

    // Send AJAX Request
    fetch('/admin/users/delete/all', {
        method: 'POST',
        body: params,
        credentials: 'same-origin', // Crucial: Sends current admin session cookie
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(async (response) => {
        // If session expired or filter rejected request
        if (response.status === 401) {
            alert('Session expired. Please log in again.');
            window.location.href = '/admin/login';
            return;
        }

        if (!response.ok) {
            throw new Error('Server returned an error');
        }

        return response.json();
    })
    .then((data) => {
        if (data && data.status === 'success') {
            alert(data.message || 'Users deleted successfully.');
            location.reload(); // Refresh table view
        }
    })
    .catch((error) => {
        console.error('AJAX Error:', error);
    });
}