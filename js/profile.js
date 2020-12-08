const description = document.getElementById('navDescription');
const programs = document.getElementById('navPrograms');
const application = document.getElementById('navApplication');
const financial = document.getElementById('navFinancial');

description.addEventListener('click', changeActive);
programs.addEventListener('click', changeActive);
application.addEventListener('click', changeActive);
financial.addEventListener('click', changeActive);

displaySection();

function changeActive() {
    resetClassNames();
    this.className = this.getAttribute('class') + " active";
    displaySection();
}

function resetClassNames() {
    description.className = "";
    programs.className = "";
    financial.className = "";
    application.className = "";
}

// Display the corresponding section depending on active element on nav
function displaySection() {
    document.getElementById('description').style.display = "none";
    document.getElementById('programs').style.display = "none";
    document.getElementById('application').style.display = "none";
    document.getElementById('financial').style.display = "none";
    if (description.className !== "") {
        document.getElementById('description').style.display = "";
    } else if (programs.className !== "") {
        document.getElementById('programs').style.display = "";
    } else if (application.className !== "") {
        document.getElementById('application').style.display = "";
    } else if (financial.className !== "") {
        document.getElementById('financial').style.display = "";
    }
}