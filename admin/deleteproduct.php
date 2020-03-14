<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');

    if ($_SESSION['admin'] != true) {
        header('HTTP/1.0 404 not found'); 
        include($_SERVER['DOCUMENT_ROOT'].'/auth/404.html');
    } else {
        if(isset($_GET['id'])) {
            $productID = $_GET['id'];

            $conn = dbconnect();
            if ($conn->connect_error) {
                die($conn->connect_errno);
            } else {
                $sql = "DELETE FROM products WHERE productid = '$productID'";
                if ($conn->query($sql) === true) {
                    $_SESSION['msg'] = "Product Deleted Successfully";
                    header('location: /admin/upload.php');
                } else {
                    $_SESSION['error'] = $errorMsg;
                    header('location: /admin/upload.php');
                }
            }
            $conn->close();
        }
    }
?>