function filterUniversities() {
    const country = getSelectedOption(document.getElementById('country')).label;
    const state = getSelectedOption(document.getElementById('state')).label;
    const city = getSelectedOption(document.getElementById('city')).label;
    const program = getSelectedOption(document.getElementById('program')).label;
    const tr = document.getElementById('filterTable').getElementsByTagName('tr');
    let uniCountry, uniCity, uniState, uniPrograms, cont = 0;

    for(let i = 1; i < tr.length; i++) {
        tr[i].style.display = "none";
        uniCountry = tr[i].getElementsByTagName('td')[3].textContent || tr[i].getElementsByTagName('td')[3].innerText;
        uniState = tr[i].getElementsByTagName('td')[4].textContent || tr[i].getElementsByTagName('td')[4].innerText;
        uniCity = tr[i].getElementsByTagName('td')[5].textContent || tr[i].getElementsByTagName('td')[5].innerText;
        uniPrograms = tr[i].getElementsByTagName('td')[6].getElementsByTagName("li");

        if(uniCountry && uniCity && uniState && program) {
            if (country !== "Select a country") {
                cont = compareCountry(country, uniCountry, state, uniState, city, uniCity, program, uniPrograms, tr[i], cont);
            } else if (state !== "Select a state") {
                cont = compareState(state, uniState, city, uniCity, program, uniPrograms, tr[i], cont);
            } else if (city !== "Select a city") {
                cont = compareCity(city, uniCity, program, uniPrograms, tr[i], cont);
            } else if(program !== "Select a program"){
                cont = comparePrograms(program, uniPrograms, tr[i], cont);
            } else {
                tr[i].style.display = "";
            }
        }
    }

    // If no university matches the criteria, display "NO RESULTS"
    if(cont === (tr.length - 1)) {
        tr[0].style.display = "none";
        document.getElementById('msg').innerHTML = "NO RESULTS"
    } else {
        tr[0].style.display = "";
        document.getElementById('msg').innerHTML = ""
    }

    // Get the selected option
    function getSelectedOption(select) {
        let option;
        for(let i = 0; i < select.options.length; i++) {
            if(select.options[i].selected === true) {
                option = select.options[i];
                break;
            }
        }
        return option;
    }

    // Compare the program selected to the programs available at the university
    function comparePrograms(program, uniPrograms, tableElement, cont) {
        let uniProgram = "";
        for(let i = 0; i < uniPrograms.length; i++) {
            uniProgram = uniPrograms[i].textContent || uniPrograms[i].innerText;
            if (uniProgram.localeCompare(program) === 0) {
                tableElement.style.display = "";
                break;
            } else {
                cont++;
            }
        }
        return cont;
    }

    // Compare the city selected to the city of the table element
    function compareCity(city, uniCity, program, uniPrograms, tableElement, cont) {
        if (uniCity.localeCompare(city) === 0) {
            if(program !== "Select a program"){
                cont = comparePrograms(program, uniPrograms, tableElement, cont);
            } else {
                tableElement.style.display = "";
            }
        } else {
            cont++;
        }
        return cont;
    }

    // Compare the state selected to the state of the table element
    function compareState(state, uniState, city, uniCity, program, uniPrograms, tableElement, cont) {
        if (uniState.localeCompare(state) === 0) {
            if(city !== "Select a city") {
                cont = compareCity(city, uniCity, program, uniPrograms, tableElement, cont);
            } else if (program !== "Select a program") {
                cont = comparePrograms(program, uniPrograms, tableElement, cont);
            } else {
                tableElement.style.display = "";
            }
        } else {
            cont++;
        }
        return cont++;
    }

    // Compare the country selected to the country of the table element
    function compareCountry(country, uniCountry, state, uniState, city, uniCity, program, uniProgram, tableElement, cont) {
        if (uniCountry.localeCompare(country) === 0) {
            if (state !== "Select a state") {
                cont = compareState(state, uniState, city, uniCity, program, uniProgram, tableElement, cont);
            } else if (city !== "Select a city") {
                cont = compareCity(city, uniCity, program, uniPrograms, tableElement, cont);
            } else if (program !== "Select a program") {
                cont = comparePrograms(program, uniPrograms, tableElement, cont);
            } else {
                tableElement.style.display = "";
            }
        } else {
            cont++;
        }
        return cont++;
    }
}