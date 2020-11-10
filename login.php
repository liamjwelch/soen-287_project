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
}
else {
    $_SESSION["errormsg"] = "Invalid HTTP method";
}
header("location: home.php");
