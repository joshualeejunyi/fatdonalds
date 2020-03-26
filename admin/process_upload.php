<!--  
    Project : Fatdonald's
    File: process_upload.php
    Authors: Joshua  
-->


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
        $prodprice = sanitize_input($_POST['productprice']);

        if(isset($_POST['promo'])) {
            $promo = 1;
            $promoprice = sanitize_input($_POST['promoprice']);
        } else {
            $promo = 0;
            $promoprice = 0;
        }


        $check = processImage($_FILES["imagefile"]);

        if ($check === true) {
            try {
                $conn = dbconnect();
                $imagedata = file_get_contents($_FILES['imagefile']['tmp_name']);
                $stmt = $conn->prepare("INSERT INTO products (name, category, price, description, promo, promoprice, productimage) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$prodname, $prodcat, $prodprice, $proddesc, $promo, $promoprice, $imagedata]);
                
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