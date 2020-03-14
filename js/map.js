$(document).ready(initMap);
function initMap() {
    // The location of Uluru
    var NYPSIT = {lat: 1.377710, lng: 103.849523};
    var WorstFoodSg = {lat: 1.405281, lng: 104.030924};
    var BehindBars = {lat: 1.357958, lng: 103.973517};
    var OwO = {lat: 1.335018, lng: 103.706517};
    var UwU = {lat: 30.602503, lng: 114.342270};
    // The map, centered at Uluru
    var map = new google.maps.Map(
        document.getElementById('map'), {zoom: 8, center: NYPSIT});
    // The marker, positioned at Uluru
    var marker = new google.maps.Marker({position: NYPSIT, map: map});
    var marker2 = new google.maps.Marker({position: WorstFoodSg, map: map});
    var marker3 = new google.maps.Marker({position: BehindBars, map: map});
    var marker4 = new google.maps.Marker({position: OwO, map: map});
    var marker5 = new google.maps.Marker({position: UwU, map: map});
}