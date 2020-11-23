// Initialize Map
const Concordia = L.latLng([45.495675, -73.578667]);
const Harvard = L.latLng([42.36790855, -71.12678237443698]);
const mit = L.latLng([42.3583961, -71.09567787663931]);
const McGill = L.latLng([45.50691775, -73.5791162596496]);
const Toronto = L.latLng([43.663461999999996, -79.39775965337452]);
var popup = L.popup();

mymap = L.map('mapId').setView([40.8088861, -96.7077751], 4);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(mymap);

L.marker(Concordia).addTo(mymap).bindPopup("<a href='university.php'>Concordia University</a>");
L.marker(Harvard).addTo(mymap).bindPopup("<a href='university.php'>Harvard University</a>");
L.marker(mit).addTo(mymap).bindPopup("<a href='university.php'>Massachusetts Institute of Technology</a>");
L.marker(McGill).addTo(mymap).bindPopup("<a href='university.php'>McGill University</a>");
L.marker(Toronto).addTo(mymap).bindPopup("<a href='university.php'>University of Toronto</a>");

document.getElementById('search').addEventListener('keyup', function(event) {
    if (event.keyCode === 13 || event.which === 13) {
        event.preventDefault();
        document.getElementById('searchButton').click();
    }
});

function addr_search() {
    var addr = document.getElementById("search").value;
    var xmlhttp = new XMLHttpRequest();
    var url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + addr;

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            var myArr = JSON.parse(xmlhttp.responseText);
            mymap.setView(([myArr[0].lat, myArr[0].lon]), 12);
        }
    };

    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}