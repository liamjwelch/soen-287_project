<?php
require "database/universities.php";
session_start();
$universities = getAllUniversities();
$programs = getAllProgramNames();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>"North America Higher Education Database"</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/search.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://unpkg.com/leaflet@1.7.1/dist/leaflet.css' integrity='sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==' crossorigin=''/>
    <script src='https://unpkg.com/leaflet@1.7.1/dist/leaflet.js' integrity='sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==' crossorigin=''>
        var mymap =null;
    </script>
</head>
<body>
<?php
include_once "navbar.php";
?>
<article class='search-article'>
    <form class='search'>
        <input type='text' placeholder='Search the university on the map...' name='search' id='search'>
        <button class='search-button' type='button' name='searchButton' id='searchButton' onclick='addr_search()'><i class='fa fa-search icons'></i> Search</button>
    </form>
</article>
<article class='map-article'>
    <section class='map-section'>
        <div id='mapId'></div>
    </section>
</article>
<script src='js/map.js' type='text/javascript'></script>
<article class='table-article'>
    <form class='filter'>
        <input type='text' placeholder='Country' name='country' id='country'>
        <input type='text' placeholder='City' name='city' id='city'>
        <select name='degree' id='degree'>
            <?php foreach ($programs as $program) { ?>
                <option value="<?php echo $program['id']; ?>">
                    <?php echo $program['name']; ?>
                </option>
            <?php } ?>
        </select>
        <button class='filter-button' type='button' name='filterButton' onclick='filterUniversities()'>
            <i class='fa fa-sliders icons'></i> Filter
        </button>
    </form>
    <h3 id='msg'></h3>
    <table class='filter-table' id='filterTable'>
        <tr>
            <th>Logo</th>
            <th>Name of the University</th>
            <th>Country</th>
            <th>City</th>
        </tr>
        <?php foreach ($universities as $university) { ?>
            <tr>
                <td>
                    <img src="<?php echo getUniversityLogoCompleteFilename($university['id']); ?>"
                         alt="<?php echo $university['id']; ?>"
                         class="logo">
                </td>
                <td><a href="'<?php echo $university['id']; ?>' . '.php'"><?php echo $university['name']; ?></a></td>
                <td><?php echo (explode( ' , ' , $university['address']).[2]); ?></td>
                <td><?php echo (explode( ' , ' , $university['address']).[0]); ?></td>
            </tr>
        <?php } ?>
    </table>
    <script src='js/filter.js' type='text/javascript'></script>
</article>
<?php
readfile("footer.html");
?>
</body>
</html>
