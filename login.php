<?php

require "database.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    try {
        if (doCredentialsExist($username, $password)) {
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            header("location: home.php");
        }
        else {
            $_SESSION["errormsg"] = "Invalid login credentials";
            header("location: home.php");
        }
    }
    catch (Exception $e) {
        $_SESSION["errormsg"] = $e->getMessage();
        header("location: home.php");
    }
}
else {
    $_SESSION["errormsg"] = "Invalid HTTP method";
    header("location: home.php");
}
