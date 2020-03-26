<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
    include($_SERVER['DOCUMENT_ROOT'].'/admin/admin.php');

    unset($_SESSION['editnewserror']);
    unset($_SESSION['editnewsmsg']);

    if ($_SESSION['admin'] !== true) {
        header('HTTP/1.0 404 not found'); 
        include($_SERVER['DOCUMENT_ROOT'].'/auth/404.html');
    } else {
        $newsid = sanitize_input($_POST['newsid']);
        $newstitle = sanitize_input($_POST['newstitle']);
        $newstext = sanitize_input($_POST['newstext']);
        $createdts = sanitize_input($_POST['created']);
        $editedts = date('Y-m-d H:i:s');

        if(isset($_POST['published'])) {
            $published = 1;
        } else {
            $published = 0;
        }

        

        try {
            $conn = dbconnect();

            $stmt = $conn->prepare("UPDATE news SET newsID = ?, title = ?, text = ?, edited_timestamp = ?, published = ? WHERE newsID = ?");
            $stmt->execute([$newsid, $newstitle, $newstext, $editedts, $published, $newsid]);
            $_SESSION['editnewsmsg'] = "Account Updated Successfully";
            header('location: /admin/editnews.php?id='.$newsid);
        } catch (PDOException $e) {
            $errorMsg = "Error: " . $e;
            $_SESSION['editnewserror'] = $errorMsg;
            header('location: /admin/editnews.php?id='.$newsid);
        } finally {
            $stmt = null;
            $conn = null;
            
        }
        
    }
?>