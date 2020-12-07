<?php
require "database/users.php";
session_start();
$title = "North America Higher Education Database";
$styles = ["css/homepage.css"];
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $greeting = "Welcome back, ". getUserFirstName($_SESSION["email"]) . "!";
}
else {
    $greeting = '<a href="login.php">Log in</a> or <a href="register.php">register</a>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>"North America Higher Education Database"</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/homepage.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php include_once "navbar.php"; ?>
    <article class='welcome-msg'>
        <h1>AMERICAN HIGHER EDUCATION DATABASE</h1>
        <p>Every university in North America at your fingertips. What are you waiting for?</p>
        <p><?= $greeting; ?></p>
    </article>
    <!-- AUTOMATIC SLIDESHOW IMAGES -->
    <section class='slideshow'>
        <img src='images/mit.jpg' alt='MIT' class='slides_image'>
        <img src='images/harvard.jpg' alt='Harvard' class='slides_image'>
        <img src='images/stanford.jpg' alt='Stanford' class='slides_image'>
        <img src='images/mcgill.jpg' alt='McGill' class='slides_image'>
        <img src='images/concordia.jpg' alt='Concordia' class='slides_image'>
        <img src='images/toronto.jpg' alt='Toronto' class='slides_image'>
        <img src='images/harvard2.jpg' alt='Harvard' class='slides_image'>
    </section>
     <section class='centered-section highlights-section'>
        <h1>We make sure every student find the right university</h1>
        <table>
            <tr>
                <td>
                    <section class='highlight'>
                        <img src='images/users.ico' alt='User icon' class='icons'>
                        <h2>YOUR PROFILE</h2>
                        <p>Create your student profile now! Add relevant information and find personalized features.</p>
                    </section>
                </td>
                <td>
                    <section class='highlight'>
                        <img src='images/star.ico' alt='Star icon' class='icons'>
                        <h2>RECOMMENDATIONS</h2>
                        <p> Our AI-driven algorithm will help you find the perfect institution to further your education.</p>
                    </section>
                </td>
                <td>
                    <section class='highlight'>
                        <img src='images/map.ico' alt='Map icon' class='icons'>
                        <h2>NEXT TO HOME OR ABROAD?</h2>
                        <p>Our cloud-based geographical search has you covered!</p>
                    </section>
                </td>
            </tr>
        </table>
     </section>
    <section class='centered-section cards-section'>
        <h1>Testimonials from our users</h1>
        <section class='card' id='card'></section>
    </section>
    <script src='js/carousel.js' type='text/javascript'></script>
<?php readfile("footer.html"); ?>
</body>
</html>
