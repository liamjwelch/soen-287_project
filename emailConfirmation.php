<?php

require "database/users.php";

session_start();

if (isset($_GET["resend"]) && $_GET["resend"]) {
    $validationToken = bin2hex(random_bytes(25));
    setToken($_SESSION["email"], $validationToken);
    $_SESSION["token"] = $validationToken;
}

$token = $_SESSION["token"];
$encodedEmail = urlencode($_SESSION["email"]);
$url = "studentProfileCreationForm.php?token=$token&email=$encodedEmail";

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
    <p>
        For now, we just print the link <?= "<a href='$url'>here</a>"; ?>
    </p>
</main>

<?php readfile("footer.html"); ?>
</body>
</html>

