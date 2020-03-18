<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
    include($_SERVER['DOCUMENT_ROOT'].'/admin/admin.php');

    unset($_SESSION['msg']);
    unset($_SESSION['error']);
    
    if ($_SESSION['admin'] != true) {
        header('HTTP/1.0 404 not found'); 
        include($_SERVER['DOCUMENT_ROOT'].'/auth/404.html');
    } else {
        $oldemail = sanitize_input($_POST['oldemail']);
        $email = sanitize_input($_POST['email']);
        $username = sanitize_input($_POST['username']);
        $password = sanitize_input($_POST['password']);
        $confirm_password = sanitize_input($_POST['confirm_password']);
        $fname = sanitive_input($_POST['fname']);
        $lname = sanitive_input($_POST['lname']);
        $usertype = sanitive_input($_POST['usertype']);

        if (!checkpassword($password,$confirm_password)) {
            $errorMsg .= "Passwords are not the same. <br>";
            $check = false;
    }

        if ($check !== false) {
            try {
                $conn = dbconnect();

                    $stmt = $conn->prepare("UPDATE users SET email = ?, username = ?, password = ?, firstname = ?, lastname = ?, usertype = ? WHERE email = ?");
                    $stmt->execute([$email, $username, $password, $fname, $lname, $usertype, $oldemail]);

            } catch (PDOException $e) {
                $errorMsg = "Account Not Found: " . $e;
                $_SESSION['error'] = $errorMsg;
                header('location: /admin/account.php');
            } finally {
                $stmt = null;
                $conn = null;
            }
            $_SESSION['msg'] = "Account Updated Successfully";
            header('location: /admin/account.php');
        }
    }
        function checkpassword($pwd1, $pwd2) {
        if ($pwd1 === $pwd2) {
            return true;
        } else {
            return false;
        }
    }
?>