<?php  
    include('auth/auth.php');

    if (!isLoggedIn()) {
        $_SESSION['msg'] = "Please Login to Proceed";
        header('location: /login.php');
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