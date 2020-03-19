<?php
include($_SERVER['DOCUMENT_ROOT'] . '/auth/auth.php');
?>
<!DOCTYPE html>
<html>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/incl/head.inc.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/incl/nav.inc.php');
    ?>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuzdwZdjHBM2Pm9_0UPI3jiz7c2qIrs2M&callback=initMap"></script>
    <script defer src="/js/locate.js"></script>   
    <body>
        
        <header>
            <div class="row">
                <div class="col">
                    <div class="banner">
                        <h1>Locate Us!</h1>
                    </div>
                </div>
            </div>
        </header>
        <main class='container'>
            <div class="card locate-card">
                <div class="card-header text-center text-white bg-dark ">
                    <h2 class="card-title">
                        Our Locations
                    </h2>
                </div>
                <div class="row">
                    
                    <div class='col-span-4 col-xs-4 col-sm-4'>
                        <input class="form-control" id="anythingSearch" type="text" placeholder="Type to search page: ">
                        <section class="panel panel-default">
                            <div class="panel-body">
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default" id="collapseOne_container">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="card-header">
                                                <a role="button" 
                                                   data-toggle="collapse" 
                                                   data-parent="#accordion" 
                                                   href="#collapseOne" 
                                                   aria-expanded="true" 
                                                   aria-controls="collapseOne">
                                                    <i class="btn-link" aria-hidden="true"></i>FatDonald's @ NYP
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse  collapse in" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="card-body">
                                                <h4>Location: </h4>
                                                <p>180 Ang Mo Kio Ave 8, Singapore 569830</p>

                                                <h5>Operating Hours: </h5>
                                                <p>Daily : 0800hrs to 0800hrs</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default" id="collapseTwo_Container">
                                        <div class="panel-heading" role="tab" id="headingTwo">
                                            <h4 class="card-header">
                                                <a class="collapsed" 
                                                   role="button" 
                                                   data-toggle="collapse" 
                                                   data-parent="#accordion" 
                                                   href="#collapseTwo" 
                                                   aria-expanded="false" 
                                                   aria-controls="collapseTwo">
                                                    <i class="fa fa-paw fa-fw" aria-hidden="true"></i>FatDonald's @ SAFRA Jurong
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                                            <div class="card-body">
                                                <h4>Location: </h4>
                                                <p>333 Boon Lay Way, Singapore 649848</p>

                                                <h5>Operating Hours: </h5>
                                                <p>Daily : 0900hrs to 2100hrs</p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="panel panel-default" id="collapseThree_Container">
                                        <div class="panel-heading" role="tab" id="headingThree">
                                            <h4 class="card-header">
                                                <a class="collapsed" 
                                                   role="button" 
                                                   data-toggle="collapse" 
                                                   data-parent="#accordion" 
                                                   href="#collapseThree" 
                                                   aria-expanded="false" 
                                                   aria-controls="collapseThree">
                                                    <i class="fa fa-paw fa-fw" aria-hidden="true"></i>FatDonald's @ Vivo
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                                            <div class="card-body">
                                                <h4>Location: </h4>
                                                <p>1 Harbourfront Walk, Singapore 098585</p>

                                                <h5>Operating Hours: </h5>
                                                <p>Daily : 1000hrs to 2200hrs</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-default" id="collapseFour_Container">
                                        <div class="card-header" role="tab" id="headingFour">
                                            <h4 class="panel-title">
                                                <a class="collapsed" 
                                                   role="button" 
                                                   data-toggle="collapse" 
                                                   data-parent="#accordion" 
                                                   href="#collapseFour" 
                                                   aria-expanded="false" 
                                                   aria-controls="collapseFour">
                                                    <i class="fa fa-paw fa-fw" aria-hidden="true"></i>FatDonald's @ T4
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseFour" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFour">
                                            <div class="card-body">
                                                <h4>Location: </h4>
                                                <p>10 Airport Blvd, Terminal 4, Singapore 819665</p>

                                                <h5>Operating Hours: </h5>
                                                <p>Daily : 0900hrs to 2100hrs</p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="panel panel-default" id="collapseFive_Container">
                                        <div class="panel-heading" role="tab" id="headingFive">
                                            <h4 class="card-header">
                                                <a class="collapsed" 
                                                   role="button" 
                                                   data-toggle="collapse" 
                                                   data-parent="#accordion" 
                                                   href="#collapseFive" 
                                                   aria-expanded="false" 
                                                   aria-controls="collapseFive">
                                                    <i class="fa fa-paw fa-fw" aria-hidden="true"></i>Fresh @ SG
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseFive" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFive">
                                            <div class="card-body">
                                                <h4>Location: </h4>
                                                <p>80 Mandai Lake Rd, 729826</p>

                                                <h5>Operating Hours: </h5>
                                                <p>Daily : 0830hrs to 1800hrs</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div> 
                    </div>
                    <div class='col-span-8 col-xs-8 col-sm-8'>
                        <div class="card-img-top">
                            <div id="map"></div>
                        </div>
                    </div>
                    
                </div> 
            </div>
        </main>
        <?php
        include($_SERVER['DOCUMENT_ROOT'].'/incl/footer.inc.php');
        ?>
    </body>
</html>
