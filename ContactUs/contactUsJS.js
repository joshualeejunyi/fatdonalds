/* global searchTerm */

$( document ).ready(function() {
    initMap();
    accordion();
    searchbarz();

});

//$(document).click(function(){
//   accordion();
//});

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
  
          map.addListener('center_changed', function() {
          // 3 seconds after the center of the map has changed, pan back to the
          // marker.
          window.setTimeout(function() {
            map.panTo(marker.getPosition());
          }, 3000);
        });
  
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

(function(){
  var searchTerm, panelContainerId;
  // Create a new contains that is case insensitive
  $.expr[':'].containsCaseInsensitive = function (n, i, m) {
    return jQuery(n).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
  };
  
  $('#accordion_search_bar').on('change keyup paste click', function () {
    searchTerm = $(this).val();
    $('#accordion > .panel').each(function () {
      panelContainerId = '#' + $(this).attr('id');
      $(panelContainerId + ':not(:containsCaseInsensitive(' + searchTerm + '))').hide();
      $(panelContainerId + ':containsCaseInsensitive(' + searchTerm + ')').show();
    });
  });
}());


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
  
  
//  $("#anythingSearch").bind("keyup", function() {
//    var text = $(this).val().toLowerCase();
//    var items = $(".panel");
//
//    //first, hide all:
//    items.parent().hide();
//
//    //show only those matching user input:
//    items.filter(function () {
//        return $(this).text().toLowerCase().indexOf(text) == 1;
//    }).parent().show();
//});
  
  
  
//  
//  $("#anythingSearch").bind("keyup", function() {
//            let text = $(this).val().toLowerCase();
//
//            // What is this hidding? Hiding all?
//            $(".panel, accordion").hide();
//
//            // Show button
//            $("#accordionpanels > button").filter(function() {
//                return $(this).text().toLowerCase().indexOf(text) >= 0;
//            }).show();
//
//            // Show .panel
//            $("#accordionpanels > .panel > p").filter(function() {
//                return $(this).text().toLowerCase().indexOf(text) >= 0;
//            }).parent().show();
//t
//            // Show related button
//            $("#accordionpanels > .panel > p").filter(function() {
//                return $(this).text().toLowerCase().indexOf(text) >= 0;
//            }).parent().prev().show();
//        });

  
  
  
  
  
  
}


