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
	            <option value='computer_science'>Compute Science</option>
	            <option value='economics'>Economics</option>
            </select> 
            <button class='filter-button' type='button' name='filterButton' onclick='filterUniversities()'>
                <i class='fa fa-sliders icons'></i> Filter
            </button>
        </form> 
        <h3 id='msg'></h3>
        <table class='filter-table' id='filterTable'>
          <tr>
            <th>Name of the University</th>
            <th>Country</th>
            <th>City</th>
          </tr>
          <tr>
            <td><a href='#'>HARVARD UNIVERSITY</a></td>
            <td>USA</td>
            <td>Boston</td>
          </tr>
          <tr>
            <td><a href='#'>MASSACHUSSETS INSTITUTE OF TECHNOLOGY</a></td>
            <td>USA</td>
            <td>Boston</td>
          </tr>
          <tr>
            <td><a href='#'>CONCORDIA UNIVERSITY</a></td>
            <td>Canada</td>
            <td>Montreal</td>
          </tr>
          <tr>
            <td><a href='#'>MCGILL UNIVERSITY</a></td>
            <td>Canada</td>
            <td>Montreal</td>
          </tr>
        </table>
        <script src='js/filter.js' type='text/javascript'></script>
    </article>
	<article class='filter-article'>
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
