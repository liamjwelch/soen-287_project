// Add active class to the current page
const page = window.location.href.replace(window.location.origin + "/soen287-project/", "");
const elements = document.getElementsByClassName('page');
for(let i = 0; i < elements.length; i++){
    if(elements[i].getAttribute('href') === page) {
        elements[i].className = elements[i].getAttribute('class') + " active";
    }
}