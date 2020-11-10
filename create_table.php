<?php

require "database.php";

$table_name = "users";
$dbname = "soen287";

$conn = createConnection();

if (!doesTableExist($conn, $dbname, $table_name)) {
    createTable($conn, $table_name);
}
else {
    echo "Table already exists";
}

function createTable($connection, $name) {
    $statement = $connection->prepare("CREATE TABLE $name (username VARCHAR(50) PRIMARY KEY NOT NULL,
                                      password VARCHAR(255) NOT NULL)");

    if ($statement->execute() === TRUE) {
        echo "Table users created successfully";
        addUser($connection,"nicolas", "qwerty");
        addUser($connection,"Elon", "spaceX");
    } else {
        echo "Error creating table: " . $statement->errorInfo()[2] . "<br>";
    }
}

function doesTableExist($connection, $dbname, $table_name) {
    $statement = $connection->prepare("SELECT * FROM INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA=? and table_name=?");
    $statement->execute([$dbname, $table_name]);
    $rows = $statement->fetchAll(PDO::FETCH_NUM);
    return count($rows) === 1;
}

function addUser($connection, $name, $pass) {
    global $table_name;
    $statement = $connection->prepare("INSERT INTO $table_name VALUES (?, ?)");
    $statement->execute([$name, $pass]);
    if ($statement->rowCount() === 1) {
        echo "<br>user $name added to database<br>";
    }
    else {
        echo "<br>Failed to add user to table: (" . $statement->errorInfo()[2] . "<br>";
    }
}
