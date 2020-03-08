<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
    authenticateUser();
    function authenticateUser() {
        $email = $_POST["email"];
        $pwd = $_POST["pwd"];
        $success = true;
        
        $conn = dbconnect();
        
        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            die($errorMsg);
            $success = false;
        } else {
            $sql = "SELECT * FROM users WHERE ";
            $sql .= "email='$email'";
            
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
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
            $result->free_result();
        }
        
        $conn->close();
        
        if($success === true) {
            $_SESSION["fname"] = $fname;
            $_SESSION["lname"] = $lname;
            $_SESSION["user"] = true;
            $_SESSION["admin"] = false;

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