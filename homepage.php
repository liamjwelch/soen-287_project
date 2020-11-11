<?php
session_start();
$title = "North America Higher Education Database";
$styles = ["css/homepage.css"];
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $greeting = "Welcome back, ". $_SESSION["username"] . "!";
}
else {
    $greeting = '<a href="login.php">Log in</a> or <a href="signup.php">sign up</a> to let us find the university of your dream';
}
$content = "
    
    <section class='welcome-msg'>
        <p>$greeting</p>
    </section>
    
    <!-- AUTOMATIC SLIDESHOW IMAGES -->
    <article class='slideshow'>
        <img src='images/mit.jpg' alt='MIT' class='slides_image'>
        <img src='images/harvard.jpg' alt='Harvard' class='slides_image'>
        <img src='images/stanford.jpg' alt='Stanford' class='slides_image'>
        <img src='images/mcgill.jpg' alt='McGill' class='slides_image'>
        <img src='images/concordia.jpg' alt='Concordia' class='slides_image'>
        <img src='images/toronto.jpg' alt='Toronto' class='slides_image'>
    </article>
    
    <section class='page-sec sec1'>
        <h1>AMERICAN HIGHER EDUCATION DATABASE</h1>
        <p>OUR INFO OUR INFO OUR INFO OUR INFO</p>
        <p>OUR INFO OUR INFO OUR INFO OUR INFO</p>
        <p>OUR INFO OUR INFO OUR INFO OUR INFO</p>
        <p>OUR INFO OUR INFO OUR INFO OUR INFO</p>
    </section>
    
     <section class='page-sec sec2'>
        <h1>We are the Tinder of prospective students!</h1>
        <article class='services'>
            <section>
                <img src='images/users.ico' class='icons'>
                <h2>YOUR PROFILE</h2>
                <p>Create YOUR profile with</p>
            </section>
             <section>
                <img src='images/star.ico' class='icons'>
                <h2>YOUR RECOMMENDATIONS</h2>
                <p>Our AI-driven algorithm will match YOU with the university of YOUR dreams</p>
            </section>
            <section>
                <img src='images/map.ico' class='icons'>
                <h2>NEXT TO HOME OR ABROAD?</h2>
                <p>Our cloud-based geographical search has you covered!</p>
            </section>
        </article>
     </section>
     
    <section class='page-sec sec3'>
        <div class='card'>
            <h2>INFORMATION</h2>
            <p>We could place information in cards</p>
            <p>They are a nice way to display information</p>
        </div>
        <div class='card'>
            <h2>INFORMATION</h2>
            <p>We could place information in cards</p>
            <p>They are a nice way to display information</p>
        </div>
    </section>
	
	<script src='js/carousel.js' type='text/javascript'></script>
";

include "template.php";