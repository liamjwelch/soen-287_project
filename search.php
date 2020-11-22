<?php
session_start();
$title = "North America Higher Education Database";
$styles = ["css/search.css"];

$headerContent = "<link rel='stylesheet' href='https://unpkg.com/leaflet@1.7.1/dist/leaflet.css' integrity='sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==' crossorigin=''/>
	<script src='https://unpkg.com/leaflet@1.7.1/dist/leaflet.js' integrity='sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==' crossorigin=''>
		var mymap =null;
	</script>
";

$content = "
    <article class='search-article'>
        <form class='search'>
            <input type='text' placeholder='University name' name='search' id='search'>
            <button class='search-button' type='button' name='searchButton' id='searchButton' onclick='addr_search()'><i class='fa fa-search icons'></i> Search</button>
        </form>
    </article>
    <article class='map-article'>
        <section class='map-section'>
            <div id='mapId'></div>
        </section>
    </article>
	<script src='js/map.js' type='text/javascript'></script>
	<article class='filter-article'>
	    <form class='filter'>
	        <input type='text' placeholder='Country' name='country' id='country'>
	        <input type='text' placeholder='City' name='city' id='city'>
	        <select name='degree' id='degree'>
	            <option value='computer_science'>Compute Science</option>
	            <option value='economics'>Economics</option>
            </select> 
            <button class='filter-button' type='button' name='filterButton' onclick='filter_universities()'><i class='fa fa-sliders icons'></i> Filter</button>  
        </form> 
        <article class='centered-cards'>
            <section class='university-card'>
                <a href='university.php'>
                   <img src='images/harvard.jpg' alt='Harvard' class='slides_image'>
                   <section class='university-info'>
                       <h2>HARVARD UNIVERSITY</h2>
                       <p>Country</p>
                       <p>City</p>
                    </section>
               </a>
            </section>
            <section class='university-card'>
                <a href='university.php'>
                   <img src='images/mit.jpg' alt='Mit' class='slides_image'>
                   <section class='university-info'>
                       <h2>MASSACHUSSETS INSTITUTE OF TECHNOLOGY</h2>
                       <p>Country</p>
                       <p>City</p>
                   </section>
                </a>
            </section>
            <section class='university-card'>
                <a href='university.php'>
                   <img src='images/mcgill.jpg' alt='McGill' class='slides_image'>
                   <section class='university-info'>
                       <h2>MCGILL UNIVERSITY</h2>
                       <p>Country</p>
                       <p>City</p>
                   </section>        
                </a>
            </section>
        </article>
      </article>
";

include "template.php";
