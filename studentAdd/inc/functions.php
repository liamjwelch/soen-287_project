<?php
function add_task($first_name, $last_name, $phone_number, $email_address) {
    //connects to database
    include 'connection.php';

    //prepared SQL statement

    $sql = 'INSERT INTO students(first_name, last_name, phone_number, email_address) 
    VALUES (?, ?, ?, ?)';


    try {
        //passes sql statement
        $results = $db->prepare($sql);
        //binds question marks to the variables
        //ie first variable, the variable, and the variable type matching the DB
        $results->bindValue(1, $first_name, PDO::PARAM_STR);
        $results->bindValue(2, $last_name, PDO::PARAM_STR);
        $results->bindValue(3, $phone_number, PDO::PARAM_INT);
        $results->bindValue(4, $email_address, PDO::PARAM_STR);
      //  $results->bindValue(4, $major, PDO::PARAM_STR);
        $results->execute();
    } catch (PDOException $e) {
        echo "Line: " . $e->getLine() . "<BR>";
        echo "Message: " . $e->getMessage();
        return false;
    }
    return true;
}