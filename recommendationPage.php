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

<script src='recommendationBar.js'></script> 
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>

<div id='myProgress'>
  <div id='congratulations'><h1>CONGRATULATIONS...</h1></div>
  <div id='congratulationsII'><h2>you matched with...</h2></div>

  <div id='afterBarCompletion'>
  <h2>Click the button below to initiate a search using our AI driven 
    <b><i>Match Me&#169;</i></b> algorithm.</h2> <h4>What are you waiting for? 
      <br>
      <br>Your future awaits...</h4>
  <button id='matchButton' onclick='move();'>Match Me!</button>
  <br>
  <br>
  <div id='progressBar'>
  <div id='myBarOutline'><div id='myBar'>0%</div></div>
  <div><b><span id='infoPrintOut'></span></b></div>
  <br>
  </div>
</div>
  
</div>
<img src='images/Concordia-logo.jpeg' alt='Concordia Logo' id='hiddenLogo'>


";

include "template.php";