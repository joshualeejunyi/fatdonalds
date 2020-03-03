<?php
    
include('auth/authfunctions.php');

if (!isLoggedIn()) {
    $_SESSION['msg'] = "You Must Login First";
    header('location: /login.php');
}
?>