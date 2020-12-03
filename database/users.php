<?php

require_once "connection.php";

function createUsersTable() {
    $connection = createConnection();
    $message = "";
    $statement = $connection->prepare("CREATE TABLE users (email VARCHAR(50) PRIMARY KEY NOT NULL,
                                      password VARCHAR(255) NOT NULL, role VARCHAR(10) NOT NULL, 
                                      firstName VARCHAR(50) NOT NULL, lastName VARCHAR(50) NOT NULL,
                                      emailVerified BOOLEAN)");
    try {
        if ($statement->execute() === TRUE) {
            $message .= "Table users created successfully <br>";
            $result = addUser("nico@example.com", "qwerty", "student", "Nicolas", "Aubry");
            if ($result) {
                $message .= "<br>Student nico@example.com added to database<br>";
            }
            $result = addUser("john@havard.edu", "password", "recruiter", "John", "Smith");
            if ($result) {
                $message .= "<br>Recruiter john@havard.edu added to database<br>";
            }
        } else {
            $message .= "Error creating table: " . $statement->errorInfo()[2] . "<br>";
        }
    } catch (PDOException $e) {
        $message .= "Error creating table: " . $e->getMessage() . "<br>";
    }
    return $message;
}

function addUser($email, $password, $role, $firstName, $lastName) {
    $connection = createConnection();
    $statement = $connection->prepare("INSERT INTO users VALUES (:email, :pass, :role, :first, :last, :emailVerified)");
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
    $connection = createConnection();
    $statement = $connection->prepare("SELECT firstName FROM users WHERE email = BINARY ?");
    $statement->execute([$email]);
    $rows = $statement->fetchAll(PDO::FETCH_NUM);
    return $rows[0][0];
}

function doCredentialsExist($username, $password) {
    $conn = createConnection();
    $statement = $conn->prepare("SELECT email, password FROM users WHERE email = BINARY ? AND password = BINARY ?");
    $statement->execute([$username, $password]);
    $rows = $statement->fetchAll(PDO::FETCH_NUM);
    return count($rows) === 1;
}