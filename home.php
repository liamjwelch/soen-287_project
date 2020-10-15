<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Homepage</title>
</head>
<body>

<nav>
    <?php
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $username = $_SESSION["username"];
        echo "<span>Hello $username!</span><a href='logout.php'>logout</a>";
    }
    else {
        echo "<a href='login.php'>login</a>";
    }
    ?>
</nav>

<h1>My first PHP page</h1>

</body>
</html>