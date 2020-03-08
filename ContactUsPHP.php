<!DOCTYPE html>
<html>
  <head>
    <style>
      /* Set the size of the div element that contains the map */
      #map {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
    </style>
  </head>
  <body>
    <h2>Contact Us at these locations!</h2>
    <!--The div element for the map -->
    <div id="map"></div>
    <script>
// Initialize and add the map
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





    </script>
    
<!--    you guys dont chibai this my api key dont playplay-->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuzdwZdjHBM2Pm9_0UPI3jiz7c2qIrs2M&callback=initMap">

    </script>
  </body>
</html>













