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
  

//google.maps.event.addListener(marker, 'click', function() {
//map.panTo(this.getPosition());
//map.setZoom(9);
//  });   
  
map.setZoom(17);
map.panTo(marker.position);
  
  
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

$('.collapse').not(':first').collapse(); // Collapse all but the first row on the page.

// This section makes the search work.
(function() {
  var searchTerm, panelContainerId;
  $('#anythingSearch').on('change keyup', function() {
    searchTerm = $(this).val();
    $('#accordion > .panel').each(function() {
      panelContainerId = '#' + $(this).attr('id');

      // Makes search to be case insesitive 
      $.extend($.expr[':'], {
        'contains': function(elem, i, match, array) {
          return (elem.textContent || elem.innerText || '').toLowerCase()
            .indexOf((match[3] || "").toLowerCase()) >= 0;
        }
      });

      // END Makes search to be case insesitive

      // Show and Hide Triggers
      $(panelContainerId + ':not(:contains(' + searchTerm + '))').hide(); //Hide the rows that done contain the search query.
      $(panelContainerId + ':contains(' + searchTerm + ')').show(); //Show the rows that do!

    });
  });
}());