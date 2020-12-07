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
    <meta charset="UTF-8">
    <title>Confirm your email address</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php include "navbar.php"; ?>

<main>
    <h1>Confirm your email address</h1>
    <p>
        An email was sent to <?= $_SESSION["email"]; ?>.
        Follow the instructions in the email to complete the creation of your account.
    </p>
    <p>
        Didn't receive an email yet? Click <a href="emailConfirmation.php?resend=1">here</a> to resend the email.
    </p>
</main>

<?php readfile("footer.html"); ?>
</body>
</html>

