<?php

//TESTING COMMIT FROM PHPSTORM
// Configure this to your own server database settings
$host = "localhost";
$user = "liamw";
$dbname = "soen287";
$pass = "password";


/*PDO (PHP Data Object) is a built in mechanism for connecting to a database, known as a PDO
contains many methods for working with different kinds of databases

*/
try {
    // PDO Object, db instantiates the properties of the PDO class
    $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    //PDO ATTRIBUTE ERRORMODE,followed by the value we want to set (this tells PDO that all
    // errors should be handled as an exception)
    //set attribute is a method called on db PDO
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch (PDOException $e) {
    echo "Line: " . $e->getLine() . "<BR>";
    echo "Message: " . $e->getMessage();
    exit();
}