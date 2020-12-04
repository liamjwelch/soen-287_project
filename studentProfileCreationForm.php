<?php

require_once "database/users.php";
require_once "database/universities.php";
require_once "database/students.php";

    session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // TODO validate the fields for student profile
    if (isset($_POST["token"]) && strlen($_POST["token"]) === 50 && isset($_POST["email"]) && !empty($_POST["email"])) {
        try {
            createStudent($_POST["email"], $_POST["token"], $_POST["address"], $_POST["program"], $_POST["gpa"],
                          $_POST["preferredSetting"], $_POST["maxDistance"], $_POST["preferredSize"],
                          $_POST["preferredRanking"], $_POST["householdIncome"], $_POST["budget"],
                          $_POST["description"]);
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["loggedin"] = true;
            header("location: homepage.php");
            exit();
        }
        catch (Exception $e) {
            echo $e->getMessage() . "<br>"; // TODO improve that
        }
    }
    else {
        // TODO handle that case
    }
}
else if(isset($_GET["token"]) && strlen($_GET["token"]) === 50 && isset($_GET["email"]) && !empty($_GET["email"])) {
    $email = urldecode($_GET["email"]);
    if (!isTokenValid($email, $_GET["token"])) {
        header("location: tokenInvalid.php");
        exit();
    }
}
else {
    // if there isn't a valid token and email in the URL, the user probably got here by mistake, just redirect to homepage
    header("location: homepage.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dummy new student form</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<main class="form">
    <h1>Dummy new student form</h1>
    <h2>(I should not be here on dec 7)</h2>
    <p><?php echo getUserFirstName($email) . ", finish setting up your profile"; ?></p>
    <form method="post">
        <label>Address<input name="address" value="123, 1st avenue, Montreal, Qc, Canada" required></label>
        <label>Program<select name="program">
                <option value="placeholder">Please select your desired program</option>
                <?php
                foreach(getAllProgramNames() as $program) {
                    echo "<option value='$program'>$program</option>";
                }
                ?>
        </label>
        <label>GPA<input name="gpa" value="3.4" required></label>
        <label>Preferred setting<input name="preferredSetting" value="rural" required></label>
        <label>Max distance<input name="maxDistance" value="200" required></label>
        <label>Preferred university size<input name="preferredSize" value="2000-5000" required></label>
        <label>Preferred university ranking<input name="preferredRanking" value="50" required></label>
        <label>household income<input name="householdIncome" value="60000" required></label>
        <label>Your budget per semester<input name="budget" value="20000" required></label>
        <textarea name="description">Describe yourself in a few words</textarea>
        <input type="hidden" name="token" value="<?= $_GET["token"] ?>">
        <input type="hidden" name="email" value="<?= $email ?>">
        <button type="submit">Submit</button>
    </form>
</main>;
</body>
</html>
