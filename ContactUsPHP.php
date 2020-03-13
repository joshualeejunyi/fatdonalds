<!DOCTYPE html>
<html>
  <head>
    <?php
    include "HeadInclude.php";
    ?>  
    <script defer src="ContactUs/contactUsJS.js"></script>
    <style>
     <?php  
    include "ContactUs/contactUsCss.css"; 
    ?> 
    </style>
    
    <script>
    <?php
     include "contactUs/contactUsJS.js";
     ?>
    </script>
    
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuzdwZdjHBM2Pm9_0UPI3jiz7c2qIrs2M&callback=initMap">
    </script>
  </head>
  <body>
    <?php  
    include "nav.inc.php"; 
    ?> 
            <main class='container'>
            <section id='MapContainer'>
                <h2>Locate Us!</h2>
                <div class="row">
                    

                <div class="panel-group col-3" id="page_container" style="overflow-y: auto">
                <input class="form-control" id="anythingSearch" type="text" placeholder="Type to search page: ">
                        
                <div id="accordionpanels">



                    <button class="accordion">Section 1</button>
                    <div class="panel">
                      <p>654Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>

                    <button class="accordion">Section 2</button>
                    <div class="panel" >
                      <p>987Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>

                    <button class="accordion">Section 3</button>
                    <div class="panel">
                      <p>0Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>

                </div>
            
                    </div>

                    <div class="col">
                        <div class="card-img-top" style="width: 50rem">
                            <div id="map"></div>
                        </div>
                    </div>
                   
                </section>
                 
            <?php  
            include "footer.inc.php"; 
            ?> 
        </main>
    <div id="map"></div>
  </body>
</html>













