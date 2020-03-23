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
    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/incl/head.inc.php');
    ?>
    <body data-spy="scroll" data-target="#navbar-menu" data-offset="100">
        <?php
            include($_SERVER['DOCUMENT_ROOT'].'/incl/nav.inc.php');
        ?>
        <main class="container">
            <section class="card formcard">
                <h2>TITLE HEADING</h2>
                  <h5>Title description, Dec 7, 2017</h5>
                  <div class="fakeimg" style="height:200px;">Image</div>
                  <p>Some text..</p>
                </div>
            </section>
        </main>
    </body>
    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/incl/footer.inc.php');
    ?>
</html>