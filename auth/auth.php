<?php
session_start();

$db = mysqli_connect('localhost', 'dev', '', 'fatdonalds');
$username = $email = $errors = "";

if ($db -> connect_errno)  {
    echo "Failed to connect to MySQL: " . $db -> connect_error;
    exit();
}

if (isset($_POST['registerbtn'])) {
    if (register()) {
        header("location: /login.php");
    } else {
        header("location: /index.php");
    }
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

function register() {
    global $db, $username, $email, $errors;
    $success = true;
    $agreevar = false;
    
    $fields = array("fname" => "First Name", "lname" => "Last Name", "email" => "Email", "pwd" => "Password", "pwd_confirm" => "Confirm Password");
    // $dbfields = array("FirstName", "LastName", "Email", "Password");
    
    foreach($_POST as $key=>$value) {
        if ($key != "fname") {
            if (empty($value)) {
                $errors .= $fields[$key] . " is required.<br>";
                $success = false;
            }
        }
        
        $value = sanitize_input($value);
        
        if ($key == "email") {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors .= "Invalid Email Format. <br>";
                $success = false;
            } else {
                $email = $value;
            }
        }
        
    }
    
    if (!checkpassword($_POST["pwd"], $_POST["pwd_confirm"])) {
        $errors .= "Passwords are not the same. <br>";
        $success = false;
    }
    
    if (!isset($_POST["agree"])) {
        $errors .= "Terms and Conditions not Checked. <br>";
        $success = false;
    }

    return $success;
          
}
            
function checkpassword($pwd1, $pwd2) {
    if ($pwd1 === $pwd2) {
        return true;
    } else {
        return false;
    }
}

function displayErrors() {
    global $errors;

    if (count($errors) > 0) { 
        echo '<div class="error">';
        foreach ($errors as $error) {
            echo $error .'<br>';
        }
        echo '</div>';
    }
}

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>