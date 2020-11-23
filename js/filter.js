function filterUniversities() {
    var country = document.getElementById('country').value.toUpperCase();
    var city = document.getElementById('city').value.toUpperCase();
    //var degree = document.getElementById('degree').value.toUpperCase();
    var tr = document.getElementById('filterTable').getElementsByTagName('tr');
    var i, tdCountry, tdCity, txtCountry, txtCity, cont = 0;

    for(i = 1; i < tr.length; i++) {
        tr[i].style.display = "none";
        tdCountry = tr[i].getElementsByTagName('td')[1];
        tdCity = tr[i].getElementsByTagName('td')[2];
        if(tdCountry || tdCity) {
            if(country != "") {
                txtCountry = tdCountry.textContent || tdCountry.innerText;
                if(txtCountry.toUpperCase().indexOf(country) > -1) {
                    if(city != "") {
                        txtCity = tdCity.textContent || tdCity.innerText;
                        if(txtCity.toUpperCase().indexOf(city) > -1) {
                            tr[i].style.display= "";
                        } else {
                            cont++;
                        }
                    } else {
                        tr[i].style.display= "";
                    }
                } else {
                    cont++;
                }
            } else {
                tr[i].style.display= "";
            }
        }
    }

    if(cont == (tr.length - 1)) {
        tr[0].style.display = "none";
        document.getElementById('msg').innerHTML = "NO RESULTS"
    } else {
        tr[0].style.display = "";
        document.getElementById('msg').innerHTML = ""
    }
}