console.log('this is my dashboard js file::')

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
function deleteAllRows() {//TODO:this function is not completed::
    console.log("delete row:: function in Java script"); 
    // return false;

     var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
        var selectedValues = [];
        checkboxes.forEach(function(checkbox) {
            selectedValues.push(checkbox.value);
            // You can also remove the row from the table here if needed
            checkbox.parentNode.parentNode.remove();
        });
    // console.log(selectedValues);
    // return false;

    fetch('delete/all/', {
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