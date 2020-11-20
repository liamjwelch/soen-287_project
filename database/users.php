<?php

require_once "connection.php";

$table_name = "users";

function addUser($email, $password, $role, $firstName, $lastName) {
    global $table_name;
    $connection = createConnection();
    $statement = $connection->prepare("INSERT INTO $table_name VALUES (:email, :pass, :role, :first, :last,
                                                                       :emailVerified)");
    $statement->bindValue("email", $email);
    $statement->bindValue("pass", $password);
    $statement->bindValue("role", $role);
    $statement->bindValue("first", $firstName);
    $statement->bindValue("last", $lastName);
    $statement->bindValue("emailVerified", 0);
    $statement->execute();
    return $statement->rowCount() === 1;
}

function getUserFirstName($email) {
    global $table_name;
    $connection = createConnection();
    $statement = $connection->prepare("SELECT firstName FROM $table_name WHERE email = BINARY ?");
    $statement->execute([$email]);
    $rows = $statement->fetchAll(PDO::FETCH_NUM);
    return $rows[0][0];
}

function doCredentialsExist($username, $password) {
    global $table_name;
    $conn = createConnection();
    $statement = $conn->prepare("SELECT email, password FROM $table_name WHERE email = BINARY ? AND 
                                password = BINARY ?");
    $statement->execute([$username, $password]);
    $rows = $statement->fetchAll(PDO::FETCH_NUM);
    return count($rows) === 1;
}