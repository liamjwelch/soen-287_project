<?php

$table_name = "users";

function createConnection() {
    $conn = new PDO('mysql:host=127.0.0.1;dbname=soen287', get_current_user(), "password");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

function doCredentialsExist($username, $password) {
    global $table_name;
    $conn = createConnection();
    $statement = $conn->prepare("SELECT username, password FROM $table_name WHERE username = BINARY ? AND 
                                password = BINARY ?");
    $statement->execute([$username, $password]);
    $rows = $statement->fetchAll(PDO::FETCH_NUM);
    return count($rows) === 1;
}
