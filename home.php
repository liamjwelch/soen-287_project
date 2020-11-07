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
    if (isset($_SESSION["errormsg"])) {
        echo "<strong style='color: red;'>" . $_SESSION["errormsg"] . "</strong>";
        unset($_SESSION["errormsg"]);
    }

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $username = $_SESSION["username"];
        echo "<span>Hello $username!</span><a href='logout.php'>logout</a>";
    }
    else {
        echo "<form action='login.php' method='post'>
                   <input type='text' name='username' placeholder='username'>
                   <input type='password' name='password' placeholder='password'>
                   <input type='submit' value='login'>
              </form>";
    }
    ?>
</nav>

<h1>My first PHP page</h1>

</body>
</html>