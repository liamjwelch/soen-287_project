<?php
require "database/universities.php";
session_start();
$university = getUniversity('harvard');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>"North America Higher Education Database"</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/university.css">
</head>
<body>
<?php
include_once "navbar.php";
?>
<article class="profile-background">
    <img src='<?= getUniversityImageCompleteFilename($university['id']); ?>' alt='<?= $university['id']; ?>' class='uni-image'>
</article>
<article class="wrapper">
    <aside class="contact-info">
        <section class="profile-image">
            <img src="<?= getUniversityLogoCompleteFilename($university['id']); ?>" alt="logo" id="uniLogo">
        </section>
        <section class="info">
            <h4>CONTACT INFORMATION</h4>
            <p class="info-title">Tlf:</p>
            <p><?= $university['phone']; ?></p>
            <p class="info-title">Email:</p>
            <p><?= $university['email']; ?></p>
            <p class="info-title">Webpage:</p>
            <p><a href="<?= $university['contactPage']; ?>"><?= $university['contactPage']; ?></a></p>
            <p class="info-title">Address:</p>
            <p><?= $university['address']; ?></p>
        </section>
    </aside>
    <article class="profile-main">

    </article>
</article>
<?php
readfile("footer.html");
?>
</body>
</html>