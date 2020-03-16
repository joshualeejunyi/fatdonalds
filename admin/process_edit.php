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
        $prodprice = sanitize_input($_POST['productprice']);

        if(isset($_POST['promo'])) {
            $promo = 1;
            $promoprice = sanitize_input($_POST['promoprice']);
        } else {
            $promo = 0;
            $promoprice = 0;
        }

        $nofile = false;

        if ($_FILES["imagefile"]["error"] !== 4) {
            $check = processImage($_FILES["imagefile"]);
            $nofile = false;
        } else {
            $nofile = true;
            $check = true;
        }

        if ($check !== false) {
            try {
                $conn = dbconnect();

                if ($nofile === true) {
                    $stmt = $conn->prepare("UPDATE products SET productName = ?, productCategory = ?, productPrice = ?, productDesc = ?, promo = ?, promoPrice = ? WHERE productID = ?");
                    $stmt->execute([$prodname, $prodcat, $prodprice, $proddesc, $promo, $promoprice, $prodid]);
                } else {
                    $imagedata = file_get_contents($_FILES['imagefile']['tmp_name']);
                    $stmt = $conn->prepare("UPDATE products SET productName = ?, productCategory = ?, productPrice = ?, productDesc = ?, promo = ?, promoPrice = ?, productIMG = ? WHERE productID = ?");
                    $stmt->execute([$prodname, $prodcat, $prodprice, $proddesc, $promo, $promoprice, $imagedata, $prodid]);
                }
            } catch (PDOException $e) {
                $errorMsg = "Product Not Found: " . $e;
                $_SESSION['error'] = $errorMsg;
                header('location: /admin/editproduct.php?id='.$prodid);
            } finally {
                $stmt = null;
                $conn = null;
            }
            $_SESSION['msg'] = "Product Updated Successfully";
            header('location: /admin/editproduct.php?id='.$prodid);
        }
    }
?>