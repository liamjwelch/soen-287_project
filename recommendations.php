<?php
require_once "database/universities.php";
require_once "database/students.php";
require_once "match.php";

session_start();

function getRecommendations() {
    $universities = getAllUniversities();
    $student = getStudent($_SESSION["email"]);
    if (is_null($student)) {
        return [];
    }
    foreach($universities as &$university) {
        $university["score"] = getMatchingScore($student, $university);
    }
    usort($universities, function ($uni1, $uni2) {  // sort universities by score in decreasing order (highest first)
        return $uni2["score"] <=> $uni1["score"];
    });
    return $universities;
}

$recommendations = [];

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    foreach(getRecommendations() as $recommendation) {
        if ($recommendation["score"] > 0) {
            $recommendations[] = $recommendation;
        }
    }
}
else {
    header("location: login.php");
    exit();
}

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
    <?php
    if (count($recommendations) > 0) {
        foreach ($recommendations as $recommendation) {
        ?>
        <section class='university-card' onclick="window.location='university.php?id=<?= $recommendation['id']; ?>'">
            <section class="uni-logo">
                <img src='<?= getUniversityLogoCompleteFilename($recommendation['id'])?>'
                     alt='<?= $recommendation['id']; ?>'>
            </section>
            <section class="uni-info">
                <h2><?= $recommendation['name']; ?></h2>
                <h4>Matching score: <?= $recommendation["score"]; ?></h4>
                <p><?= $recommendation['description']; ?></p>
            </section>
        </section>
    <?php
        }
    }
    else {
        echo "<section class='university-card'>
                <section class='uni-logo' style='background-color: #680F13'>
                    <img src='images/logo.png' alt='AHED LOGO'>
                </section>
                <section class='uni-info'>
                    <h2>Sorry, no match found</h2>
                    <p>Modify your profile and try again.</p>
                </section>
            </section>";
    }
    ?>
</main>
<?php
readfile("footer.html");
?>
</body>
</html>
