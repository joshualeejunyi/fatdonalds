<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
    include($_SERVER['DOCUMENT_ROOT'].'/admin/admin.php');



    unset($_SESSION['msg']);
    unset($_SESSION['error']);
    
    if ($_SESSION['admin'] != true) {
        header('HTTP/1.0 404 not found'); 
        include($_SERVER['DOCUMENT_ROOT'].'/auth/404.html');
    } else {
        $prodname = sanitize_input($_POST['productname']);
        $prodcat = sanitize_input($_POST['productcat']);
        $proddesc = sanitize_input($_POST['productdesc']);

        $check = processImage($_FILES["imagefile"]);

        if ($check === true) {
            $conn = dbconnect();
            if ($conn->connect_error) {
                die($conn->connect_errno);
            } else {
                $imagetmp=addslashes(file_get_contents($_FILES['imagefile']['tmp_name']));
                $sql = "INSERT INTO products (productName, productCategory, productDesc, productIMG) VALUES ('$prodname', '$prodcat', '$proddesc', '$imagetmp')";

                if (!$conn->query($sql)) {
                    $errorMsg = "Database error: " . $conn->error;
                    $_SESSION['error'] = $errorMsg;
                    header('location: /admin/upload.php');
                } else {
                    $_SESSION['msg'] = "Product Uploaded Successfully";
                    header('location: /admin/upload.php');
                }
    
                $conn->close();
            }
        }
    }

?>