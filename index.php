<!DOCTYPE html>
    <?php include "incl/header.inc.php"; ?>

    <body data-spy="scroll" data-target="#navbar-menu" data-offset="100">

        <?php include "incl/nav.inc.php"; ?>
        
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-md-offset-2">
                        <h1>FatDonalds</h1>
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
                  <h1>Admin Page</h1>
                    <button> <a href='admin_create.php'> Create a news </button>
                    <br />
                    <button> <a href='admin_edit.php'> Edit a news </button>
                    <br />
                    <button> <a href='news.php'> View News </button>
                    <br />
                    <button> <a href='admin_delete.php'> Delete News </button>
                </div>
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