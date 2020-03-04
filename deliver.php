<?php  
    include('auth/auth.php');

    if (!isLoggedIn()) {
        $_SESSION['msg'] = "You Must Login First";
        header('location: /login.php');
    }
?>