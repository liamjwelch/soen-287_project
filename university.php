<?php
session_start();
$title = "North America Higher Education Database";
$styles = ["css/university.css"];

$content = "

    <article class='centered-article cards'>
        <section class='university-card'>
           <img src='images/harvard.jpg' alt='Harvard' class='slides_image'>
           <h2>UNIVERSITY NAME</h2>
           <p>Display of basic information of this university.</p>
           <p>We know everything about every university!</p>
        </section>
    </article>
";

include "template.php";
