<?php
require "database/users.php";

session_start();
$title = "North America Higher Education Database";
$styles = ["css/studentProfile.css"];
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $greeting = "Welcome back, ". getUserFirstName($_SESSION["email"]) . "!";
}
else {
    $greeting = '<a href="login.php">Log in</a> or <a href="signup.php">sign up</a> to let us find the university of your dreams!';
}

  if(isset($_POST['formSubmit']) ) {
      header("Location: somewhereElse.php");

  }
  
$content = "

<body>

<!-- 
Appropriated from
https://www.w3schools.com/howto/howto_css_profile_card.asp
 -->
 <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<div class='inline'>
<div class='card'>
  <img src='images/albertE.jpg' alt='John' style='width:100%'>
  <h1>Albert Einstein</h1>
  <p class='title'>Physics Major</p>
  <a href='https://en.wikipedia.org/wiki/Albert_Einstein'><i class='fa fa-twitter'></i></a>
  <a href='https://en.wikipedia.org/wiki/Albert_Einstein'><i class='fa fa-linkedin'></i></a>
  <a href='https://en.wikipedia.org/wiki/Albert_Einstein'><i class='fa fa-facebook'></i></a>
  <p><button>Contact</button></p>
</div>

<div class='about'>
<h2>About me:</h2>
<p><?php echo $studentDescription; ?></p>
<div class='inlineText'>
<h4>Intended Major:</h4>
<p><?php echo $major; ?></p>
</div>
<h4>GPA:</h4>
<p><?php echo $GPA; ?></p>
<h4>Preferences for future school:</h4>
<p><?php echo $preferredSetting; ?></p>
<p><?php echo $preferredRanking; ?></p>
<p><?php echo $preferredSize; ?></p>

</div>

<div>


</body>
";

include "template.php";