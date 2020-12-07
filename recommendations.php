<?php
require "database/universities.php";
session_start();
// This must be changed by the recommendation function
$recommendations = getAllUniversities();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>"North America Higher Education Database"</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/recommendations.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
include_once "navbar.php";
?>

<main>
    <?php foreach ($recommendations as $recommendation) {?>
        <section class='university-card' onclick="window.location='university.php?id=<?= $recommendation['id']; ?>'">
            <section class="uni-logo">
                <img src='<?= getUniversityLogoCompleteFilename($recommendation['id'])?>'
                     alt='<?= $recommendation['id']; ?>'>
            </section>
            <section class="uni-info">
                <h2><?= $recommendation['name']; ?></h2>
                <h4>Matching score: X</h4>
                <p><?= $recommendation['description']; ?></p>
            </section>
        </section>
    <?php }?>
</main>
<?php
readfile("footer.html");
?>
</body>
</html>
