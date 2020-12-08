<nav class="page-bar">
    <img class="logo" src="images/logo.png" alt="Logo">
    <?php
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            echo '<a href="logout.php" class="page"><i class="fa fa-fw fa-sign-out fa-lg icons"></i> Log out</a>
                <a href="profile.php" class="page"><i class="fa fa-fw fa-user fa-lg icons"></i> Profile</a>';
        }
        else {
            echo '<a href="login.php" class="page"><i class="fa fa-fw fa-sign-in fa-lg icons"></i> Log in</a>';
        }
    ?>
    <a href="search.php" class="page"><i class="fa fa-fw fa-search fa-lg icons"></i> Search</a>
    <a href="recommendations.php" class="page"><i class="fa fa-fw fa-graduation-cap fa-lg icons"></i> Recommendations</a>
    <a href="homepage.php" class="page"><i class="fa fa-fw fa-home fa-lg icons"></i> Home</a>
</nav>
<script src='js/navbar.js' type='text/javascript'></script>