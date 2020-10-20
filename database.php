<?php

$servername = "localhost";
$username = get_current_user();
$password = "password";
$table_name = "users";
$dbname = "soen287";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
}

function doCredentialsExist($username, $password) {
    global $conn, $table_name;
    $query = "SELECT username, password FROM $table_name WHERE username = BINARY '$username' AND password = BINARY '$password'";
    $result = $conn->query($query);
    return $result->num_rows === 1;
}
