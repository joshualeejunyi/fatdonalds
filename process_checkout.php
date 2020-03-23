<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
    include($_SERVER['DOCUMENT_ROOT'].'/admin/admin.php');

    if (isset($_SESSION['cartLog'])) {
        if (!empty($_SESSION['cartLog'])) {
            $total_price = $_SESSION["totalprice"];
            

            $phone = $_POST['phone'];
            $address = $_POST['address'];

            $email = $_SESSION['email'];
            $dt = date('Y-m-d H:i:s');

            try {
                $conn = dbconnect();
                $stmt = $conn->prepare("INSERT INTO orders (user, timestamp, amount, phonenumber, address) VALUES (?, ?, ?, ?, ?)");
                $result = $stmt->execute([$email, $dt, $total_price, $phone, $address]);
                $insertid = $conn->lastInsertId();

                foreach ($_SESSION['cartLog'] as $id => $products) {
                    $orderstmt = $conn->prepare("INSERT INTO orderInfo (orderID, productID, quantity) VALUES (?, ?, ?)");
                    
                    $productID = $products['productID'];
                    $quantity = $products['quantity'];
                    $result = $orderstmt->execute([$insertid, $productID, $quantity]);
                }


                
            } catch (PDOException $e) {
                $errorMsg = "Connection to Server Failed.";
                $_SESSION['ordererr'] = $e;
                header('location: /orders.php');

            } finally {
                $conn = null;
                $stmt = null;
                $orderstmt = null;
                unset($_SESSION['cartLog']);
                header('location: /orders.php');
            }

        }
    }

