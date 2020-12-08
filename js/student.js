const description = document.getElementById('navDescription');
const preferences = document.getElementById('navPreferences');
const financial = document.getElementById('navFinancial');

description.addEventListener('click', changeActive);
preferences.addEventListener('click', changeActive);
financial.addEventListener('click', changeActive);

displaySection();

function changeActive() {
    resetClassNames();
    this.className = this.getAttribute('class') + " active";
    displaySection();
}

function resetClassNames() {
    description.className = "";
    preferences.className = "";
    financial.className = "";
}

// Display the corresponding section depending on active element on nav
function displaySection() {
    document.getElementById('description').style.display = "none";
    document.getElementById('preferences').style.display = "none";
    document.getElementById('financial').style.display = "none";
    if (description.className !== "") {
        document.getElementById('description').style.display = "";
    } else if (preferences.className !== "") {
        document.getElementById('preferences').style.display = "";
    } else if (financial.className !== "") {
        document.getElementById('financial').style.display = "";
    }
}