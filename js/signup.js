function validateForm() {
    if (!validateGPA()) {
        var message = "GPA must be a number between 0 and 4.3";
        var display = document.getElementById("js-validation-msg");
        display.innerHTML = message;
        return false;
    } else if(!validatePassword()) {
        var message = "Password has to be 10 characters minimum, and must contain one uppercase letter, one lowercase letter, a digit, and a special character";
        var display = document.getElementById("js-validation-msg");
        display.innerHTML = message;
        return false;
    } else if(!confirmPassword()) {
        var message = "Confirmation doesn't match password";
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

function validatePassword() {
    var password = document.forms[0].password.value;
    var valid = false;
    if(/^(?=.*[a-z])/.test(password) && /^(?=.*[A-Z])/.test(password) && /^(?=.*[0-9])/.test(password) && /^(?=.*[!@#\$%\^&\*])/.test(password) && /(?=.{10,})/.test(password)) {
        valid = true;
    }
    return valid;
}

function confirmPassword() {
    var password = document.forms[0].password.value;
    var confirm = document.forms[0].confirm.value;
    var match = false;
    if(password == confirm) {
        match = true;
    }
    return match;
}