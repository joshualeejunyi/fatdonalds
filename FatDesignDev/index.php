<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title>Fatdonalds</title>
        
        <!-- Mobile Specific Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        
        <!-- Stylesheets -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
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

        <!-- Block Content -->
        <section id="block">
            <div class="container">

                <!-- First section -->
                <!-- Carousel -->
                <div id="carousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel" data-slide-to="1"></li>
                        <li data-target="#carousel" data-slide-to="2"></li>
                    </ol>

                    <!-- carousel inner -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="images/cheeseburger.jpg" alt="Burger">

                            <div class="carousel-caption">
                                <h2>Fat Sugar</h2>
                                <h3>Daily dose of diabetes</h3>

                                <p>Our world renowned Chef makes this over-the-top, Caramelized burger with two juicy stacked patties, thick-cut bacon, kimchi and a spicy homemade sauce.</p>

                            </div>
                        </div>
                        <div class="item">
                            <img src="images/cheeseburger.jpg" alt="Burger">

                            <div class="carousel-caption">
                                <h2>Fat Sugar</h2>
                                <h3>Daily dose of diabetes</h3>

                                <p>Our world renowned Chef makes this over-the-top, Caramelized burger with two juicy stacked patties, thick-cut bacon, kimchi and a spicy homemade sauce.</p>

                            </div>
                        </div>
                        <div class="item">
                            <img src="images/cheeseburger.jpg" alt="Burger">

                            <div class="carousel-caption">
                                <h2>Fat Sugar</h2>
                                <h3>Daily dose of diabetes</h3>

                                <p>Our world renowned Chef makes this over-the-top, Caramelized burger with two juicy stacked patties, thick-cut bacon, kimchi and a spicy homemade sauce.</p>

                            </div>
                        </div>
                    </div><!-- carousel inner end -->
                </div><!-- Carousel end-->

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
        <script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>		
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        
        <!--main js-->
        <script type="text/javascript" src="js/main.js"></script>
    </body>	
</html>	