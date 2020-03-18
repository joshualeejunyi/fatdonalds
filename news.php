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
        <main class="container">
            <div class="card formcard">
                <div class="card-header text-center">
                    <h2 class="card-title">
                        About Us
                    </h2>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        FatDonald's, established in 2020, was the answer to...
                    </p>
                </div>
            </div>
        </main>
    </body>
</html>
