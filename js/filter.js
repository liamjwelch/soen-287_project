function filterUniversities() {
    const selectedCountry = document.getElementById('country').value;
    const selectedState = document.getElementById('state').value;
    const selectedCity = document.getElementById('city').value;
    const selectedProgram = document.getElementById('program').value;
    const tr = document.getElementById('filterTable').getElementsByTagName('tr');
    let uniCountry, uniCity, uniState, uniPrograms, cont = 0;

    for (let i = 1; i < tr.length; i++) {
        uniCountry = tr[i].getElementsByTagName('td')[3].textContent || tr[i].getElementsByTagName('td')[3].innerText;
        uniState = tr[i].getElementsByTagName('td')[4].textContent || tr[i].getElementsByTagName('td')[4].innerText;
        uniCity = tr[i].getElementsByTagName('td')[5].textContent || tr[i].getElementsByTagName('td')[5].innerText;
        uniPrograms = tr[i].getElementsByTagName('td')[6].getElementsByTagName("li");

        if (selectedCountry !== "" && selectedCountry !== uniCountry) {
            tr[i].style.display = "none";
            cont++;
        } else if (selectedState !== "" && selectedState !== uniState) {
            tr[i].style.display = "none";
            cont++;
        } else if (selectedCity !== "" && selectedCity !== uniCity) {
            tr[i].style.display = "none";
            cont++;
        } else if (selectedProgram !== "" && !containsProgram(selectedProgram, uniPrograms)) {
            tr[i].style.display = "none";
            cont++;
        } else {
            tr[i].style.display = "";
        }
    }

    // If no university matches the criteria, display "NO RESULTS"
    if (cont === (tr.length - 1)) {
        tr[0].style.display = "none";
        document.getElementById('msg').innerHTML = "NO RESULTS"
    } else {
        tr[0].style.display = "";
        document.getElementById('msg').innerHTML = ""
    }
}

// Validate if the university contains the selected program
function containsProgram(selectedProgram, uniPrograms) {
    let found = false;
    let program;
    for(let i = 0; i < uniPrograms.length; i++) {
        program = uniPrograms[i].textContent || uniPrograms[i].innerText;
        if (program.localeCompare(selectedProgram) === 0) {
            found = true;
            break;
        }
    }
    return found;
}