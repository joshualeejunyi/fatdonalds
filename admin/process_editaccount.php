<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
    include($_SERVER['DOCUMENT_ROOT'].'/admin/admin.php');

    if ($_SESSION['admin'] !== true) {
        header('HTTP/1.0 404 not found'); 
        include($_SERVER['DOCUMENT_ROOT'].'/auth/404.html');
    } else {
        $email = sanitize_input($_POST['email']);
        $username = sanitize_input($_POST['username']);
        $fname = sanitize_input($_POST['fname']);
        $lname = sanitize_input($_POST['lname']);
        $usertype = sanitize_input($_POST['usertype']);

        try {
            $conn = dbconnect();

            $stmt = $conn->prepare("UPDATE users SET email = ?, username = ?, firstname = ?, lastname = ?, usertype = ? WHERE email = ?");
            $stmt->execute([$email, $username, $fname, $lname, $usertype, $email]);

        } catch (PDOException $e) {
            $errorMsg = "Error: " . $e;
            $_SESSION['editaccerror'] = $errorMsg;
            header('location: /admin/editaccount.php?id='.$username);
        } finally {
            $stmt = null;
            $conn = null;
        }
        $_SESSION['editaccmsg'] = "Account Updated Successfully";
        header('location: /admin/editaccount.php?id='.$username);
    }
?>