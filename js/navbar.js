// Add active class to the current page
var page = window.location.href.replace(window.location.origin + "/soen287-project/", "");
var elements = document.getElementsByClassName('page');
for(var i = 0; i < elements.length; i++){
    if(elements[i].getAttribute('href') == page) {
        elements[i].className = elements[i].getAttribute('class') + " active";
    }
}