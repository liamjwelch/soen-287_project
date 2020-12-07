<?php

require_once "database/users.php";
require_once "email.php";
require_once "functions/accountCreation.php";

session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: homepage.php");
}

$error = FALSE;
$errorPrompt = " ";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $password = trim($_POST["password"]);
    $firstName = trim(filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING));
    $lastName = trim(filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING));
    $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
    $role = trim(filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING));

    // TODO make sure no variable is empty
    // TODO validate values of some fields, make sure the same validation as in the front end is applied.

    $phone = preg_replace("/-/", "", $phone);

    try {
        if(doesUserExist($email)){
            $error = TRUE;
            $errorPrompt = "Sorry, but that email already exists in our records. Please select another email.";
        } else {
            $validationToken = generateValidationToken();
            addUser($email, $password, $role, $firstName, $lastName, $phone, $validationToken);
            $url = getEmailVerificationURL($validationToken, $email);
            sendAccountCreationEmail("$firstName $lastName", $email, $url);
            $_SESSION["email"] = $email;
            header("location: emailConfirmation.php");
            exit();
        }
    }
    catch (PDOException $e) {
        // TODO redirect to signup and display error to the user
        echo $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Create an account - AHED</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/form.css">
    <script src="js/register.js" type="text/javascript"></script>
</head>
<body>
<main class="signup-main" onsubmit="return validateForm()">
    <form class="signup-form" method="post" action="">
        <h1>Create an Account</h1>
        <fieldset>
            <legend>Account Information</legend>
            <label>Email Address:
                <input type="text" name="email" placeholder="me@example.com" pattern="[\w.-]+@[\w.-]+\.[A-Za-z]{2,}"
                       title="valid email address" maxlength="50" required>
            </label>
            <label>Password:
                <input type="password" name="password" placeholder="Password" minlength="10" maxlength="250" required>
            </label>
        </fieldset>
        <fieldset>
            <legend>Personal Information</legend>
            <label>First Name:<input type="text" name="firstName" pattern="[A-Za-z-]+" title="only letters and hyphens" maxlength="20"
                                     required>
            </label>
            <label>Last Name:<input type="text" name="lastName" maxlength="20" pattern="[A-Za-z-]+" title="only letters and hyphens"
                                    required></label>
            <label>Phone Number:<input type="tel" name="phone" placeholder="123-456-7890"  pattern="\d{3}-\d{3}-\d{4}"
                                       title="123-456-7890" required></label>
        </fieldset>
        <label><input type="checkbox" name="tc_agreed" class="checkbox" required>I agree with the <a href="terms.php">terms and conditions</a></label>
        <input type="hidden" name="role" value="student">
        <p id="js-validation-msg" class="error-message"></p>
        <button type="reset" class="registration-button">start over</button>
        <button type="submit" class="registration-button">Submit</button>
        <p class="error-message">
        <p class="userExists"><?php if ($error) echo $errorPrompt;?>
            <?php
            if (isset($_SESSION["errormsg"])) {
                echo $_SESSION["errormsg"];
                unset($_SESSION["errormsg"]);
            }
            ?>
        </p>
        <p class="message">Already a user?
            <a href="login.php">Login</a>
        </p>
    </form>
</main>
</body>
</html>
