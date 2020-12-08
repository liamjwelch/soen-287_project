var modal = document.getElementById('modal');

var openModal = document.getElementById('modal-button');

var close = document.getElementById('close');

// Open the modal when clicking on the "href"
openModal.onclick = function() {
    modal.style.display = "block";
}

// Close the modal by clicking outside the modal
window.onclick = function(event) {
    if(event.target == modal) 
        modal.style.display = "none";
}
