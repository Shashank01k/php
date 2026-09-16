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

    const selectedIds = [...document.querySelectorAll(
        '.user-checkbox:checked'
    )].map(checkbox => checkbox.value);

    if (!selectedIds.length) {
        return;
    }

    if (!confirm(
        `Are you sure you want to delete ${selectedIds.length} user(s)?`
    )) {
        return;
    }

    const params = new URLSearchParams();

    selectedIds.forEach(id => {
        params.append('checkboxValue[]', id);
    });

    params.append(csrfTokenName, csrfHash);

    fetch('/users/delete/all', {
        method: 'POST',
        body: params,
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {

        if (data.status) {
            window.location.reload();
        }

    })
    .catch(error => {
        console.error('Delete error:', error);
    });
}