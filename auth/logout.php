  
<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 

    session_destroy();
    unset($_SESSION['user']);
    unset($_SESSION['admin']);
    header("location: /login.php");
?>