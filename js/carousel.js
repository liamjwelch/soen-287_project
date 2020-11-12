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