<?php

require_once "connection.php";
require_once "universities.php";
require "users.php";

$conn = createConnection();

/*
 * return an associative arrays with keys being the main table names, and the values the sub tables of a given table.
 */
function getTableNames() {
    return ["users" => [], "universities" => ["programs", "scholarships", "costs"]];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $table_name = $_POST["table_name"];
    if ($table_name === "all") {
        resetAllTables($conn);
    }
    else {
        resetTable($conn, $table_name);
    }
}
else {
    foreach(getTableNames() as $table_name => $value) {
        if (doesTableExist($conn, $table_name)) {
            echo "Table $table_name already exists <br>";
        }
        else {
            createTable($table_name);
        }
    }
}

function doesTableExist($connection, $table_name) {
    $statement = $connection->prepare("SELECT * FROM INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA=? and table_name=?");
    $statement->execute([DB_NAME, $table_name]);
    $rows = $statement->fetchAll(PDO::FETCH_NUM);
    return count($rows) === 1;
}

function createTable($table_name) {
    $message = call_user_func("create{$table_name}Table");
    echo $message;
}

function dropTable($connection, $table) {
    try {
        foreach(getTableNames()[$table] as $subtable) {
            $connection->exec("DROP TABLE $subtable");
        }
        $connection->exec("DROP TABLE $table");
    }
    catch (PDOException $e) {
        echo "Error dropping table $table: " . $e->getMessage() . "<br>";
    }
}

function resetAllTables($connection) {
    foreach(getTableNames() as $table_name => $value) {
        resetTable($connection, $table_name);
    }
}

function resetTable($connection, $table_name) {
    dropTable($connection, $table_name);
    createTable($table_name);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Database management</title>
</head>
<body>
    <h1>Database management</h1>

    <form method="post">
        <input type="hidden" name="table_name" value="all">
        <input type="submit" value="Reset all tables">
    </form>
    <?php
        foreach(getTableNames() as $name => $values) {
            $message = "";
            if (count($values) > 0) {
                $message = "<span> The following tables will also be dropped: " . implode(", ", $values) . "</span>";
            }
            echo "<form method='post'>
                    <input type='hidden' name='table_name' value='$name'>
                    <input type='submit' value='Reset $name table'>
                    $message
                </form>";
        }
    ?>
</body>
</html>
