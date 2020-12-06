<?php

require_once "connection.php";
require_once "users.php";


function createStudentsTable() {
    $connection = createConnection();
    $statement = $connection->prepare("CREATE TABLE students (email VARCHAR(50) PRIMARY KEY NOT NULL,
                                                              city VARCHAR(50),
                                                              state VARCHAR(50),
                                                              country VARCHAR(50),
                                                              program VARCHAR(50),
                                                              gpa DECIMAL(3,2),
                                                              preferredSetting CHAR(10),
                                                              preferredSize CHAR(12),
                                                              preferredRanking INT,
                                                              householdIncome INT,
                                                              budget INT,
                                                              description TEXT)");
    try {
        $success = $statement->execute();
        if ($success) {
            return "Table students created successfully <br>";
        }
        else {
            return "Error when creating students table: "  . $statement->errorInfo()[2] . "<br>";
        }
    }
    catch (PDOException $e) {
        return "Error when creating students table: " . $e->getMessage() . "<br>";
    }
}

/*
 *  Add a new student profile in the database for the user with the given email and token, and set this user's email
 *  as verified. If an error occurs with one of those operations, both are rollbacked and an exception is thrown.
 *  This function also checks if the token is valid and throws an exception if not.
 */
function createStudent($email, $token, $city, $state, $country, $program, $gpa, $preferredSetting, $preferredSize,
                       $preferredRanking, $householdIncome, $budget, $description) {
    if (isTokenValid($email, $token)) {
        $connection = createConnection();
        $success = $connection->beginTransaction();
        if ($success) {
            try {
                addStudent($email, $city, $state, $country, $program, $gpa, $preferredSetting, $preferredSize,
                           $preferredRanking, $householdIncome, $budget, $description, $connection);
                setEmailVerified($_POST["email"]);
                $success = $connection->commit();
                if(!$success) {
                    $connection->rollBack();
                    throw new PDOException("An error occurred when finalizing the creation of your account");
                }
            }
            catch (PDOException $e) {
                $connection->rollBack();
                throw $e;
            }
        } else {
            $connection->rollBack();
            throw new PDOException("Error when trying to begin transaction: " . $connection->errorInfo()[2]);
        }
    }
    else {
        throw new Exception("Your token is invalid, please request a new one");
    }
}

function addStudent($email, $city, $state, $country, $program, $gpa, $preferredSetting, $preferredSize,
                    $preferredRanking, $householdIncome, $budget, $description, $connection=null) {
    if (is_null($connection)) {
        $connection = createConnection();
    }
    $statement = $connection->prepare("INSERT INTO students VALUES (:email, :city, :state, :country, :program, :gpa,
                                       :preferredSetting, :preferredSize, :preferredRanking, :householdIncome, :budget,
                                       :description)");
    $statement->bindValue("email", $email);
    $statement->bindValue("city", $city);
    $statement->bindValue("state", $state);
    $statement->bindValue("country", $country);
    $statement->bindValue("program", $program);
    $statement->bindValue("gpa", $gpa);
    $statement->bindValue("preferredSetting", $preferredSetting);
    $statement->bindValue("preferredSize", $preferredSize);
    $statement->bindValue("preferredRanking", $preferredRanking);
    $statement->bindValue("householdIncome", $householdIncome);
    $statement->bindValue("budget", $budget);
    $statement->bindValue("description", $description);
    $success = $statement->execute();
    if (!$success || $statement->rowCount() !== 1) {
        throw new PDOException("Error when adding student to the database: " . $statement->errorInfo()[2]);
    }
}

function getStudent($email) {
    $connection = createConnection();
    $statement = $connection->prepare("SELECT city, state, country FROM students WHERE email = BINARY ?");
    $statement->execute([$email]);
    $row = $statement->fetch();
    //print_r($row);
    return $row;
}
