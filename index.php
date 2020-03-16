<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title>FatDonalds</title>
        
        <!-- Mobile Specific Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        
        <!-- Stylesheets -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="fonts/flaticon.css" />

        <!-- Custom stylesheet -->
        <link rel="stylesheet" href="css/custom.css" />
        
    </head>
    <body data-spy="scroll" data-target="#navbar-menu" data-offset="100">

        <?php
            include "incl/nav.inc.php";
        ?>
        
        <?php
            include "incl/header.inc.php";
        ?>  

        <br />
        
        <!-- Block Content -->
        <section id="block">
            <div class="container">
                <?php
                    include "slideshow.php";
                ?>
                <br />
                <?php
                    include "slideshow.php";
                ?>
                <!-- Second section -->
                <div class="row second_sec">
                    <div class="col-sm-6">
                        <div class="menu">
                            <div class="inner_content">
                                <span class="flaticon flaticon-fast-food"></span>
                                <h2>menu</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="news">
                            <div class="inner_content">
                                <span class="flaticon flaticon-newspaper"></span>
                                <h2>news</h2>
                            </div>
                        </div>
                    </div>
                </div><!-- second section end -->
            </div>
        </section><!-- Block Content end-->


        <?php
        include 'incl/footer.inc.php';
        ?>

        <!-- scroll up-->
        <div class="scrollup">
            <a href="#"><i class="fa fa-chevron-up"></i></a>
        </div><!-- End off scroll up->

        <!-- JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>		
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

        
        <!--main js-->
        <script type="text/javascript" src="js/main.js"></script>
    </body>	
</html>	