<?php  
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
?>
<!DOCTYPE html>
<html class="html">
    <head>
    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/incl/head.inc.php');
    ?>
    <style>
     <?php  
    include ($_SERVER['DOCUMENT_ROOT'].'/css/contactUs.css'); 
    ?> 
    </style>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuzdwZdjHBM2Pm9_0UPI3jiz7c2qIrs2M&callback=initMap">
    </script>

    <script defer src="/js/contactUs.js"></script>   

    </head>
    <body>
        <?php
            include($_SERVER['DOCUMENT_ROOT'].'/incl/nav.inc.php');
        ?>
            <main class='container'>
<!--        <div id="bg">
                <img src="images/What-Is-a-Fry-Oil-Study.png" alt="">
            </div>-->
            <div id='page-wrap'>
                <h2>Locate Us!</h2>
                <div class="row">
                    <div class='col-span-4 col-xs-4 col-sm-4'>
                    <input class="form-control" id="anythingSearch" type="text" placeholder="Type to search page: ">
                    <div id="accordionpanels">
                        <button class="accordion">FatDonald's @ NYP</button>
                        <div class="panel">
                            <h4>Location: </h4>
                            <p>180 Ang Mo Kio Ave 8, Singapore 569830</p>

                            <h5>Operating Hours: </h5>
                            <p>Daily : 0800hrs to 0800hrs</p>
                        </div>

                        <button class="accordion">FatDonald's @ SAFRA Jurong</button>
                        <div class="panel">
                            <h4>Location: </h4>
                            <p>333 Boon Lay Way, Singapore 649848</p>

                            <h5>Operating Hours: </h5>
                            <p>Daily : 0900hrs to 2100hrs</p>
                        </div>
                        
                        <button class="accordion">FatDonald's @ Vivo</button>
                        <div class="panel">
                            <h4>Location: </h4>
                            <p>1 Harbourfront Walk, Singapore 098585</p>

                            <h5>Operating Hours: </h5>
                            <p>Daily : 1000hrs to 2200hrs</p>
                        </div>

                        <button class="accordion">Fatdonald's @ T4</button>
                        <div class="panel">
                            <h4>Location: </h4>
                            <p>10 Airport Blvd, Terminal 4, Singapore 819665</p>

                            <h5>Operating Hours: </h5>
                            <p>Daily : 0900hrs to 2100hrs</p>
                        </div>
                        <button class="accordion">Fresh @ SG</button>
                        <div class="panel">
                            <h4>Location: </h4>
                            <p>80 Mandai Lake Rd, 729826</p>

                            <h5>Operating Hours: </h5>
                            <p>Daily : 0830hrs to 1800hrs</p>
                        </div>
                    </div>
                    </div>
<!--                </div>-->

<!--                <div class="row">-->
                    <div class='col-span-8 col-xs-8 col-sm-8'>
                        <div class="card-img-top">
                            <div id="map"></div>
                        </div>
                    </div>
                </div> 
            </div>
        </main>
    </body>
</html>