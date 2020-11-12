<?php
require 'database.php';
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $student = getUserProfile($_SESSION["username"]);
}
else {
    header("location: login.php");
    return;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $student["first_name"] . " " . $student["last_name"] . "'s profile";?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        td {
            color: #680F13;
            padding: 15px;
            font-size: 14pt;
        }
        table {
            border-collapse: collapse;
            width: 40%;
            border: 3px solid black;
            padding: 8px;
            margin: 50px;
            background-color: white;
        }
        h1 {
            margin: 50px;
            color: #680F13;
        }
        th {
            color: #680F13;
            padding: 15px;
            font-size: 14pt;
            text-align: left;
        }
        button {
            text-transform: uppercase;
            background: #680F13;
            width: 150px;
            border: 0;
            padding: 15px;
            color: #FFFFFF;
            font-size: 14px;
            cursor: pointer;
            margin: 10px 20px 50px 50px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>
    <main>
        <h1>Hello, <?php echo $student["first_name"] . " " . $student["last_name"] ?>!</h1>
        <table>
            <thead><tr><th>Your profile</th></tr></thead>
            <?php
                foreach ($student as $key => $value) {
                    echo "<tr><td>$key</td><td>$value</td></tr>";
                }
            ?>
        </table>
        <form method="POST" action="logout.php">
            <button type="submit">Log Out</button>
        </form>
    </main>
    <?php readfile("footer.html");?>
</body>
</html>
