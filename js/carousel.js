// Automatic Slideshow - change image every 4 seconds

var currentImageIndex = 0;
var images = document.getElementsByClassName('slides_image');
for (var image of images) {
    image.style.display = "none";
}

carousel();

function carousel() {
    images[currentImageIndex].style.display = 'none';
    currentImageIndex = (currentImageIndex + 1) % images.length;
    images[currentImageIndex].style.display = 'block';
    setTimeout(carousel, 4000);
}

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