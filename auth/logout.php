  
<?php
session_start();
logout();
function logout() {
    session_destroy();
    unset($_SESSION['user']);
    unset($_SESSION['admin']);
    header("location: /login.php");
}
?>