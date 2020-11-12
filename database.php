<?php

$table_name = "users";

function createConnection() {
    $conn = new PDO('mysql:host=127.0.0.1;dbname=soen287', get_current_user(), "password");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

function doCredentialsExist($username, $password) {
    global $table_name;
    $conn = createConnection();
    $statement = $conn->prepare("SELECT username, password FROM $table_name WHERE username = BINARY ? AND 
                                password = BINARY ?");
    $statement->execute([$username, $password]);
    $rows = $statement->fetchAll(PDO::FETCH_NUM);
    return count($rows) === 1;
}

function addUser($email, $pass, $first, $last, $phone, $address, $program, $gpa) {
    global $table_name;
    $connection = createConnection();
    $statement = $connection->prepare("INSERT INTO $table_name VALUES (:email, :pass, :first, :last, :phone,
                                                                       :address, :program, :gpa)");
    $statement->bindValue("email", $email);
    $statement->bindValue("pass", $pass);
    $statement->bindValue("first", $first);
    $statement->bindValue("last", $last);
    $statement->bindValue("phone", $phone);
    $statement->bindValue("address", $address);
    $statement->bindValue("program", $program);
    $statement->bindValue("gpa", $gpa);
    $statement->execute();
    return $statement->rowCount() === 1;  // FIXME this does not seem to work
}

function getUserFirstName($email) {
    // TODO handle exceptions
    global $table_name;
    $connection = createConnection();
    $statement = $connection->prepare("SELECT first_name FROM $table_name WHERE username = BINARY ?");
    $statement->execute([$email]);
    $rows = $statement->fetchAll(PDO::FETCH_NUM);
    return $rows[0][0];
}
