<?php
    function getCategories() {
        $conn = dbconnect();

        if ($conn->connect_error) {
            die($conn->connect_errno);
        } else {
            $sql = "SELECT DISTINCT productCategory from fatdonalds.products;";
            if (!$conn->query($sql)) {
                $errorMsg = "Database error: " . $conn->error;
                $_SESSION['error'] = $errorMsg;
                header('location: /admin/products.php');
            } else {

            }

            $conn->close();
        }
    }
    
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function processImage($image) {
        $target_file = $target_dir . basename($image["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $check = getimagesize($image["tmp_name"]);
        if($check === false) {
            $errorMsg .= "File is not an image";
            $_SESSION['error'] = $errorMsg;
            header('location: /admin/upload.php');
            print_r($errorMsg);
            die();
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            header('location: /admin/upload.php');
            print_r("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            die();
        }

        return true;
    }
?>