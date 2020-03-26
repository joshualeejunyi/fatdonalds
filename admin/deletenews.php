<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');

    if ($_SESSION['admin'] !== true) {
        header('HTTP/1.0 404 not found'); 
        include($_SERVER['DOCUMENT_ROOT'].'/auth/404.html');
    } else {
        if(isset($_GET['id'])) {
            $newsID = $_GET['id'];

            try {
                $conn = dbconnect();
                $stmt = $conn->prepare("DELETE FROM news WHERE newsID = ?");
                $stmt->execute([$newsID]);
                unset($_SESSION['error']);
                $_SESSION['delmsg'] = "Post Deleted Successfully";
                header('location: /admin/news.php');
    
            } catch (PDOException $e) {
                $errorMsg = "Connection failed: " . $e->getMessage();
                $_SESSION['delerror'] = $errorMsg;
                header('location: /admin/news.php');
            } finally {
                $stmt = null;
                $conn = null;
            }
        } else {
            $errorMsg = "ID Not Set";
            $_SESSION['delerror'] = $errorMsg;
            header('location: /admin/news.php');
        }
    }
?>