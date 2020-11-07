<?php

$table_name = "users";

function createConnection() {
    $conn = new mysqli("127.0.0.1",get_current_user(), "password", "soen287");

    if ($conn->connect_errno) {
        throw new Exception("Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error);
    }
    else {
        return $conn;
    }
}

function doCredentialsExist($username, $password) {
    global $table_name;
    $conn = createConnection();
    $query = "SELECT username, password FROM $table_name WHERE username = BINARY '$username' AND password = BINARY '$password'";
    $result = $conn->query($query);
    return $result->num_rows === 1;
}
