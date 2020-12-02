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
	<title>Create an account - AHED</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/signup.css">
    <script src="js/signup.js" type="text/javascript"></script>
</head>
<body>
<main class="form" onsubmit="return validateForm()">
    <h1>Create an Account</h1>
	<form class="signup-form" method="post" action="create_user.php">
        <fieldset>
            <legend>Account Information</legend>
            <label>Your Email Address:
                <input type="text" name="email" placeholder="me@example.com" pattern="[\w.-]+@[\w.-]+\.[A-Za-z]{2,}"
                       title="valid email address" maxlength="50" required>
            </label>
            <label>Your Password:
                <input type="password" name="password" placeholder="Password" minlength="10" maxlength="250" required>
            </label>
        </fieldset>
        <fieldset>
            <legend>Personal Information</legend>
            <label>First Name:<input type="text" name="first_name" pattern="[A-Za-z-]+" title="only letters and hyphens" max="20"
                                     required>
            </label>
            <label>Last Name:<input type="text" name="last_name" max="20" pattern="[A-Za-z-]+" title="only letters and hyphens"
                                    required></label>
            <label>Phone Number:<input type="tel" name="phone" placeholder="123-456-7890"  pattern="\d{3}-\d{3}-\d{4}"
                                       title="123-456-7890" required></label>
        </fieldset>
        <label><input type="checkbox" name="tc_agreed" class="checkbox" required>I agree with the <a href="terms.php">terms and conditions</a></label>
        <input type="hidden" name="role" value="student">
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