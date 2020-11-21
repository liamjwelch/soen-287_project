<?php
session_start();
$title = "North America Higher Education Database";
$styles = ["css/university.css"];

$content = "

    <article class='centered-article cards'>
        <section class='university-card'>
            <h2>UNIVERSITY PROFILE</h2>
           <img src='images/harvard.jpg' alt='Harvard' class='slides_image'>
           <p>Display of basic information of this university.</p>
           <p>We know everything about every university!</p>
        </section>
    </article>
";

include "template.php";
