<?php

session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: home.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Create an account - AHED</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/signup.css">
</head>
<body>
<main class="form">
    <h1>Create an Account</h1>
	<form class="signup-form" method="post" action="create_user.php">
        <fieldset>
            <legend>Account Information</legend>
            <label>Your Email Address:<input type="text" name="username" placeholder="me@example.com"/></label>
            <label>Your Password:<input type="password" name="password" placeholder="Password"/></label>
        </fieldset>
        <fieldset>
            <legend>Personal Information</legend>
            <label>First Name:<input type="text" name="first_name"></label>
            <label>Last Name:<input type="text" name="last_name"></label>
            <label>Phone Number:<input type="tel" name="telephone"></label>
            <label>Home Address:<input type="text" name="address"></label>
        </fieldset>
        <fieldset>
            <legend>Academic Information</legend>
            <label>What do you want to study?
                <select name="programs" id="programs"><option value="computer_science">Computer Science</option></select>
            </label>
            <label>What is your GPA?<input type="number" min="0" max="4.3"></label>
        </fieldset>
        <label><input type="checkbox" name="tc_agreed" class="checkbox">I agree with the <a href="terms.php">terms and conditions</a></label>
        <p id="js-validation-msg" class="error-message"></p>
        <button type="reset">start over</button>
		<button type="submit">Submit</button>
        <p class="error-message">
            <?php
            if (isset($_SESSION["errormsg"])) {
                echo $_SESSION["errormsg"];
                unset($_SESSION["errormsg"]);
            }
            ?>
        </p>
		<p class="message">Already a user?
			<a href="login.php">Login</a>
		</p>
	</form>
</main>
</body>
</html>
