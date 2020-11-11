<?php

require 'database.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $password = trim($_POST["password"]);
    $first_name = trim(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING));
    $last_name = trim(filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING));
    $phone_number = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
    $address = trim(filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING));
    $program = trim(filter_input(INPUT_POST, 'program', FILTER_SANITIZE_STRING));
    $gpa = trim(filter_input(INPUT_POST, "gpa", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));

    // TODO make sure no variable is empty
    // TODO validate values of some fields, make sure the same validation as in the front end is applied.

    // for now we just create the user:
    try {
        addUser($email, $password, $first_name, $last_name, $phone_number, $address, $program, $gpa);
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $email;
        header("location: home.php");
    }
    catch (PDOException $e) {
        // TODO redirect to signup and display error to the user
        echo $e->getMessage();
    }
}
