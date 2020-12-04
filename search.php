<?php
require "database/universities.php";
session_start();
$universities = getAllUniversities();
try {
    $programs = getAllProgramNames();
} catch (Exception $e){
    $programs = null;
}

$states = [];
$cities = [];
$countries = [];
foreach ($universities as $university) {
    // Create an array with the cities
    $auxCity = explode(', ', $university['location'])[0];
    $foundCity = false;
    foreach ($cities as $city) {
        if ($city === $auxCity) $foundCity = true;
    }
    if(!$foundCity) array_push($cities, $auxCity);

    // Create an array with the states
    $auxState = explode(', ', $university['location'])[1];
    $foundState = false;
    foreach ($states as $state) {
        if ($state === $auxState) $foundState = true;
    }
    if(!$foundState) array_push($states, $auxState);

    // Create an array with the countries
    $auxCountry = explode(', ', $university['location'])[2];
    $foundCountry = false;
    foreach ($countries as $country) {
        if ($country === $auxCountry) $foundCountry = true;
    }
    if(!$foundCountry) array_push($countries, $auxCountry);
}

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
        <select name='country' id='country'>
            <option value="" selected disabled hidden>Select a country</option>
            <?php foreach ($countries as $country) { ?>
                <option value="<?php echo $country ?>">
                    <?php echo $country; ?>
                </option>
            <?php } ?>
        </select>
        <select name='state' id='state'>
            <option value="" selected disabled hidden>Select a state</option>
            <?php foreach ($states as $state) { ?>
                <option value="<?php echo $state ?>">
                    <?php echo $state; ?>
                </option>
            <?php } ?>
        </select>
        <select name='city' id='city'>
            <option value="" selected disabled hidden>Select a city</option>
            <?php foreach ($cities as $city) { ?>
                <option value="<?php echo $city ?>">
                    <?php echo $city; ?>
                </option>
            <?php } ?>
        </select>
        <select name='program' id='program'>
            <option value="" selected disabled hidden>Select a program</option>
            <?php foreach ($programs as $program) { ?>
                <option value="<?php echo $program ?>">
                    <?php echo $program; ?>
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
            <th>State/Province</th>
            <th>City</th>
        </tr>
        <?php foreach ($universities as $university) { ?>
            <tr>
                <td>
                    <img src="<?php echo getUniversityLogoCompleteFilename($university['id']); ?>"
                         alt="<?php echo $university['id']; ?>"
                         class="logo">
                </td>
                <td hidden><?php echo $university['id']; ?></td>
                <td><a href="<?php echo getUniversityProfile($university['id']);?>">
                        <?php echo $university['name']; ?></a>
                </td>
                <td><?php echo explode(', ', $university['location'])[2]; ?></td>
                <td><?php echo explode(', ', $university['location'])[1]; ?></td>
                <td><?php echo explode(', ', $university['location'])[0]; ?></td>
                </td>
            </tr>
        <?php } ?>
    </table>
    <script src="js/filter.js" type="text/javascript"></script>
</article>
<?php
readfile("footer.html");
?>
</body>
</html>
