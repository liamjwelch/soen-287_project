
// Onsubmit function
function validateForm() {
    if(!validatePassword()) {
        var message = "Password has to be 10 characters minimum," 
                    + "and must contain one uppercase letter, one lowercase letter, a digit, and a special character";
        var display = document.getElementById("js-validation-msg");
        document.forms[0].password.value = "";
        document.forms[0].confirm.value = "";
        display.innerHTML = message;
        return false;
    }
    
    if(!confirmPassword()) {
        var message = "Both passwords must match";
        var display = document.getElementById("js-validation-msg");
        document.forms[0].confirm.value = "";
        display.innerHTML = message;
        return false;
    }

    return true;
}

// Checks if the password matches certain requirements
function validatePassword() {
    var password = document.forms[0].password.value;
    var valid = false;

    if(/^(.*[a-z])/.test(password) && /^(.*[A-Z])/.test(password) && /^(.*[0-9])/.test(password) && /^(.*[!@#\$%\^&\*])/.test(password) && /(.{10,})/.test(password)) {
        valid = true;
    }

    return valid;
}

// Checks for equality between both passwords
function confirmPassword() {
    var password = document.forms[0].password.value;
    var confirm = document.forms[0].confirm.value;
    return password === confirm;
}