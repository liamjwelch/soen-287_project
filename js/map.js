//var popup = L.popup();
map = L.map('mapId').setView([40.8088861, -96.7077751], 4);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

document.getElementById('search').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        document.getElementById("searchButton").click();
    }
});

function addrSearch() {
    const addr = document.getElementById("search").value;
    var xmlhttp = new XMLHttpRequest();
    const url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + addr;

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var view = JSON.parse(xmlhttp.responseText);
            map.setView(([view[0].lat, view[0].lon]), 12);
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function createMarkers(address, id, name) {
    var xmlhttp = new XMLHttpRequest();
    const url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + addr;

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const coordinates = JSON.parse(xmlhttp.responseText);
            const uni = L.latLng([coordinates[0].lat, coordinates[0].lat]);
            const link = "<a href='university.php?id=" + id + "'>" + name + "</a>";
            L.marker(uni).addTo(map).bindPopup(link);
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}