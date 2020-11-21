<?php
session_start();
$title = "North America Higher Education Database";
$styles = ["css/map.css"];

$headerContent = "<link rel='stylesheet' href='https://unpkg.com/leaflet@1.7.1/dist/leaflet.css' integrity='sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==' crossorigin=''/>
	<script src='https://unpkg.com/leaflet@1.7.1/dist/leaflet.js' integrity='sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==' crossorigin=''>
		var mymap =null;
	</script>
";

$content = "
    
    <article class='search-article'>
        <form action class='search'>
            <input type='text' placeholder='University name' name='search' id='search'>
            <button class='search-button' type='button' name='searchButton' onclick='addr_search()'><i class='fa fa-search icons'></i> Search</button>
        </form>
    </article>
    <article class='map-article'>
        <section class='map-section'>
            <div id='mapId'></div>
        </section>
    </article>
	<script src='js/map.js' type='text/javascript'></script>
";

include "template.php";
