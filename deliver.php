<?php  
    include('auth/auth.php');

    if (!isLoggedIn()) {
        $_SESSION['msg'] = "Please Login to Proceed";
        header('location: /login.php');
    }
?>