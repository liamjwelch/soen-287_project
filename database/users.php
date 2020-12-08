<?php

require_once "connection.php";

function createUsersTable() {
    $connection = createConnection();
    $message = "";
    $statement = $connection->prepare("CREATE TABLE users (email VARCHAR(50) PRIMARY KEY NOT NULL,
                                      password VARCHAR(255) NOT NULL, role VARCHAR(10) NOT NULL,
                                      firstName VARCHAR(50) NOT NULL, lastName VARCHAR(50) NOT NULL,
                                      phone CHAR(10) NOT NULL, emailVerified BOOLEAN, validationToken char(50))");
    try {
        if ($statement->execute() === TRUE) {
            $message .= "Table users created successfully <br>";
            $result = addUser("nico@example.com", "qwerty", "student", "Nicolas", "Aubry", "1234553456");
            setEmailVerified("nico@example.com");
            if ($result) {
                $message .= "<br>Student nico@example.com added to database<br>";
            }
            $result = addUser("john@havard.edu", "password", "recruiter", "John", "Smith", "0987891234");
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

function addUser($email, $password, $role, $firstName, $lastName, $phone, $validationToken=null) {
    $connection = createConnection();
    $statement = $connection->prepare("INSERT INTO users VALUES (:email, :pass, :role, :first, :last, :phone,
                                                                 :emailVerified, :validationToken)");
    $statement->bindValue("email", $email);
    $statement->bindValue("pass", $password);
    $statement->bindValue("role", $role);
    $statement->bindValue("first", $firstName);
    $statement->bindValue("last", $lastName);
    $statement->bindValue("phone", $phone);
    $statement->bindValue("emailVerified", 0);
    $statement->bindValue("validationToken", $validationToken);
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

function getUserFirstAndLast($email) {
    $connection = createConnection();
    $statement = $connection->prepare("SELECT firstName, lastName FROM users WHERE email = BINARY ?");
    $statement->execute([$email]);
    $result = $statement->fetch();
    return $result;
}

function doesUserExist($email) {
    $connection = createConnection();
    $statement = $connection->prepare("SELECT email FROM users WHERE email = BINARY ?");
    $statement->execute([$email]);
    $foundEmail = $statement->fetchAll(PDO::FETCH_NUM);
    if ($email = $foundEmail) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function doCredentialsExist($username, $password) {
    $conn = createConnection();
    $statement = $conn->prepare("SELECT email, password FROM users WHERE email = BINARY ? AND password = BINARY ?");
    $statement->execute([$username, $password]);
    $rows = $statement->fetchAll(PDO::FETCH_NUM);
    return count($rows) === 1;
}

function isTokenValid($email, $token) {
    $connection = createConnection();
    $statement = $connection->prepare("SELECT email FROM users WHERE email = BINARY ? AND validationToken = ?");
    $statement->execute([$email, $token]);
    $rows = $statement->fetchAll(PDO::FETCH_NUM);
    return count($rows) === 1;
}

function setEmailVerified($email) {
    $connection = createConnection();
    $statement = $connection->prepare("UPDATE users SET emailVerified = 1, validationToken = NULL
                                       WHERE email = BINARY ?");
    $success = $statement->execute([$email]);
    if (!$success || $statement->rowCount() !== 1) {
        throw new PDOException("Error when setting email $email to verified: " . $statement->errorInfo()[2]);
    }
}

function setToken($email, $token) {
    $connection = createConnection();
    $statement = $connection->prepare("UPDATE users SET validationToken = ? WHERE email = BINARY ?");
    $statement->execute([$token, $email]);
    return $statement->rowCount() === 1;
}

function isEmailVerified($email) {
    $connection = createConnection();
    $statement = $connection->prepare("SELECT emailVerified FROM users WHERE email = BINARY ?");
    $statement->execute([$email]);
    $rows = $statement->fetchAll(PDO::FETCH_NUM);
    return $rows[0][0] === "1";
}
