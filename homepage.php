<?php
require "database/users.php";

session_start();
$title = "North America Higher Education Database";
$styles = ["css/homepage.css"];
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $greeting = "Welcome back, ". getUserFirstName($_SESSION["email"]) . "!";
}
else {
    $greeting = '<a href="login.php">Log in</a> or <a href="register.php">register</a> to let us find the university of your dreams!';
}
$content = "
    
    <section class='welcome-msg'>
        <h1>AMERICAN HIGHER EDUCATION DATABASE</h1>
        <p>North-american students trust us to find the perfect university for them since 1794!</p>
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
        <img src='images/harvard2.jpg' alt='Harvard' class='slides_image'>
    </article>
    
     <article class='centered-article highlights-article'>
        <h1>We are the Tinder of prospective students!</h1>
        <section class='highlight'>
            <img src='images/users.ico' class='icons'>
            <h2>YOUR PROFILE</h2>
            <p>Create YOUR personalized profile!</p>
        </section>
         <section class='highlight'>
            <img src='images/star.ico' class='icons'>
            <h2>RECOMMENDATIONS</h2>
            <p>Our AI-driven algorithm will match YOU with the university of YOUR dreams.</p>
        </section>
        <section class='highlight'>
            <img src='images/map.ico' class='icons'>
            <h2>NEXT TO HOME OR ABROAD?</h2>
            <p>Our cloud-based geographical search has you covered!</p>
        </section>
     </article>
 
     <article class='centered-article bragging'>
        <h1>AMERICAN HIGHER EDUCATION DATABASE</h1>
        <p>North-american students trust us to find the perfect university for them since 1794!</p>
    </article>
     
    <article class='centered-article cards'>
        <section class='card'>
            <h2>STOP WASTING TIME</h2>
            <p>Don't spend your precious time researching about 15 universities.</p>
            <p>We know everything about every university!</p>
        </section>
        <section class='card'>
            <h2>NO NEED TO TAKE HARD DECISION</h2>
            <p>Our AI will make the right decision for YOUR future.</p>
            <p>All you need to do is fill up your profile with your preferences.</p>
        </section>
    </article>
	
	<script src='js/carousel.js' type='text/javascript'></script>
";

include "template.php";
