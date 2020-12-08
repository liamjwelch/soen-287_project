<?php

require_once "database/users.php";
require_once "email.php";
require_once "functions/accountCreation.php";

session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: homepage.php");
}

$error = FALSE;
$errorPrompt = " ";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $password = trim($_POST["password"]);
    $firstName = trim(filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING));
    $lastName = trim(filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING));
    $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
    $role = trim(filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING));

    // TODO make sure no variable is empty
    // TODO validate values of some fields, make sure the same validation as in the front end is applied.

    $phone = preg_replace("/-/", "", $phone);

    try {
        if(doesUserExist($email)){
            $error = TRUE;
            $errorPrompt = "Sorry, but that email already exists in our records. Please select another email.";
        } else {
            $validationToken = generateValidationToken();
            addUser($email, $password, $role, $firstName, $lastName, $phone, $validationToken);
            $url = getEmailVerificationURL($validationToken, $email);
            sendAccountCreationEmail("$firstName $lastName", $email, $url);
            $_SESSION["email"] = $email;
            header("location: emailConfirmation.php");
            exit();
        }
    }
    catch (PDOException $e) {
        // TODO redirect to signup and display error to the user
        echo $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Create an account - AHED</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/form.css">
    <link rel="stylesheet" type="text/css" href="css/modal.css">
    <script src="js/register.js" type="text/javascript"></script>
</head>
<body>
<main class="signup-main">
    <form class="signup-form" method="post" action="" onsubmit="return validateForm()">
        <h1>Create an Account</h1>
        <fieldset>
            <legend>Account Information</legend>
            <label>
                <input type="text" name="email" placeholder="email@example.com" pattern="[\w.-]+@[\w.-]+\.[A-Za-z]{2,}"
                       title="valid email address" maxlength="50" required>
            </label>
            <label>
                <input type="password" name="password" placeholder="Password" minlength="10" maxlength="250" required>
            </label>
            <label>
                <input type="password" name="confirm" placeholder="Confirm Password" minlength="10" maxlength="250" required>
            </label>
        </fieldset>
        <fieldset>
            <legend>Personal Information</legend>
            <label>
                <input type="text" name="firstName" placeholder="First Name"
                          pattern="[A-Za-z-]+" title="only letters and hyphens" maxlength="20" required>
            </label>
            <label>
                <input type="text" name="lastName" maxlength="20" placeholder="Last Name"
                          pattern="[A-Za-z-]+" title="only letters and hyphens" required>
            </label>
            <label>
                <input type="tel" name="phone" placeholder="Phone: 123-456-7890"  pattern="\d{3}-\d{3}-\d{4}"
                          title="123-456-7890" required>
            </label>
        </fieldset>
        <label><input type="checkbox" name="tc_agreed" class="checkbox" required>I agree with the <a id="modal-button" href="#">terms and conditions</a></label>

        <div id="modal" class="modal">
            <div class="inside-modal">
                <span class="closeModal" id="close"></span>
                <p>
                    <h2>Terms & Conditions</h2> <br />
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <br />
                    Duis ultricies lacus sed turpis tincidunt id aliquet risus. Egestas sed tempus urna et. Amet cursus sit amet dictum sit. <br />
                    Vulputate odio ut enim blandit volutpat maecenas volutpat. Vitae congue mauris rhoncus aenean vel. <br />
                    Arcu ac tortor dignissim convallis. Est lorem ipsum dolor sit amet consectetur adipiscing elit pellentesque. <br />
                    Magna ac placerat vestibulum lectus. Et netus et malesuada fames ac turpis egestas integer. <br />
                    Elit duis tristique sollicitudin nibh sit amet. Sem viverra aliquet eget sit amet tellus. <br />
                    Et malesuada fames ac turpis. Penatibus et magnis dis parturient montes nascetur ridiculus. <br />
                    incidunt tortor aliquam nulla facilisi cras fermentum odio eu feugiat. Consequat ac felis donec et. <br />
                    Viverra suspendisse potenti nullam ac. Libero enim sed faucibus turpis. Eros donec ac odio tempor orci dapibus ultrices in iaculis. <br />
                    <br />
                    Sed libero enim sed faucibus turpis in eu mi bibendum. Porta nibh venenatis cras sed felis eget velit aliquet sagittis. <br />
                    gestas sed sed risus pretium quam vulputate dignissim suspendisse. Velit laoreet id donec ultrices tincidunt arcu non. <br />
                    Blandit turpis cursus in hac habitasse. Non nisi est sit amet. Nulla pharetra diam sit amet nisl. Et pharetra pharetra massa massa ultricies mi. <br />
                    Pulvinar etiam non quam lacus suspendisse. Vitae suscipit tellus mauris a diam maecenas. Feugiat nisl pretium fusce id velit ut tortor. <br />
                    Congue nisi vitae suscipit tellus mauris. Consectetur lorem donec massa sapien faucibus et molestie ac feugiat. <br />
                    Odio euismod lacinia at quis risus sed vulputate odio. Ornare aenean euismod elementum nisi. Nec ultrices dui sapien eget mi proin sed libero enim. <br />
                    Sagittis eu volutpat odio facilisis mauris. Nunc pulvinar sapien et ligula. <br />
                    <br />
                    Cursus euismod quis viverra nibh cras pulvinar mattis. Volutpat odio facilisis mauris sit amet massa vitae tortor condimentum. <br />
                    Non sodales neque sodales ut etiam sit. Varius duis at consectetur lorem donec massa sapien faucibus et. Arcu vitae elementum curabitur vitae nunc. <br />
                    Dignissim sodales ut eu sem integer vitae justo eget magna. Id porta nibh venenatis cras sed felis. <br />
                    Dignissim enim sit amet venenatis urna cursus eget nunc scelerisque. Eget mauris pharetra et ultrices neque. <br />
                    Nulla aliquet enim tortor at auctor urna. Aliquam id diam maecenas ultricies mi eget mauris pharetra et. Mi proin sed libero enim sed faucibus. <br />
                    Sit amet consectetur adipiscing elit ut aliquam purus. Egestas erat imperdiet sed euismod nisi porta lorem mollis aliquam. Sed vulputate mi sit amet mauris. Vitae semper quis lectus nulla at volutpat diam ut venenatis. <br >
                    <br />
                    Gravida cum sociis natoque penatibus et magnis dis. Nec ullamcorper sit amet risus nullam. Id porta nibh venenatis cras sed felis eget. <br />
                    ortor vitae purus faucibus ornare suspendisse. Auctor augue mauris augue neque gravida in. Libero justo laoreet sit amet cursus sit amet dictum. <br />
                    Velit aliquet sagittis id consectetur purus ut faucibus. Suspendisse in est ante in nibh. Cursus mattis molestie a iaculis at erat. <br />
                    Egestas egestas fringilla phasellus faucibus. In nulla posuere sollicitudin aliquam ultrices sagittis. Sit amet mattis vulputate enim nulla aliquet porttitor lacus. <br />
                    Mauris pellentesque pulvinar pellentesque habitant morbi tristique senectus. Tortor posuere ac ut consequat. Pretium lectus quam id leo in vitae turpis. Ut tristique et egestas quis ipsum suspendisse ultrices. <br />
                </p>
            </div>
        </div>

        <input type="hidden" name="role" value="student">
        <p id="js-validation-msg" class="error-message"></p>
        <button type="reset" class="registration-button">start over</button>
        <button type="submit" class="registration-button">Submit</button>
        <p class="error-message">
        <p class="userExists"><?php if ($error) echo $errorPrompt;?>
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

<script src="js/modal.js" type="text/javascript"></script>