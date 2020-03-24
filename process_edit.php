<?php
//    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
//    include($_SERVER['DOCUMENT_ROOT'].'/admin/admin.php');
//
//    if ($_SESSION['admin'] !== true) {
//        header('HTTP/1.0 404 not found'); 
//        include($_SERVER['DOCUMENT_ROOT'].'/auth/404.html');
//    } else {
        $title = sanitize_input($_POST['title']);
        $editedBy = sanitize_input($_POST['editedBy']);
        $text = sanitize_input($_POST['text']);

        if(isset($_POST['display'])) {
            $display = 1;
        } else {
            $display = 0;
        }

        $config = parse_ini_file('../../private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'],$config['password'], $config['dbname']);

        //Check Connection.
        if ($conn->connect_error){
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;  
        }
        else {
            $stmt = $conn->prepare("UPDATE fat_news_post SET title = ?, editedBy = ?, text = ?, display = ?, edited_timestamp = ? WHERE newsID = ?");
            $stmt->execute([$title, $editedBy, $text, $display, $edited_timestamp]);
        }
        $_SESSION['editnewsmsg'] = "Post Updated Successfully";
?>