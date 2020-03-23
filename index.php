<?php  
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');

    if (isset($_SESSION["admin"])) {
        if ($_SESSION["admin"] === true) {
            header('location: /admin/products.php');
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
    <script defer src="/js/slide.js"></script>
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
                        <h3>-welcome to-</h3>
                        <h1>FATDONALDS</h1>
                    </div>
                </div>
            </div>
        </header>
        
        <main class="container">

            <div id="carousel" class="carousel slide" data-ride="carousel">
                <ul class="carousel-indicators">
                    <li data-target="#carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel" data-slide-to="1"></li>
                    <li data-target="#carousel" data-slide-to="2"></li>
                </ul>
            
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="images/s1.jpg" class="carousel-img" alt="Triple Burger">
                    </div>
                    <div class="carousel-item">
                        <img src="images/s2.jpg" class="carousel-img" alt="Burger & Fries">
                    </div>
                    <div class="carousel-item">
                        <img src="images/s3.jpg" class="carousel-img" alt="Special Burger & Fries">
                    </div>
                </div>

                <a class="carousel-control-prev" href="#carousel" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#carousel" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>

            <div class="row second_sec">
                <article class="col-sm-6">
                    <a href="/menu.php">
                        <div class="menu">
                            <div class="inner_content">
                                <span class="flaticon flaticon-fast-food"></span>
                                <h2>menu</h2>
                            </div>
                        </div>
                    </a>
                </article>
                <article class="col-sm-6">
                    <a href="/news.php">
                        <div class="news">
                            <div class="inner_content">
                                <span class="flaticon flaticon-newspaper"></span>
                                <h2>news</h2>
                            </div>
                        </div>
                    </a>
                </article>
            </div>
        </main>
        <?php
        include($_SERVER['DOCUMENT_ROOT'].'/incl/footer.inc.php');
        ?>
    </body>
</html>