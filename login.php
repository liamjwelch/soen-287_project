<?php

require "database.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    try {
        if (doCredentialsExist($username, $password)) {
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            header("location: home.php");
        }
        else {
            $_SESSION["errormsg"] = "Invalid login credentials";
        }
    }
    catch (PDOException $e) {
        $_SESSION["errormsg"] = "Error when connecting to the database: " .  $e->getMessage();
    }
    catch (Exception $e) {
        $_SESSION["errormsg"] = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login - AHED</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<main class="form">
	<form class="login-form" method="post" action="login.php">
		<input type="text" name="username" placeholder="Username"/>
		<input type="password" name="password" placeholder="Password"/>
		<button type="submit" name="login">Login</button>
		<p class="message">Not registered?
			<a href="register.php">Create an account.</a>
		</p>
		<p class="error-message">
        </p>
	</form>
</main>
</body>
</html>
