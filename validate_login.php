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
            return;
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
        header("location: home.php");
    }
    else {
        header("location: login.php");
    }
}
