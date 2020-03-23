<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
    include($_SERVER['DOCUMENT_ROOT'].'/admin/admin.php');


    $email = $errorMsg = "";
    $success = true;
    $agreevar = false;

    
    $fields = array("fname" => "First Name", "lname" => "Last Name", "email" => "Email", "username" => "Username", "pwd" => "Password", "pwd_confirm" => "Confirm Password",);
    $dbfields = [];

    
    if (!checkpassword($_POST["pwd"], $_POST["pwd_confirm"])) {
        $errorMsg .= "Passwords are not the same. <br>";
        $success = false;
    }
    
    foreach($_POST as $key=>$value) {
        if ($key != "fname") {
            if (empty($value)) {
                $errorMsg .= $fields[$key] . " is required.<br>";
                $success = false;
            } else {
                if ($key != "pwd_confirm" && $key != "agree" && $key != "pwd") {
                    $dbfields[$key] = $value;
                }
                if ($key === "pwd") {
                    $dbfields[$key] = password_hash($value, PASSWORD_DEFAULT);
                }
            }
        } else {
            $dbfields[$key] = $value;
        }
        
        $value = sanitize_input($value);
        
        if ($key === "email") {
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

        if ($dbresult === true) {
            if ($_SESSION['admin'] !== true) {
                $_SESSION["user"] = true;
                $_SESSION["username"] = $dbfields["username"];    
                header('location: /deliver.php');
            } else {
                $_SESSION['regmsg'] = "Account Created Successfully";
                header('location: /admin/accounts.php');
            }
            

        } else {
            // $_SESSION['regerror'] = "Failed to Create Account";
            header('location: /register.php');
        }
        
    } else {
        $_SESSION['regerror'] = $errorMsg;
        header('location: /register.php');
    }
    
    function saveMemberToDB() {
        global $fname, $lname, $email, $pwd, $errorMsg, $success;
        global $dbfields;

        if ($_SESSION['admin'] === true) {
            $usertype = $_POST["usertype"];
        } else {
            $usertype = "customer";
        }

        try {
            $conn = dbconnect();
            $stmt = $conn->prepare("INSERT INTO users (email, username, password, firstname, lastname, usertype) VALUES (?, ?, ?, ?, ?, ?)");
            $result = $stmt->execute([$dbfields["email"], $dbfields["username"], $dbfields["pwd"], $dbfields["fname"], $dbfields["lname"], $usertype]);

            return $result;
            
        } catch (PDOException $e) {
            $errorMsg = "Connection to Server Failed.";
            $_SESSION['regerror'] = $errorMsg;
            $_SESSION['regerror'] = $e;
        } finally {
            $conn = null;
            $stmt = null;
        }

    }
?>