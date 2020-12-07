<?php

require "database/users.php";
require_once "functions/accountCreation.php";
require_once "email.php";

session_start();

if (isset($_GET["resend"]) && $_GET["resend"]) {
    if (isset($_SESSION["email"])) {
        $validationToken = generateValidationToken();
        setToken($_SESSION["email"], $validationToken);
        $url = getEmailVerificationURL($validationToken, $_SESSION["email"]);
        $name = getUserFullName($_SESSION["email"]);
        sendAccountCreationEmail($name, $_SESSION["email"], $url);
    }
    else {
        // TODO tell user that email no longer in session and he should log in to be able to get it
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Confirm your email address</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/form.css">
</head>
<body>
<main class="confirmation">
    <h2>Confirm your email address</h2>
    <p class="email">An email was sent to <?= $_SESSION["email"]; ?>.</p>
    <p class="email">Follow the instructions in the email to complete the creation of your account.</p>
    <p class="confirmationMessage">Didn't receive an email yet? Click <a href="emailConfirmation.php?resend=1">here</a> to resend the email.</p>
</main>
</body>
</html>

