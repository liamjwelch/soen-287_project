<?php

define("DB_NAME", "soen287");

function createConnection() {
    $conn = new PDO('mysql:host=127.0.0.1;dbname=' . DB_NAME, get_current_user(), "password");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}
