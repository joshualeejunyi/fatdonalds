<?php
    include('auth/auth.php');

    if (!isLoggedIn()) {
        $_SESSION['msg'] = "Please Login to Proceed";
        header('location: /login.php');
    }

    if ($_SESSION["admin"] === true) {
        header('location: /admin/products.php');
    }


?>
<!DOCTYPE html>
<html>
    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/incl/head.inc.php');
    ?>
    <body>
        <?php
            include($_SERVER['DOCUMENT_ROOT'].'/incl/nav.inc.php');
        ?>
    </body>
</html>