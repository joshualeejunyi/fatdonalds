<!DOCTYPE html>
    <?php include "incl/header.inc.php"; ?>

    <body data-spy="scroll" data-target="#navbar-menu" data-offset="100">

        <?php include "incl/nav.inc.php"; ?>
        
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-md-offset-2">
                        <h1>FatNews</h1>
                    </div>
                </div>
            </div>
        </header>
        
        <br />
        
        <!-- Block Content -->
        <section id="block">
            <div class="container">
                <!-- Blog section -->
                <div class="card">
                  <h2>TITLE HEADING</h2>
                  <h5>Title description, Dec 7, 2017</h5>
                  <div class="fakeimg" style="height:200px;">Image</div>
                  <p>Some text..</p>
                </div>
                <br />
                <div class="card">
                  <h2>TITLE HEADING</h2>
                  <h5>Title description, Sep 2, 2017</h5>
                  <div class="fakeimg" style="height:200px;">Image</div>
                  <p>Some text..</p>
                </div><!-- second section end -->
                <br />
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