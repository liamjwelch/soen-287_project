function validateForm() {
    if (!validateGPA()) {
        var message = "GPA must be a number between 0 and 4.3";
        var display = document.getElementById("js-validation-msg");
        display.innerHTML = message;
        return false;
    }
    return true;
}

function validateGPA() {
    var gpa = document.forms[0].gpa.value;
    return gpa >= 0 && gpa <= 4.3;
}
