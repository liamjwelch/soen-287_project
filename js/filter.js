function filterUniversities() {
    const country = document.getElementById('country').value.toUpperCase();
    const city = document.getElementById('city').value.toUpperCase();
    //var degree = document.getElementById('degree').value.toUpperCase();
    const tr = document.getElementById('filterTable').getElementsByTagName('tr');
    var tdCountry, tdCity, txtCountry, txtCity, cont = 0;

    for(let i = 1; i < tr.length; i++) {
        tr[i].style.display = "none";
        tdCountry = tr[i].getElementsByTagName('td')[2];
        tdCity = tr[i].getElementsByTagName('td')[3];
        if(tdCountry || tdCity) {
            if (country !== "" || city !== "") {
                txtCountry = tdCountry.textContent || tdCountry.innerText;
                txtCity = tdCity.textContent || tdCity.innerText;
                if (txtCountry.toUpperCase().localeCompare(country) === 0 || txtCity.toUpperCase().localeCompare(city) === 0) {
                    tr[i].style.display = "";
                } else {
                    cont ++;
                }
            } else {
                tr[i].style.display= "";
            }
        }
    }

    if(cont === (tr.length - 1)) {
        tr[0].style.display = "none";
        document.getElementById('msg').innerHTML = "NO RESULTS"
    } else {
        tr[0].style.display = "";
        document.getElementById('msg').innerHTML = ""
    }
}