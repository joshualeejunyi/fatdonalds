<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
    include($_SERVER['DOCUMENT_ROOT'].'/admin/admin.php');

    if ($_SESSION['admin'] !== true) {
        header('HTTP/1.0 404 not found'); 
        include($_SERVER['DOCUMENT_ROOT'].'/auth/404.html');
    } else {
        $prodname = sanitize_input($_POST['productname']);
        $prodcat = sanitize_input($_POST['productcat']);
        $proddesc = sanitize_input($_POST['productdesc']);

        $check = processImage($_FILES["imagefile"]);

        if ($check === true) {
            try {
                $conn = dbconnect();
                $imagedata = file_get_contents($_FILES['imagefile']['tmp_name']);
                $stmt = $conn->prepare("INSERT INTO products (name, category, description, productimage) VALUES (?, ?, ?, ?)");
                $stmt->execute([$prodname, $prodcat, $proddesc, $imagedata]);
                
            } catch (PDOException $e) {
                $errorMsg = "Product Not Found: " . $e;
                $_SESSION['error'] = $errorMsg;
                header('location: /admin/upload.php');
            } finally {
                $conn = null;
                $stmt = null;
            }
            $_SESSION['uploadmsg'] = "Product Uploaded Successfully";
            header('location: /admin/upload.php');
        }
    }
?>