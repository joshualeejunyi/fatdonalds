<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');

    if ($_SESSION['admin'] != true) {
        header('HTTP/1.0 404 not found'); 
        include($_SERVER['DOCUMENT_ROOT'].'/auth/404.html');
    } else {
        if(isset($_GET['email'])) {
            $email = $_GET['email'];

            $conn = dbconnect();
            if ($conn->connect_error) {
                die($conn->connect_errno);
            } else {
                $sql = "DELETE FROM users WHERE email = '$email'";
                if ($conn->query($sql) === true) {
                    $_SESSION['msg'] = "Email Deleted Successfully";
                    header('location: /admin/accounts.php');
                } else {
                    $_SESSION['error'] = $errorMsg;
                    header('location: /admin/accounts.php');
                }
            }
            $conn->close();
        }
    }
?>