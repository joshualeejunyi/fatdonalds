// Project : Fatdonald's
// File: locate.js
// Authors: Nicholas

$(document).ready(function() {
    initMap();
    accordion();
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
  
  
    var contentString = '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h4 id="firstHeading" class="firstHeading">FatDonalds @ NYP</h4>'+
        '<div id="bodyContent">'+
        '<h5>Location: </h5>'+
        '<p>180 Ang Mo Kio Ave 8, Singapore 569830</p>'+
        '<h6>Operating Hours: </h6>'+
        '<p>Daily : 0800hrs to 0800hrs</p>'+
        '</div> </div>';

    var infowindow = new google.maps.InfoWindow({
      content: contentString
    });

            var contentString2 = '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h4 id="firstHeading" class="firstHeading">FatDonalds @ T4</h4>'+
        '<div id="bodyContent">'+
        '<h5>Location: </h5>'+
        '<p>10 Airport Blvd, Terminal 4, Singapore 819665</p>'+
        '<h6>Operating Hours: </h6>'+
        '<p>Daily : 0900hrs to 2100hrs</p>'+
        '</div> </div>';
    var infowindow2 = new google.maps.InfoWindow({
          content: contentString2
        });
    
        var contentString3 = '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h4 id="firstHeading" class="firstHeading">FatDonalds @ Vivo</h4>'+
        '<div id="bodyContent">'+
        '<h5>Location: </h5>'+
        '<p>1 Harbourfront Walk, Singapore 098585</p>'+
        '<h6>Operating Hours: </h6>'+
        '<p>Daily : 1000hrs to 2200hrs</p>'+
        '</div> </div>';
    var infowindow3 = new google.maps.InfoWindow({
          content: contentString3
        });
    
    
    var contentString4 = '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h4 id="firstHeading" class="firstHeading">FatDonalds @ SAFRA Jurong</h4>'+
        '<div id="bodyContent">'+
        '<h5>Location: </h5>'+
        '<p>333 Boon Lay Way, Singapore 649848</p>'+
        '<h6>Operating Hours: </h6>'+
        '<p>Daily : 0900hrs to 2100hrs</p>'+
        '</div> </div>';
    var infowindow4 = new google.maps.InfoWindow({
          content: contentString4
        });
  
  
  
  
  
    var contentString5 = '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h4 id="firstHeading" class="firstHeading">Fresh @ SG</h4>'+
        '<div id="bodyContent">'+
        '<h5>Location: </h5>'+
        '<p>80 Mandai Lake Rd, 729826</p>'+
        '<h6>Operating Hours: </h6>'+
        '<p>Daily : 0830hrs to 1800hrs</p>'+
        '</div> </div>';
    var infowindow5 = new google.maps.InfoWindow({
          content: contentString5
        });
        
        
        
        
        
    marker.addListener('click', function() {
      map.setZoom(15);
      map.setCenter(marker.getPosition());
      infowindow.open(map, marker);
    });
    marker2.addListener('click', function() {
       map.setZoom(15);
       map.setCenter(marker.getPosition());
       infowindow2.open(map, marker2);
     });
    marker3.addListener('click', function() {
      map.setZoom(15);
      map.setCenter(marker.getPosition());
      infowindow3.open(map, marker3);
    });
    marker4.addListener('click', function() {
       map.setZoom(15);
       map.setCenter(marker.getPosition());
       infowindow4.open(map, marker4);
     });
    marker5.addListener('click', function() {
      map.setZoom(15);
      map.setCenter(marker.getPosition());
      infowindow5.open(map, marker5);
      
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