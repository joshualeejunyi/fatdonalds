<!--  
    Project : Fatdonald's
    File: process_news.php
    Authors: Jeffrey, Joshua  
-->


<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
    include($_SERVER['DOCUMENT_ROOT'].'/admin/admin.php');

    unset($_SESSION['editnewserror']);
    unset($_SESSION['editnewsmsg']);

    if ($_SESSION['admin'] !== true) {
        header('HTTP/1.0 404 not found'); 
        include($_SERVER['DOCUMENT_ROOT'].'/auth/404.html');
    } else {
        $newstitle = sanitize_input($_POST['newstitle']);
        $newstext = sanitize_input($_POST['newstext']);
        $createdts = sanitize_input($_POST['created']);
        $ts = date('Y-m-d H:i:s');
        $email = $_SESSION['email'];

        if(isset($_POST['published'])) {
            $published = 1;
        } else {
            $published = 0;
        }

        

        try {
            $conn = dbconnect();
            $stmt = $conn->prepare("INSERT INTO news (postedBy, title, text, created_timestamp, published) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$email, $newstitle, $newstext, $ts, $published]);
            $_SESSION['newsmsg'] = "Post Created Successfully";
            header('location: /admin/news.php');
        } catch (PDOException $e) {
            $errorMsg = "Error: " . $e;
            $_SESSION['newserror'] = $errorMsg;
            header('location: /admin/news.php');
        } finally {
            $stmt = null;
            $conn = null;
            
        }
        
    }
?>