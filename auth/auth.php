<?php
session_start();

$dbconfig = parse_ini_file('db.ini');
$dbhost = $dbconfig['dbhost'];
$dbuser = $dbconfig['dbuser'];
$dbpassword = $dbconfig['dbpassword'];
$dbschema = $dbconfig['dbschema'];
$username = $email = $errors = $dbconn = "";

if (isset($_POST['usernameCheck'])) {
    $uname = $_POST['username'];
    $sql = "SELECT * from users WHERE username='$uname'";

    $config = parse_ini_file('db.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['schema']);
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        die($errorMsg);
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

if (isset($_POST['emailCheck'])) {
    $emailcheck = $_POST['email'];
    $sql = "SELECT * from users WHERE email='$emailcheck'";
    
    $config = parse_ini_file('db.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['schema']);
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        die($errorMsg);
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
    global $dbhost, $dbuser, $dbpassword, $dbschema;
    die($dbhost . $dbuser . $dbpassword . $dbschema);
    $dbconn = new mysqli($dbhost, $dbuser, $dbpassword, $dbschema);
    if($dbconn->connect_errno) {
        die($dbconn->connect_errno);
    }
    return $dbconn;
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

function register($dbconn) {
    global $username, $email, $errors;
    $success = true;
    $agreevar = false;

    $fields = array("fname" => "First Name", "lname" => "Last Name", "username" => "Username", "email" => "Email", "pwd" => "Password", "pwd_confirm" => "Confirm Password");
    // $dbfields = array("FirstName", "LastName", "Email", "Password");

    foreach($_POST as $key=>$value) {
        if ($key != "fname") {
            if (empty($value)) {
                array_push($errors, $fields[$key] . " is required.");
                // $errors .= $fields[$key] . " is required.<br>";
                $success = false;
            }
        }
        
        $value = mysqli_real_escape_string($value);
        
        if ($key == "email") {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Invalid Email Format");
                // $errors .= "Invalid Email Format. <br>";
                $success = false;
            } else {
                $email = $value;
            }
        }
        
    }

    if (!checkpassword($_POST["pwd"], $_POST["pwd_confirm"])) {
        array_push($errors, "Passwords are not the same");
        // $errors .= "Passwords are not the same. <br>";
        $success = false;
    }
    
    if (!isset($_POST["agree"])) {
        array_push($errors, "Terms and Conditions not Checked");
        // $errors .= "Terms and Conditions not Checked. <br>";
        $success = false;
    }

    if ($success == 1) {
        $pwhash = password_hash($_POST["pwd"], PASSWORD_DEFAULT);

        die($pwhash);

        $stmt = $dbconn->prepare("INSERT INTO users (email, username, password, firstname, lastname, usertype) VALUES (?, ?, ?, ?, ? ,?)");
        $stmt->bind_param($email, $_POST['username'], $pwhash, $_POST['fname'], $_POST['lname'], "customer");

        $stmt->execute();

        $stmt->close();
        $dbconn->close();

        return true;
    } else {
        return false;
    }
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

// function sanitize_input($data) {
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
// }
?>