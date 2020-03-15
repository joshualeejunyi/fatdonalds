<?php
    session_start();
    if (isset($_POST['usernameCheck'])) {
        $uname = $_POST['username'];
        formCheck('username', $uname);
        
    }
    
    function formCheck($type, $var) {
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

?>