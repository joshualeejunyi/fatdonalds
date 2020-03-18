<?php  
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');

    if (isset($_SESSION["admin"])) {
        if ($_SESSION["admin"] === true) {
            header('location: /admin/products.php');
        }
    }

?>
<!DOCTYPE html>
<html>
    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/incl/head.inc.php');
    ?>
    <body data-spy="scroll" data-target="#navbar-menu" data-offset="100">
        <?php
            include($_SERVER['DOCUMENT_ROOT'].'/incl/nav.inc.php');
        ?>


        <header>
            <div class="row">
                <div class="col">
                    <div class="banner">
                        <h1>About Us</h1>
                    </div>
                </div>
            </div>
        </header>
        
        <main class="container">
            <section class="row">
                <div class="card-group">
                    <div class="col-12 col-lg-6 col-xl-3">
                        <div class="card mb-3 h-100 about-card">
                            <div class="card-header text-white bg-dark text-center">
                                <h4>
                                    Our History
                                </h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    Fatdonald's was established in 2020 when a bunch of cyber security students gathered and thought: "What if our careers don't work out?"

                                    <br>

                                    As such, Fatdonald's was born: a satire about how we have been focused too much on our careers and not our health.
                                </p>
                            </div>
                        </div>
                    </div>
                        <div class="col-12 col-lg-6 col-xl-4">
                        <div class="card mb-3 h-100 about-card">
                            <div class="card-header text-white bg-dark text-center">
                                <h4>
                                    Our Vision
                                </h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    We envision a world with 100% healthy people, by giving them food so absurdly fat that they reflect on all their life choices.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-4">
                        <div class="card mb-3 h-100 about-card">
                            <div class="card-header text-white bg-dark text-center">
                                <h4>
                                    Our Mission
                                </h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    To create really good but fattening food.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
