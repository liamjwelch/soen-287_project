<?php
require "database/students.php";
session_start();
$student = null;
$firstAndLast = null;
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $student = getStudent($_SESSION["email"]);
    $firstAndLast = getUserFirstAndLast($_SESSION["email"]);
}
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>"North America Higher Education Database"</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/university.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
include_once "navbar.php";
?>
<article class="profile-background">
    <img src='images/login-background.jpg' alt='Background image' class='uni-image'>
</article>
<section class="profile-image">
    <img src="images/student.png" alt="logo" id="uniLogo">
</section>
<article class="wrapper">
    <aside class="contact-info">
        <section class="info">
            <h4>CONTACT INFORMATION</h4>
            <p class="info-title"><strong>Email: </strong><?= $student['email']; ?></p>
            <p class="info-title"><strong>Degree: </strong><?= $student['program']; ?></p>
            <p class="info-title"><strong>Residence: </strong><?= $student['city'] . ", " . $student['country']; ?></p>
        </section>
    </aside>
    <article class="profile-main">
        <section id="title">
            <h1><?= $firstAndLast['firstName'] . " " . $firstAndLast['lastName']; ?></h1>
            <p>Student</p>
        </section>
        <nav class="profile-bar">
            <a class="active" href="#description" id="navDescription"><i class="fa fa-info icons"></i><p>About me</p></a>
            <a href="#preferences" id="navPreferences"><i class="fa fa-wrench icons"></i><p>Preferences</p></a>
            <a href="#financial" id="navFinancial"><i class="fa fa-money icons"></i><p>Financial information</p></a>
        </nav>
        <section class="profile-section" id="description">
            <p><strong><?= $student['description']; ?></strong></p>
            <p><strong>GPA: </strong><?= $student['gpa']; ?></p>
        </section>
        <section class="profile-section" id="preferences">
            <p><strong>MY UNIVERSITY PREFERENCES:</strong></p>
            <p><strong>Preferred settings: </strong><?= $student['preferredSetting']; ?></p>
            <p><strong>Preferred size: </strong><?= $student['preferredSize']; ?></p>
            <p><strong>Preferred ranking: </strong><?= $student['preferredRanking']; ?></p>
        </section>
        <section class="profile-section" id="financial">
            <p><strong>Household income: </strong><?= $student['householdIncome']; ?></p>
            <p><strong>Budget: </strong><?= $student['budget']; ?></p>
        </section>
    </article>
</article>
<script src="js/student.js" type="text/javascript"></script>
<?php
readfile("footer.html");
?>
</body>
</html>
