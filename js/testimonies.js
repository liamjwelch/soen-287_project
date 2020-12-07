// Automatic slideshow -  changes testimony every 10 seconds

var xmlhttp = new XMLHttpRequest();
var currentTestimonyIndex = 0;
var testimonies = [];

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       testimonies = JSON.parse(xmlhttp.responseText);
       slideShow();
    }
};

xmlhttp.open("GET", "readTestimonies.php", true);
xmlhttp.send();

function slideShow() {
    var element = document.getElementById('card');
    element.innerHTML = testimonies[currentTestimonyIndex];
    if(currentTestimonyIndex == testimonies.length - 1)
        currentTestimonyIndex = 0;
    else
        currentTestimonyIndex++;
    setTimeout(slideShow, 10000);
}