<?php
require "database/users.php";
require "database/students.php";

session_start();
$title = "North America Higher Education Database";
$styles = ["css/homepage.css"];
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $greeting = "Welcome back, ". getUserFirstName($_SESSION["email"]) . "!";
}
else {
    $greeting = '<a href="login.php">Log in</a> or <a href="register.php">register</a> to let us find the university of your dreams!';
}

$row = getStudent($_SESSION["email"]);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title;?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php
        foreach ($styles as $stylesheet) {
            echo '<link rel="stylesheet" type="text/css" href="' . $stylesheet . '">';
        }
    ?>

    <style>
div.inline{
display:flex;
}

div.inlineText{
dispaly:inline-block;
}

div.about{
padding: 5px;
margin:5px;
}

div.card{
padding: 5px;
margin:5px;
}



/*Appropriated from
https://www.w3schools.com/howto/howto_css_profile_card.asp*/
 
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  text-align: center;
}

.title {
  color: grey;
  font-size: 18px;
}


button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background: #680F13;
  color: #FFFFFF;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}
    </style>
</head>
<?php include "navbar.php" ?>
<main>
<body>
<?php $row = getStudent($_SESSION['email']); ?>
<?php $firstAndLast = getUserFirstAndLast($_SESSION["email"]); ?>
<!-- 
Appropriated from
https://www.w3schools.com/howto/howto_css_profile_card.asp
 -->
 <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<div class='inline'>

<div class='card'>
  <img src='images/defaultIcon.jpg' alt='John' style='width:100%'>
  <h1><?php echo $firstAndLast['firstName'] ?>  <?php echo $firstAndLast['lastName'] ?></h1>
  <p class='title'><?php echo $row["program"]; ?></p>
  <a href='https://en.wikipedia.org/wiki/Albert_Einstein'><i class='fa fa-twitter'></i></a>
  <a href='https://en.wikipedia.org/wiki/Albert_Einstein'><i class='fa fa-linkedin'></i></a>
  <a href='https://en.wikipedia.org/wiki/Albert_Einstein'><i class='fa fa-facebook'></i></a>
  <p><button>Contact</button></p>
</div>

<div class='about'>
<h2>About me:</h2>
<p><?php echo $row['description']; ?></p>
<p>Here's a quote I take inspiration from: "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"</p>
<div class='inlineText'>
</div>
<h4>GPA:</h4>
<p><?php echo $row['gpa']; ?></p>
<h4>Preferences for future school:</h4>
<p>I would prefer to be in a "<?php echo $row['preferredSetting']; ?>" setting.</p>
<p>The size of student population which best suits me is: "<?php echo $row['preferredSize']; ?>" students.</p>
</div>
<div>
</body>
</main>
<?php readfile("footer.html"); ?>
</html>