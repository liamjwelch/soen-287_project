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
</head>
<body>
<?php
    include "navbar.php";
    echo "<main>$content</main>";
    readfile("footer.html");
?>
</body>
</html>
