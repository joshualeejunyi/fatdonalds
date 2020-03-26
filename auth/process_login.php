<!--  
    Project : Fatdonald's
    File: process_login.php
    Authors: Joshua  
-->

<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
    authenticateUser();
    function authenticateUser() {
        $email = $_POST["email"];
        $pwd = $_POST["pwd"];
        $success = true;

        try {
            $conn = dbconnect();
            
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch();
                $fname = $row["firstname"];
                $email = $row["email"];
                $lname = $row["lastname"];
                $username = $row["username"];
                $password = $row["password"];
                $user = $row["usertype"];

                if (!password_verify($pwd, $password)) {
                    $errorMsg = "Email not found or password doesn't match.";
                    $_SESSION['loginerr'] = $errorMsg;
                    $success = false;
                }

            } else {
                $errorMsg = "Email not found or password doesn't match.";
                $_SESSION['loginerr'] = $errorMsg;
                $success = false;
            }
        } catch (PDOException $e) {
            $errorMsg = "Connection to Server Failed";
            $_SESSION['loginerr'] = $errorMsg;
            $success = false;
        } finally {
            $stmt = null;
            $conn = null;
        }

        if($success === true) {
            // $_SESSION["fname"] = $fname;
            // $_SESSION["lname"] = $lname;
            $_SESSION["user"] = true;
            $_SESSION["admin"] = false;
            $_SESSION["username"] = $username;
            $_SESSION["email"] = $email;

            if ($user === "customer") {
                header('location: /deliver.php');
            } else if ($user === "admin") {
                $_SESSION["admin"] = true;
                header('location: /admin/products.php');
            }
        } else {
            header('location: /login.php');
        }
    }
?>