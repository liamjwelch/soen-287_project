<?php

function createConnection() {
    $conn = new PDO('mysql:host=127.0.0.1;dbname=soen287', get_current_user(), "password");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}
