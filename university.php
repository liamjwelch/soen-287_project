<?php
require "database/universities.php";
session_start();
$university = getUniversity($_GET['id']);
$programs = $university['programs'];

// Only for testing purposes
$score = 0.5;
$gpa = floatval(3.50);
$budget = 10000;
$residence = "United States";

/*if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $student = getStudent($_SESSION["email"]);
    $gpa = $student['gpa'];
    $budget =  $student['budget'];
    $residence =  $student['country'];
}*/
// $score = ???

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>"North America Higher Education Database"</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/university.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
include_once "navbar.php";
?>
<article class="profile-background">
    <img src='<?= getUniversityImageCompleteFilename($university['id']); ?>' alt='<?= $university['id']; ?>' class='uni-image'>
</article>
<section class="profile-image">
    <img src="<?= getUniversityLogoCompleteFilename($university['id']); ?>" alt="logo" id="uniLogo">
</section>
<article class="wrapper">
    <aside class="contact-info">
        <section class="info">
            <h4>CONTACT INFORMATION</h4>
            <p class="info-title"><strong>Tlf: </strong><?= $university['phone']; ?></p>
            <p class="info-title"><strong>Email: </strong><?= $university['email']; ?></p>
            <p class="info-title"><strong>Webpage: </strong><a href="<?= $university['contactPage']; ?>"><?= $university['contactPage']; ?></a></p>
            <p class="info-title"><strong>Address:</strong><br><?= $university['address']; ?></p>
        </section>
    </aside>
    <article class="profile-main">
        <section id="title">
            <h1><?= $university['name']; ?>
                <a id="sendEmail" href="mailto:<?= $university['email']; ?>?Subject=Application"><i class="fa fa-envelope"></i> Send email</a>
            </h1>
            <p>World Ranking: <?= $university['ranking']; ?></p>
            <h4>Matching score: <?= $score ?></h4>
        </section>
        <nav class="profile-bar">
            <a class="active" href="#description" id="navDescription"><i class="fa fa-info icons"></i><p>General Info</p></a>
            <a href="#programs" id="navPrograms"><i class="fa fa-book icons"></i><p>Programs</p></a>
            <a href="#application" id="navApplication"><i class="fa fa-bell icons"></i><p>Applications</p></a>
            <a href="#financial" id="navFinancial"><i class="fa fa-money icons"></i><p>Financial Aid</p></a>
        </nav>
        <section class="profile-section" id="description">
            <p><strong>DESCRIPTION:</strong><br><?= $university['description']; ?></p>
            <p><strong>COST:</strong><br>
            <strong>Residents: </strong><?= $university['cost']['resident']; ?>$<br>
            <strong>Non-residents: </strong><?= $university['cost']['nonResident']; ?>$</p>
        </section>
        <section class="profile-section" id="programs">
            <table id="programs-table">
                <?php if(!empty($programs)) {?>
                    <tr>
                        <th>Program</th>
                        <th>Minimum GPA</th>
                    </tr>
                <?php }?>
                <?php foreach ($university['programs'] as $program) {?>
                    <tr>
                        <td><?= $program['name']; ?></td>
                        <td><?= $program['minimumGPA']; ?></td>
                    </tr>
                <?php }?>
            </table>
        </section>
        <section class="profile-section" id="application">
            <section id="deadline">
                <a href="<?= $university['contactPage']; ?>">
                    <table>
                    <tr>
                        <td>
                            <img src="images/notification.gif" alt="Notification">
                        </td>
                        <td id="deadlineData">
                            <p><strong>Deadline: </strong><?= $university['deadline']; ?></p>
                            <p><strong>Average GPA: </strong><?= $university['avgGPA']; ?></p> 
                        </td>
                    </tr>
                    </table>
                </a>
            </section>
        </section>
        <section class="profile-section" id="financial">
                <?php foreach ($university['scholarships'] as $scholarship) {?>
                    <section class="scholarship">
                        <h4><strong>Scholarship: </strong><?= $scholarship['name']; ?></h4>
                        <p name="gpa"><strong>Minimum GPA: </strong><?= $scholarship['minimumGPA']; ?></p>
                        <p><strong>Amount: </strong><?= $scholarship['amount']; ?>$</p>
                        <?php if($scholarship['financialNeed'] !== null) {?>
                            <p name="financialNeed"><strong>Financial need: </strong><?= $scholarship['financialNeed']; ?>$</p>
                        <?php } else {?>
                            <p name="financialNeed"><strong>Financial need: </strong>0$</p>
                        <?php }?>
                    </section>
                <?php } ?>
                <button type="button" name="eligibility" value="Eligibility" onclick="checkEligibility()"><i class="fa fa-check"></i> Check eligibility</button>
        </section>
    </article>
</article>
<script>
    // Display scholarships depending on user's eligibility
    function checkEligibility() {
        const scholarships = document.getElementsByClassName('scholarship');
        for (let i = 0; i < scholarships.length; i++) {
            scholarships.item(i).style.display = "";

            // Get the values of the scholarship
            let gpa = scholarships.item(i).getElementsByTagName('p').namedItem('gpa').innerText.replace('Minimum GPA: ', "");
            if(gpa !== null) {
                gpa = gpa.replace('Minimum GPA: ', "");
            }
            let financialNeed = scholarships[i].getElementsByTagName('p').namedItem('financialNeed').innerText.replace('Financial need: ', "");
            if(financialNeed !== null) {
                financialNeed = financialNeed.replace('Financial need: ', "");
            }

            // Validate if the student meets the requirements
            if (gpa !== null && parseFloat(gpa) < <?=$gpa; ?>) {
                scholarships.item(i).style.display = "none";
            } else if(financialNeed !== null && parseInt(financialNeed.slice(0, -1)) > <?=$budget; ?>) {
                scholarships.item(i).style.display = "none";
            }
        }
    }
</script>
<script src="js/profile.js" type="text/javascript"></script>
<?php
readfile("footer.html");
?>
</body>
</html>