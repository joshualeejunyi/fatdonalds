<!--  
    Project : Fatdonald's
    File: process_reset.php
    Authors: Joshua  
-->

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
    include($_SERVER['DOCUMENT_ROOT'].'/admin/admin.php');

    if ($_SESSION['admin'] !== true) {
        header('HTTP/1.0 404 not found'); 
        include($_SERVER['DOCUMENT_ROOT'].'/auth/404.html');
    } else {
        $email = sanitize_input($_POST['email']);
        $username = sanitize_input($_POST['username']);

        if (!checkpassword($_POST["pwd"], $_POST["pwd_confirm"])) {
            $errorMsg .= "Passwords are not the same. <br>";
            $success = false;
            $_SESSION['passerror'] = $errorMsg;
            header('location: /admin/resetpassword.php?id='.$username);
        } else {
            $password = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
        }

        try {
            $conn = dbconnect();

            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
            $stmt->execute([$password, $email]);

        } catch (PDOException $e) {
            $errorMsg = "Error: " . $e;
            $_SESSION['passerror'] = $errorMsg;
            header('location: /admin/resetpassword.php?id='.$username);
        } finally {
            $stmt = null;
            $conn = null;
        }
        $_SESSION['passmsg'] = "Password Reset Successfully";
        header('location: /admin/resetpassword.php?id='.$username);
    }
?>