// Automatic Slideshow for images
let currentImageIndex = 0;
let images = document.getElementsByClassName('slides_image');
for (const image of images) {
    image.style.display = "none";
}
carousel();

// Changes image every 4 seconds
function carousel() {
    images[currentImageIndex].style.display = 'none';
    currentImageIndex = (currentImageIndex + 1) % images.length;
    images[currentImageIndex].style.display = 'block';
    setTimeout(carousel, 4000);
}


// Automatic slideshow for testimonials
let xmlhttp = new XMLHttpRequest();
let currentTestimonyIndex = 0;
let testimonies = [];
xmlhttp.onreadystatechange = function() {
    if (this.readyState === 4 && this.status === 200) {
       testimonies = JSON.parse(xmlhttp.responseText);
       testimonials();
    }
};
xmlhttp.open("GET", "readTestimonies.php", true);
xmlhttp.send();

// Changes testimony every 10 seconds
function testimonials() {
    let element = document.getElementById('card');
    element.innerHTML = testimonies[currentTestimonyIndex];
    if(currentTestimonyIndex === testimonies.length - 1)
        currentTestimonyIndex = 0;
    else
        currentTestimonyIndex++;
    setTimeout(testimonials, 10000);
}