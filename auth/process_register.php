<?php
    phpinfo();
    include($_SERVER['DOCUMENT_ROOT'].'/incl/head.inc.php');
    include($_SERVER['DOCUMENT_ROOT'].'/incl/nav.inc.php');

    $email = $errorMsg = "";
    $success = true;
    $agreevar = false;
    
    $fields = array("fname" => "First Name", "lname" => "Last Name", "email" => "Email", "username" => "Username", "pwd" => "Password", "pwd_confirm" => "Confirm Password");
    $dbfields = [];
    
    if (!checkpassword($_POST["pwd"], $_POST["pwd_confirm"])) {
        $errorMsg .= "Passwords are not the same. <br>";
        $success = false;
    }
    
    foreach($_POST as $key=>$value) {
        if ($key != "fname") {
            if (empty($value)) {
                print_r($key);
                $errorMsg .= $fields[$key] . " is required.<br>";
                $success = false;
            } else {
                if ($key != "pwd_confirm" && $key != "agree" && $key != "pwd") {
                    $dbfields[$key] = $value;
                }
                if ($key == "pwd") {
                    $dbfields[$key] = password_hash($value, PASSWORD_DEFAULT);
                }
            }
        } else {
            $dbfields[$key] = $value;
        }
        
        $value = sanitize_input($value);
        
        if ($key == "email") {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errorMsg .= "Invalid Email Format. <br>";
                $success = false;
            } else {
                $email = $value;
            }
        }
    }
    
    if (!isset($_POST["agree"])) {
        $errorMsg .= "Terms and Conditions not Checked. <br>";
        $success = false;
    }

    if ($success){
        $dbresult = saveMemberToDB();

        print_r($dbresult);

        if ($dbresult) {
            echo "<div class='jumbotron text-center'>";
            echo "<h4 class='display-4'>Registration Successful!</h4>";
            echo "<p><b>Email: " . $email ."</b>";
            echo "</div>";
        }
        
    } else {
        echo "<div class='jumbotron text-center'>";
        echo "<h4 class='display-4'>RIP :( </h4>";
        echo "<h5>The following errors were detected:</h5>";
        echo "<p class='display-5'><b>" . $errorMsg . "</b></p>";
    }
    
    function checkpassword($pwd1, $pwd2) {
        if ($pwd1 === $pwd2) {
            return true;
        } else {
            return false;
        }
    }
    
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    function saveMemberToDB() {
        global $fname, $lname, $email, $pwd, $errorMsg, $success;
        global $dbfields;
        
        $config = parse_ini_file('db.ini');
        $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['schema']);
        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
            die($errorMsg);
        } else {
            // print_r($dbfields);
            // print_r($dbfields["email"]);
            $stmt = $conn->prepare("INSERT INTO users (email, username, password, firstname, lastname, usertype) VALUES (?, ?, ?, ?, ?, ?)");
            print_r($stmt);
            $stmt->bind_param($dbfields["email"], $dbfields["username"], $dbfields["pwd"], $dbfields["fname"], $dbfields["lname"], "customer");
            print($stmt);

            // if(!($stmt->bind_param($dbfields["email"], $dbfields["username"], $dbfields["pwd"], $dbfields["fname"], $dbfields["lname"], "customer"))){
            //     print_r("HELLO");
            //     die( "Error in bind_param: (" .$conn->errno . ") " . $conn->error);
            // } else {
            //     print_r("HELLO");
            // }
            
            // $stmt->bind_param("a", "b", "c", "d", "e", "e");
            // print_r($stmt);
            // print_r($dbfields['email']);
            // $stmt->execute();
            
            if (!$stmt->execute()) {
                $errorMsg = "Database error: " . $conn->error;
                $success = false;
                print_r($errorMsg);
                die($errorMsg);
            } else {
                die("GG");
                print_r("SUCCESS");
            }
            
        }

        $stmt->close();
        $conn->close();

        return $success;
    }
?>