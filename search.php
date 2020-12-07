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
<script>
    // Initialize Map
    <?php foreach ($universities as $university) {?>
        createMarkers("<?= $university['address']; ?>", "<?= $university['id']; ?>", "<?= $university['name']; ?>");
    <?php } ?>

    // Create marker with link to university profile
    function createMarkers(address, id, name) {
        var xmlhttp = new XMLHttpRequest();
        const url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + address;

        xmlhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                var coordinates = JSON.parse(xmlhttp.responseText);
                const uni = L.latLng([coordinates[0].lat, coordinates[0].lon]);
                const link = "<a href='university.php?id=" + id + "'>" + name + "</a>";
                L.marker(uni).addTo(map).bindPopup(link);
            }
        };
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }
</script>
<article class='table-article'>
    <form class='filter'>
        <select name='country' id='country'>
            <option value="" selected>Select a country</option>
            <?php foreach ($countries as $country) { ?>
                <option value="<?= $country ?>">
                    <?= $country; ?>
                </option>
            <?php } ?>
        </select>
        <select name='state' id='state'>
            <option value="" selected>Select a state</option>
            <?php foreach ($states as $state) { ?>
                <option value="<?= $state ?>">
                    <?= $state; ?>
                </option>
            <?php } ?>
        </select>
        <select name='city' id='city'>
            <option value="" selected>Select a city</option>
            <?php foreach ($cities as $city) { ?>
                <option value="<?= $city ?>">
                    <?= $city; ?>
                </option>
            <?php } ?>
        </select>
        <select name='program' id='program'>
            <option value="" selected>Select a program</option>
            <?php foreach ($programs as $program) { ?>
                <option value="<?= $program ?>">
                    <?= $program; ?>
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
            <th>State</th>
            <th>City</th>
            <th>Programs</th>
        </tr>
        <?php foreach ($universities as $university) { ?>
            <tr onclick="window.location='university.php?id=<?= $university['id']; ?>'">
                <td><img src="<?= getUniversityLogoCompleteFilename($university['id']); ?>"
                         alt="<?= $university['id']; ?>" class="logo uniLogo">
                </td>
                <td hidden><?= $university['id']; ?></td>
                <td class="uniName"><?= $university['name']; ?></td>
                <td><?= explode(', ', $university['location'])[2]; ?></td>
                <td><?= explode(', ', $university['location'])[1]; ?></td>
                <td><?= explode(', ', $university['location'])[0]; ?></td>
                <td class="uniPrograms">
                    <ul>
                        <?php foreach ($university['programs'] as $program) {?>
                            <li><?= $program['name']; ?></li>
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
