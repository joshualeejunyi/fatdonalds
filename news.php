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
                <h2>TITLE HEADING</h2>
                  <h5>Title description, Dec 7, 2017</h5>
                  <div class="fakeimg" style="height:200px;">Image</div>
                  <p>Some text..</p>
                </div>
            </div>
        </main>
    </body>
</html>
