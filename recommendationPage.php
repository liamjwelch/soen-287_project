<?php
session_start();
$title = "North America Higher Education Database";
$styles = ["css/recommendationStyle.css"];
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $greeting = "Welcome back, ". $_SESSION["username"] . "!";
}
else {
    $greeting = '<a href="login.php">Log in</a> or <a href="signup.php">sign up</a> to let us find the university of your dreams!';
}
$content = "

<script src='js/recommendationBar.js' type='text/javascript'></script> 
  
<div id='myProgress'>
  <h1>Your journey to <i>Higher</i> Education begins here...</h1>
  <h5>Click the button below to initiate a search using our AI driven 
    <b><i>Match Me&#169;</i></b> algorithm. What are you waiting for? Your future awaits.</h5>
  <div id='myBarOutline'><div id='myBar'>0%</div></div>
  <div><b><span id='infoPrintOut'></span></b></div>
  <br>
  <button id='matchButton' onclick='move()>Match Me!</button>
  <h1 id='congratulations'></h1>
</div>


";

include "template.php";