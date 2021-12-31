
window.onload = function onStart() {
    // Date in database is stored in unixtimestamp to ensure that every client has date and time truthful to their own local time
    // This converts every timestamp into local data time format on client side 
    var datesToFormat = document.getElementsByClassName('dateToFormat');
    if (datesToFormat != null) {
        for (var i = 0; i < datesToFormat.length; i++) {

            datesToFormat[i].innerHTML = new Date(datesToFormat[i].innerHTML * 1000).toISOString().slice(0,
                16);

        }
    }
    // This does the same but with inputs
    var datesToFormatInput = document.getElementsByClassName('dateToFormatInput');
    if (datesToFormatInput != null) {
        for (var i = 0; i < datesToFormatInput.length; i++) {
            if (datesToFormatInput[i].type.toLowerCase() == 'datetime-local') {
                datesToFormatInput[i].value = new Date(datesToFormatInput[i].defaultValue * 1000)
                    .toISOString().slice(0, 16);
            }
        }
    }

    // Hiding success message onclick or onhoover
    var success = document.getElementById('success-message');
    if(success != null){
        success.addEventListener("mouseout", hideMessage);
        success.addEventListener("click", hideMessage);
    }
    
    var universityDone = document.getElementById('university-done');
    if( universityDone != null){
        universityDone.addEventListener("click", universityConfirmed);
    }

    var fieldDone = document.getElementById('field-done');
    if( fieldDone != null){
        fieldDone.addEventListener("click", fieldConfirmed);
    }

    var yearDone = document.getElementById('year-done');
    if( yearDone != null){
        yearDone.addEventListener("click", yearConfirmed);
    }

    
 
}

// Requesting data from API via ajax
function getData(url, target){
    $.ajax({
        url: url,
        type: 'get',
        success: function(data){
          appendResults(target, data);
       }
     });
}

// Appending ajax requested results into inputs datalist 
function appendResults(target, data){
    var targetList = document.getElementById(target);
    for(var i=0; i<data.length; i++){
        let option = document.createElement('option');
        option.append(data[i]);
        targetList.append(option);
    }
}

function universityConfirmed(){
    //Defining input
    var universityInput = document.getElementById('university-input');
    if(universityInput.value != ""){
        //Changing inputs and button ability to perform the operations
        universityInput.readOnly = true;
        document.getElementById('university-done').classList.add("disabled");
        document.getElementById('field-input').readOnly = false;
        document.getElementById('field-input').disabled = false;
        document.getElementById('field-done').classList.remove("disabled");

        //Requesting data from database via AJAX and puting them into according datalist
        var url = 'panel/get-fields/' + document.getElementById('university-input').value;
        getData(url, 'field-list');
    }
    else{
        //Informing user that operation is prevented 
        universityInput.placeholder = "Nie można przejść dalej bez uzupełnienia tego pola";
        universityInput.focus();
    }
    
}

function fieldConfirmed(){
    //Defining input
    var fieldInput = document.getElementById('field-input');
    if(fieldInput.value != ""){
        //Defining next inputs
        var yearInput = document.getElementById('year-input');
        var yearTypeInput = document.getElementById('year-type-input');

        //Changing inputs and button ability to perform the operations
        fieldInput.readOnly = true;
        document.getElementById('field-done').classList.add("disabled");
        yearInput.readOnly = false;
        yearTypeInput.readOnly = false;
        yearInput.disabled = false;
        yearTypeInput.disabled = false;
        document.getElementById('year-done').classList.remove("disabled");

        //Requesting data from database via AJAX and puting them into according datalist
        var url = 'panel/get-years/' + document.getElementById('university-input').value + '/' + document.getElementById('field-input').value;
        getData(url, 'year-list');
    }
    else{
        //Informing user that operation is prevented 
        fieldInput.placeholder = "Nie można przejść dalej bez uzupełnienia tego pola";
        fieldInput.focus();
    }
    
}

function yearConfirmed(){
    //Defining inputs 
    var yearInput = document.getElementById('year-input');
    var yearTypeInput = document.getElementById('year-type-input');

    if(yearInput.value != ""){
        if(yearTypeInput.value != ""){
            //Changing inputs and button ability to perform the operations
        yearInput.readOnly = true;
        yearTypeInput.readOnly = true;
        document.getElementById('year-done').classList.add("disabled");
        document.getElementById('subject-input').readOnly = false;
        document.getElementById('semester-input').readOnly = false;
        document.getElementById('teacher-input').readOnly = false;
        document.getElementById('subject-input').disabled = false;
        document.getElementById('semester-input').disabled = false;
        document.getElementById('teacher-input').disabled = false;

        //Requesting data from database via AJAX and puting them into according datalist
        var url = 'panel/get-subjects/' + document.getElementById('university-input').value + '/' + document.getElementById('field-input').value + '/' + document.getElementById('year-input').value;
        getData(url, 'subject-list');
        }
        else{
            //Informing user that operation is prevented 
            yearTypeInput.placeholder = "Nie można przejść dalej bez uzupełnienia tego pola";
            yearTypeInput.focus();
        }
        
    }
    else{
        //Informing user that operation is prevented 
        yearInput.placeholder = "Nie można przejść dalej bez uzupełnienia tego pola";
        yearInput.focus();
    }
    
}

function validateUltraAddForm(event){
    // prevent the form from submitting

    
    var subjectInput = document.getElementById('subject-input');
    var semesterInput = document.getElementById('semester-input');
    var teacherInput = document.getElementById('teacher-input');
    var yearInput = document.getElementById('year-input');
    var yearTypeInput = document.getElementById('year-type-input');
    var fieldInput = document.getElementById('field-input');
    var universityInput = document.getElementById('university-input');

    if(subjectInput.readOnly == false){
        if(subjectInput.value == "" && semesterInput.value == "" && teacherInput.value == ""){
            return true;
        }
        else if(subjectInput.value != "" && semesterInput.value != "" && teacherInput.value != ""){
            return true;
        }
        else{
            event.preventDefault();
            if(subjectInput.value == ""){
                subjectInput.placeholder = "Dodając przedmiot nalezy uzupełnić nazwę, semestr i wykładowcę"
            }
            if(semesterInput.value == ""){
                semesterInput.placeholder = "Dodając przedmiot nalezy uzupełnić nazwę, semestr i wykładowcę"
            }
            if(teacherInput.value == ""){
                teacherInput.placeholder = "Dodając przedmiot nalezy uzupełnić nazwę, semestr i wykładowcę"
            }
        }
    }

    if(yearInput.readOnly == false){
        if(yearInput.value == "" && yearTypeInput.value == ""){
            return true;
        }
        else if(yearInput.value != "" && yearTypeInput.value != ""){
            return true;
        }
        else{
            event.preventDefault();
            if(yearInput.value == ""){
                yearInput.placeholder = "Dodając rocznik nalezy uzupełnić nazwę i typ"
            }
            if(yearTypeInput.value == ""){
                yearTypeInput.placeholder = "Dodając przedmiot nalezy uzupełnić nazwę i typ"
            }
        }
    }



}

function hideMessage(){
    this.style.display ="none";
}



