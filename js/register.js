function validateForm() {
    if(!validatePassword()) {
        var message = "Password has to be 10 characters minimum, and must contain one uppercase letter, one lowercase letter, a digit, and a special character";
        var display = document.getElementById("js-validation-msg");
        document.forms[0].password.value = "";
        document.forms[0].confirm.value = "";
        display.innerHTML = message;
        return false;
    }
    
    if(!confirmPassword()) {
        var message = "Confirmation doesn't match password";
        var display = document.getElementById("js-validation-msg");
        document.forms[0].confirm.value = "";
        display.innerHTML = message;
        return false;
    }

    return true;
}

function validatePassword() {
    console.log('here')
    var password = document.forms[0].password.value;
    var valid = false;

    console.log(password, /(?=.{10,})/.test(password), password.length)
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