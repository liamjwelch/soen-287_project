<?php

require "database.php";

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
    $statement = $connection->prepare("CREATE TABLE $name (
                                       username VARCHAR(50) PRIMARY KEY NOT NULL,
                                       password VARCHAR(255) NOT NULL,
                                       first_name VARCHAR(50) NOT NULL,
                                       last_name VARCHAR(50) NOT NULL,
                                       phone_number CHAR(12) NOT NULL,
                                       address VARCHAR(200),
                                       program VARCHAR(100),
                                       gpa DECIMAL(3,2) NOT NULL)");

    if ($statement->execute() === TRUE) {
        $message .= "Table users created successfully";
        addUser($connection,"nicolas", "qwerty");
        addUser($connection,"Elon", "spaceX");
    } else {
        $message .= "Error creating table: " . $statement->errorInfo()[2] . "<br>";
    }
}

function doesTableExist($connection, $dbname, $table_name) {
    $statement = $connection->prepare("SELECT * FROM INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA=? and table_name=?");
    $statement->execute([$dbname, $table_name]);
    $rows = $statement->fetchAll(PDO::FETCH_NUM);
    return count($rows) === 1;
}

function addUser($connection, $name, $pass) {
    global $table_name, $message;
    $statement = $connection->prepare("INSERT INTO $table_name VALUES (:username, :pass, :first, :last, :phone,
                                                                       :address, :program, :gpa)");
    $statement->bindValue("username", "$name@example.com");
    $statement->bindValue("pass", $pass);
    $statement->bindValue("first", $name);
    $statement->bindValue("last", "Smith");
    $statement->bindValue("phone", "123-456-7890");
    $statement->bindValue("address", "somewhere in boston");
    $statement->bindValue("program", "computer science");
    $statement->bindValue("gpa", 2.5);
    $statement->execute();
    if ($statement->rowCount() === 1) {
        $message .= "<br>user $name added to database<br>";
    }
    else {
        $message .= "<br>Failed to add user to table: (" . $statement->errorInfo()[2] . "<br>";
    }
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
