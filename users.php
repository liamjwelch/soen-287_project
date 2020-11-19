<?php

require_once "database.php";

function addUser($email, $password, $role, $firstName, $lastName) {
    global $table_name;
    $connection = createConnection();
    $statement = $connection->prepare("INSERT INTO $table_name VALUES (:email, :pass, :role, :first, :last)");
    $statement->bindValue("email", $email);
    $statement->bindValue("pass", $password);
    $statement->bindValue("role", $role);
    $statement->bindValue("first", $firstName);
    $statement->bindValue("last", $lastName);
    $statement->execute();
    return $statement->rowCount() === 1;
}
