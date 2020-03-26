<!--  
    Project : Fatdonald's
    File: auth.php
    Authors: Joshua  
-->


<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    function dbconnect() {
        $config = parse_ini_file($_SERVER['DOCUMENT_ROOT']."/../private/db-config.ini");
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
    
    function checkpassword($pwd1, $pwd2) {
        if ($pwd1 === $pwd2) {
            return true;
        } else {
            return false;
        }
    }
?>