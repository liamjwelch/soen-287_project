<?php

require "database/users.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    try {
        if (doCredentialsExist($email, $password)) {
            $_SESSION["email"] = $email;

            if (isEmailVerified($email)) {
                $_SESSION["loggedin"] = true;
                header("location: homepage.php");
            }
            else {
                // email still not validated or account creation incomplete
                header("location: emailConfirmation.php");
            }
            exit();
        }
        else {
            $_SESSION["errormsg"] = "Invalid login credentials";
        }
    }
    catch (PDOException $e) {
        $_SESSION["errormsg"] = "Error when connecting to the database: " .  $e->getMessage();
    }
    catch (Exception $e) {
        $_SESSION["errormsg"] = $e->getMessage();
    }
    header("location: login.php");
}
else {
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        header("location: homepage.php");
    }
    else {
        header("location: login.php");
    }
}
