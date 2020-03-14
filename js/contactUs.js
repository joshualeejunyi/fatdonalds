$( document ).ready(function() {
    initMap();
    accordion();
    searchbarz();

});

// Initialize and add the map
function initMap() {
  // The location of Uluru
  var NYPSIT = {lat: 1.377710, lng: 103.849523};
  var ChangiAirport = {lat: 1.338189, lng: 103.983427};
  var Vivo = {lat: 1.264478, lng: 103.822196};
  var SafraJurong = {lat: 1.335018, lng: 103.706517};
  var Zoo = {lat: 1.404316, lng: 103.793098};
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 8, center: NYPSIT});
  // The marker, positioned at Uluru
  var marker = new google.maps.Marker({position: NYPSIT, map: map});
  var marker2 = new google.maps.Marker({position: ChangiAirport, map: map});
  var marker3 = new google.maps.Marker({position: Vivo, map: map});
  var marker4 = new google.maps.Marker({position: SafraJurong, map: map});
  var marker5 = new google.maps.Marker({position: Zoo, map: map});
 
  
    marker.addListener('click', function() {
  map.setZoom(8);
  map.setCenter(marker.getPosition());
    });
  
}

function accordion() {
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
}

function searchbarz(){
 //FIlter anything
  $("#anythingSearch").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    //Hide
    $(".panel").css("max-height", 0);
    $(".accordion").hide();
    
    $("#accordionpanels > .accordion").filter(function () {
//        console.log($(this).text());
//        console.log($(this).text().toLowerCase().indexOf(value) > -1);
      return $(this).text().toLowerCase().indexOf(value) > -1;
    }).show();
    $("#accordionpanels > .accordion").filter(function () {
      return $(this).text().toLowerCase().indexOf(value) > -1;
    }).next().css("max-height", "308px");
        // Show .panel
    $("#accordionpanels > .panel > p").filter(function() {
        return $(this).text().toLowerCase().indexOf(value) > -1;
    }).parent().css("max-height", "0px");

    // Show related button
    $("#accordionpanels > .panel > p").filter(function() {
        return $(this).text().toLowerCase().indexOf(value) > -1;
    }).parent().prev().show();
  });
  
}


