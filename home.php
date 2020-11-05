<?php
$title = "North America Higher Education Database";
$styles = ["css/homepage.css"];
$content = '
	<div class="slides_container">
		<img src="images/harvard.png" alt="Harvard" class="slides_image">
		<div class="slides_text">Harvard University</div>
	</div>
	<div class="slides_container">
		<img src="images/stanford.png" alt="Stanford" class="slides_image">
		<div class="slides_text">Standford University</div>
	</div>
	<div class="slides_container">
		<img src="images/princeton.png" alt="Princeton" class="slides_image">
		<div class="slides_text">Princeton University</div>
	</div>

	<div class="card">
			<h2>INFORMATION</h2>
			<p>We could place information in cards</p>
			<p>They are a nice way to display information</p>
	</div>

	<div class="info">
			<h2>INFORMATION</h2>
			<p>More information</p>
	</div>
	
	<script>
        // Automatic Slideshow - change image every 4 seconds
        var myIndex = 0;
        carousel();
        
        function carousel() {
          var i;
          var x = document.getElementsByClassName("slides_container");
          for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
          }
          myIndex ++;
          if (myIndex > x.length) {
            myIndex = 1
          }    
          x[myIndex-1].style.display = "block";  
          setTimeout(carousel, 4000);    
        }
    </script>
';

include "template.php";
