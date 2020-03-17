<!DOCTYPE html>
    <?php include "incl/header.inc.php"; ?>
    <body data-spy="scroll" data-target="#navbar-menu" data-offset="100">

        <?php
            include "incl/nav.inc.php";
        ?>
        
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="banner">
                            <h3>-welcome to-</h3>
                            <h1>FATDONALDS</h1>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-2 ">
                        <div class="banner_logo">
                            <img src="../images/logo2.png" alt="" style="height: auto; width: auto;"/>
                        </div>
                    </div>
                </div>
            </div>
        </header>

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