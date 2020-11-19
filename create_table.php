<?php

require_once "database.php";
require "users.php";

$table_name = "users";
$dbname = "soen287";

$conn = createConnection();

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn->exec("DROP TABLE $table_name");
}

if (!doesTableExist($conn, $dbname, $table_name)) {
    createTable($conn, $table_name);
}
else {
    $message .= "Table already exists<br>";
}

function createTable($connection, $name) {
    global $message;
    $statement = $connection->prepare("CREATE TABLE $name (username VARCHAR(50) PRIMARY KEY NOT NULL,
                                      password VARCHAR(255) NOT NULL, role VARCHAR(10) NOT NULL, 
                                      firstName VARCHAR(50) NOT NULL, lastName VARCHAR(50) NOT NULL)");
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
}

function doesTableExist($connection, $dbname, $table_name) {
    $statement = $connection->prepare("SELECT * FROM INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA=? and table_name=?");
    $statement->execute([$dbname, $table_name]);
    $rows = $statement->fetchAll(PDO::FETCH_NUM);
    return count($rows) === 1;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Database management</title>
</head>
<body>
    <p><?php echo $message ?></p>
    <form method="post">
        <input type="submit" value="Reset users table">
    </form>
</body>
</html>
