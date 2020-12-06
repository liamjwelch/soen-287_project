<?php

require_once "database/users.php";

session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: homepage.php");
}

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

    $validationToken = bin2hex(random_bytes(25));
    try {
        addUser($email, $password, $role, $firstName, $lastName, $phone, $validationToken);
        $_SESSION["email"] = $email;
        $_SESSION["token"] = $validationToken;  // TODO replace by send email
        header("location: emailConfirmation.php");
        exit();
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
    <meta charset="UTF-8">
    <title>Dummy registration form</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<main class="form">
    <h1>Dummy registration form</h1>
    <h2>(I should not be here on dec 7)</h2>
    <form method="post">
        <input name="email" placeholder="email" required>
        <input name="password" value="qwerty" required>
        <input name="firstName" value="Obi-Wan" required>
        <input name="lastName" value="Kenobi" required>
        <input name="phone" value="1234567890" required>
        <input name="role" type="hidden" value="student">
        <button type="submit">Submit</button>
    </form>
</main>;
</body>
</html>
