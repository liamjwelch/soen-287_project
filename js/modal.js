var modal = document.getElementById('modal');

var openModal = document.getElementById('modal-button');

var close = document.getElementById('close');

openModal.onclick = function() {
    modal.style.display = "block";
}

window.onclick = function(event) {
    if(event.target == modal) {
        modal.style.display = "none";
    }
}