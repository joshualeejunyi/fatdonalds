<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
    include($_SERVER['DOCUMENT_ROOT'].'/admin/admin.php');



    unset($_SESSION['msg']);
    unset($_SESSION['error']);
    
    if ($_SESSION['admin'] != true) {
        header('HTTP/1.0 404 not found'); 
        include($_SERVER['DOCUMENT_ROOT'].'/auth/404.html');
    } else {
        $prodid = sanitize_input($_POST['productid']);
        $prodname = sanitize_input($_POST['productname']);
        $prodcat = sanitize_input($_POST['productcat']);
        $proddesc = sanitize_input($_POST['productdesc']);
        $nofile = false;

        if ($_FILES["imagefile"]["error"] !== 4) {
            $check = processImage($_FILES["imagefile"]);
            $nofile = false;
        } else {
            $nofile = true;
            $check = true;
        }

        if ($check !== false) {
            $conn = dbconnect();
            if ($conn->connect_error) {
                die($conn->connect_errno);
            } else {
                if ($nofile === true) {
                    $sql = "UPDATE products SET productName = '$prodname', productCategory = '$prodcat', productDesc = '$proddesc' WHERE productID = " . $prodid;
                } else {
                    $imagetmp=addslashes(file_get_contents($_FILES['imagefile']['tmp_name']));
                    $sql = "UPDATE products SET productName = '$prodname', productCategory = '$prodcat', productDesc = '$proddesc', productIMG = '$imagetmp' WHERE productID = " . $prodid;
                }

                if (!$conn->query($sql)) {
                    $errorMsg = "Database error: " . $conn->error;
                    $_SESSION['error'] = $errorMsg;
                    header('location: /admin/editproduct.php?id='.$prodid);
                } else {
                    $_SESSION['msg'] = "Product Updated Successfully";
                    header('location: /admin/editproduct.php?id='.$prodid);
                }
    
                $conn->close();
            }
        }
    }
?>