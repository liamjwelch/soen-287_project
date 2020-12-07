<?php

session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: homepage.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login - AHED</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/form.css">
</head>
<body>
<main class="login-main">
	<form class="login-form" method="post" action="validate_login.php">
		<input type="text" name="email" class="login-input" placeholder="Email Address"/>
		<input type="password" name="password" class="login-input" placeholder="Password"/>
		<button type="submit" name="login" class="login-button">Login</button>
        <p class="error-message">
            <?php
                if (isset($_SESSION["errormsg"])) {
                    echo $_SESSION["errormsg"];
                    unset($_SESSION["errormsg"]);
                }
            ?>
        </p>
		<p class="message">Not registered?
			<a href="register.php">Create an account.</a>
		</p>
	</form>
</main>
</body>
</html>
