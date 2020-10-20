<?php

$servername = "localhost";
$username = "nicolas";
$password = "password";
$table_name = "users";
$dbname = "soen287";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
}
else if (!doesTableExists($conn, $dbname, $table_name)) {
    createTable($conn, $table_name);
}
else {
    echo "Table already exists";
}

function createTable($connection, $name) {
    $sql = "CREATE TABLE $name (username VARCHAR(50) PRIMARY KEY NOT NULL, password VARCHAR(255) NOT NULL)";

    if ($connection->query($sql) === TRUE) {
        echo "Table users created successfully";
    } else {
        echo "Error creating table: " . $connection->error;
    }
}

function doesTableExists($connection, $dbname, $table_name) {
    $query = "SELECT * FROM INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA='$dbname' and table_name='$table_name'";
    $result = $connection->query($query);
    return $result->num_rows === 1;
}
