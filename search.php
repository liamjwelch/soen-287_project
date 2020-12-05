<?php
require "database/universities.php";
session_start();
$universities = getAllUniversities();
try {
    $programs = getAllProgramNames();
    sort($programs, SORT_DESC);
} catch (Exception $e){
    $programs = null;
}

$states = [];
$cities = [];
$countries = [];
$locationParts = [];
foreach ($universities as $university) {
    $locationParts = explode(', ', $university['location']);
    // Create an array with the cities
    array_push($cities, $locationParts[0]);
    // Create an array with the states
    array_push($states, $locationParts[1]);
    // Create an array with the countries
    array_push($countries, $locationParts[2]);
}
// Remove duplicates from the arrays
$cities = array_unique($cities);
$states = array_unique($states);
$countries = array_unique($countries);

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
        let map =null;
    </script>
</head>
<body>
<?php
include_once "navbar.php";
?>
<article class='search-article'>
    <form class='search'>
        <input type='text' placeholder='Search the university on the map...' name='search' id='search'>
        <button class='search-button' type='button' name='searchButton' id='searchButton' onclick='addrSearch()'><i class='fa fa-search icons'></i> Search</button>
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
            <option value="" selected>Select a country</option>
            <?php foreach ($countries as $country) { ?>
                <option value="<?php echo $country ?>">
                    <?php echo $country; ?>
                </option>
            <?php } ?>
        </select>
        <select name='state' id='state'>
            <option value="" selected>Select a state</option>
            <?php foreach ($states as $state) { ?>
                <option value="<?php echo $state ?>">
                    <?php echo $state; ?>
                </option>
            <?php } ?>
        </select>
        <select name='city' id='city'>
            <option value="" selected>Select a city</option>
            <?php foreach ($cities as $city) { ?>
                <option value="<?php echo $city ?>">
                    <?php echo $city; ?>
                </option>
            <?php } ?>
        </select>
        <select name='program' id='program'>
            <option value="" selected>Select a program</option>
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
    <table class='filter-table' id='filterTable'>
        <tr>
            <th>Logo</th>
            <th>Name of the University</th>
            <th>Country</th>
            <th>State</th>
            <th>City</th>
            <th>Programs</th>
        </tr>
        <?php foreach ($universities as $university) { ?>
            <tr onclick="window.location='university.php'">
                <td><img src="<?php echo getUniversityLogoCompleteFilename($university['id']); ?>"
                         alt="<?php echo $university['id']; ?>" class="logo" id="uniLogo">
                </td>
                <td hidden><?php echo $university['id']; ?></td>
                <td id="uniName"><?php echo $university['name']; ?></td>
                <td><?php echo explode(', ', $university['location'])[2]; ?></td>
                <td><?php echo explode(', ', $university['location'])[1]; ?></td>
                <td><?php echo explode(', ', $university['location'])[0]; ?></td>
                <td id="uniPrograms">
                    <ul>
                        <?php foreach ($university['programs'] as $program) {?>
                            <li><?php echo $program['name']; ?></li>
                        <?php }?>
                    </ul>
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
