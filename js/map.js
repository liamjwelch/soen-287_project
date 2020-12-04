// Initialize Map
const Concordia = L.latLng([45.495675, -73.578667]);
const Harvard = L.latLng([42.36790855, -71.12678237443698]);
const mit = L.latLng([42.3583961, -71.09567787663931]);
const McGill = L.latLng([45.50691775, -73.5791162596496]);
const Toronto = L.latLng([43.663461999999996, -79.39775965337452]);
var popup = L.popup();

map = L.map('mapId').setView([40.8088861, -96.7077751], 4);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

L.marker(Concordia).addTo(map).bindPopup("<a href='university.php'>Concordia University</a>");
L.marker(Harvard).addTo(map).bindPopup("<a href='university.php'>Harvard University</a>");
L.marker(mit).addTo(map).bindPopup("<a href='university.php'>Massachusetts Institute of Technology</a>");
L.marker(McGill).addTo(map).bindPopup("<a href='university.php'>McGill University</a>");
L.marker(Toronto).addTo(map).bindPopup("<a href='university.php'>University of Toronto</a>");

document.getElementById('search').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        document.getElementById("searchButton").click();
    }
});

function addr_search() {
    var addr = document.getElementById("search").value;
    var xmlhttp = new XMLHttpRequest();
    var url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + addr;

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var view = JSON.parse(xmlhttp.responseText);
            map.setView(([view[0].lat, view[0].lon]), 12);
        }
    };

    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}