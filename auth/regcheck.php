<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');

    if (isset($_POST['usernameCheck'])) {
        $uname = $_POST['username'];
        formCheck('username', $uname);
    }

    if (isset($_POST['emailCheck'])) {
        $emailcheck = $_POST['email'];
        formCheck('email', $emailcheck);
    }
    function formCheck($type, $var) {
        if ($type === 'username') {
            $sql = "SELECT * from users WHERE username = ?";
        } else if ($type === 'email') {
            $sql = "SELECT * from users WHERE email = ?";
        }

        try {
            $conn = dbconnect();
            print_r($conn);
            $stmt = $conn->prepare($sql);
            $stmt->execute([$var]);

            if ($stmt->rowCount() > 0) {
                echo "taken";
            } else {
                echo "notTaken";
            }

        } catch (PDOException $e) {
            $errorMsg = "Connection failed: " . $e->getMessage();
            $_SESSION['msg'] = $errorMsg;
            print_r($errorMsg);
        } finally {
            $stmt = null;
            $conn = null;
        }
    }
?>