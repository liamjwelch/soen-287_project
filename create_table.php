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
    $query = "CREATE TABLE $name (username VARCHAR(50) PRIMARY KEY NOT NULL, password VARCHAR(255) NOT NULL)";

    if ($connection->query($query) === TRUE) {
        echo "Table users created successfully";
        addUser("nicolas", "qwerty");
        addUser("Elon", "spaceX");
    } else {
        echo "Error creating table: " . $connection->error;
    }
}

function doesTableExist($connection, $dbname, $table_name) {
    $query = "SELECT * FROM INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA='$dbname' and table_name='$table_name'";
    $result = $connection->query($query);
    return $result->num_rows === 1;
}

function addUser($name, $pass) {
    global $table_name, $conn;
    $query = "INSERT INTO $table_name VALUES ('$name', '$pass')";
    if ($conn->query($query) === true) {
        echo "<br>user $name added to database<br>";
    }
    else {
        echo "<br>Failed to add user to table: (" . $conn->connect_errno . ") " . $conn->connect_error . "<br>";
    }
}
