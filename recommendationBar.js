var i = 0;

function move() {
  if (i == 0) {
    i = 1;
    var elem = document.getElementById("myBar");
    var infoPrintOut = document.getElementById("infoPrintOut");
    var congratulations = document.getElementById("congratulations");
    var width = 1;
    speed = 100;
    var id = setInterval(frame, speed);
    function frame() {
      if (width >= 1){	
      width+= .5;
      elem.style.width = width + "%";
      elem.innerHTML = width + "%";
      infoPrintOut.innerHTML = "initializing..."
	  }

      if(width >= 11) {
      infoPrintOut.innerHTML = "Geographical cross-triangulation comparison analysis..."
      width+= .1;
      }

      if(width >= 26) {
      infoPrintOut.innerHTML = "Geographical engine cross comparison complete."
      width++;
      }

      if(width >= 31) {
      infoPrintOut.innerHTML = "Academic-Excellence GPA scan initiated..."
      width+= .1;
      }

      if(width >= 41) {
      infoPrintOut.innerHTML = "Academic-Excellence GPA scan complete."
      width++;
      elem.style.backgroundColor = "yellow";
      }
      if(width >= 42) {
      infoPrintOut.innerHTML = "ζήτα άλφα modulation initialized..."
      width+= .1;
      }

       if(width >= 58) {
      infoPrintOut.innerHTML = "ζήτα άλφα modulated."
      width++;
      }

      if(width >= 59) {
      infoPrintOut.innerHTML = "Referencing Academic Analysis Archives."
      width+= .1;
      elem.style.backgroundColor = "orange";
      }

      if(width >= 71) {
      infoPrintOut.innerHTML = "Academic Analysis Archives Referenced."
      width+= 1;
      }

      if(width >= 74) {
      infoPrintOut.innerHTML = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      width+= .1;
      elem.style.backgroundColor = "red";
      }

      if(width >= 86) {
      infoPrintOut.innerHTML = "Ad. Nauseam Completed."
      width+= 1;
      }

      if(width >= 87) {
      infoPrintOut.innerHTML = "Match Making Magic Nearing Infinitude..."
      width+= 2;
      }

      if (width >= 100) {
      	elem.style.width = 100;
      	elem.innerHTML = "MATCH COMPLETE";
      	congratulations.innerHTML = "CONGRATULATIONS... you matched with CONCORDIA UNIVERSITY!";
      	elem.style.color = "white";
      	elem.style.backgroundColor = "#680F13";
        infoPrintOut.innerHTML = "";
        i = 0;
        clearInterval(id);
      } 

    }
  }
} 	