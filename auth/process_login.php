<?php
    session_start(); 
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
                $lname = $row["lastname"];
                $password = $row["password"];
                $user = $row["usertype"];

                if (!password_verify($pwd, $password)) {
                    $errorMsg = "Email not found or password doesn't match.";
                    $_SESSION['msg'] = $errorMsg;
                    $success = false;
                }

            } else {
                $errorMsg = "Email not found or password doesn't match.";
                $_SESSION['msg'] = $errorMsg;
                $success = false;
            }
        } catch (PDOException $e) {
            $errorMsg = "Connection failed: " . $e->getMessage();
            $_SESSION['msg'] = $errorMsg;
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
            unset($_SESSION["msg"]);

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