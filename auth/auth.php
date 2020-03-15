<?php
    session_start();

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
            $sql = "SELECT * from users WHERE username='$var'";
        } else if ($type === 'email') {
            $sql = "SELECT * from users WHERE email='$var'";
        }

        $conn = dbconnect();
        if ($conn->connect_error) {
            echo($conn->connect_errno);
        } else {
            $result = $conn->query($sql);
            if (!$result) {
                $errorMsg = "Database error: " . $conn->error;
                return $errorMsg;
            } else {
                $rowCount = $result->num_rows;
                if ($rowCount > 0) {
                    print("taken");
                } else {
                    print("notTaken");
                }
            }
            $conn->close();
            exit();
        }
    }

    function dbconnect() {
//        $config = parse_ini_file('../../private/db-config.ini');
        $config = parse_ini_file($_SERVER['DOCUMENT_ROOT']."../private/db-config.ini");
        $servername = $config['servername'];
        $user = $config['username'];
        $password = $config['password'];
        $schema = $config['schema'];

        $conn = new PDO("mysql:host=$servername;dbname=$schema", $user , $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("use fatdonalds");
        return $conn;
    }

    function isLoggedIn() {
        if (isset($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }

    function logout() {
        session_destroy();
        unset($_SESSION['user']);
        header("location: /login.php");
    }
?>