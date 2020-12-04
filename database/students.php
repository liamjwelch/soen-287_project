<?php

require_once "connection.php";
require_once "users.php";


function createStudentsTable() {
    $connection = createConnection();
    $statement = $connection->prepare("CREATE TABLE students (email VARCHAR(50) PRIMARY KEY NOT NULL,
                                                              address VARCHAR(250),
                                                              program VARCHAR(50),
                                                              gpa DECIMAL(3,2),
                                                              preferredSetting CHAR(10),
                                                              maxDistance INT,
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
            return 'Error when creating students table: $statement->execute() returned false' . "<br>";
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
function createStudent($email, $token, $address, $program, $gpa, $preferredSetting, $maxDistance, $preferredSize,
                       $preferredRanking, $householdIncome, $budget, $description) {
    if (isTokenValid($email, $token)) {
        $connection = createConnection();
        $success = $connection->beginTransaction();
        if ($success) {
            $success = addStudent($email, $address, $program, $gpa, $preferredSetting, $maxDistance, $preferredSize,
                                  $preferredRanking, $householdIncome, $budget, $description, $connection);
            if ($success) {
                $success = setEmailVerified($_POST["email"]);
                if ($success) {
                    if(!$connection->commit()) {
                        $connection->rollBack();
                        throw new PDOException("An error occurred when finalizing the creation of your account");
                    }
                }
                else {
                    $connection->rollBack();
                    throw new PDOException("An error occurred when finalizing the creation of your account");
                }
            }
            else {
                $connection->rollBack();
                throw new PDOException("An error occurred when trying to add your account to the database");
            }
        } else {
            $connection->rollBack();
            throw new PDOException("An error occurred when trying to create your account");
        }
    }
    else {
        throw new Exception("Your token is invalid, please request a new one");
    }
}

function addStudent($email, $address, $program, $gpa, $preferredSetting, $maxDistance, $preferredSize,
                    $preferredRanking, $householdIncome, $budget, $description, $connection=null) {
    if (is_null($connection)) {
        $connection = createConnection();
    }
    $statement = $connection->prepare("INSERT INTO students VALUES (:email, :address, :program, :gpa, :preferredSetting,
                                       :maxDistance, :preferredSize, :preferredRanking, :householdIncome, :budget, 
                                       :description)");
    $statement->bindValue("email", $email);
    $statement->bindValue("address", $address);
    $statement->bindValue("program", $program);
    $statement->bindValue("gpa", $gpa);
    $statement->bindValue("preferredSetting", $preferredSetting);
    $statement->bindValue("maxDistance", $maxDistance);
    $statement->bindValue("preferredSize", $preferredSize);
    $statement->bindValue("preferredRanking", $preferredRanking);
    $statement->bindValue("householdIncome", $householdIncome);
    $statement->bindValue("budget", $budget);
    $statement->bindValue("description", $description);
    $success = $statement->execute();
    return $success && $statement->rowCount() === 1;
}
