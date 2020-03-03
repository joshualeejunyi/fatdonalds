<!DOCTYPE html>
<html>
<?php
    include($_SERVER['DOCUMENT_ROOT'].'/head.inc.php');
?>

<body>
    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/nav.inc.php');
    ?>
<?php
    $email = $errorMsg = "";
    $success = true;
    $agreevar = false;
    
    $fields = array("fname" => "First Name", "lname" => "Last Name", "email" => "Email", "pwd" => "Password", "pwd_confirm" => "Confirm Password");
    $dbfields = array("FirstName", "LastName", "Email", "Password");
    
    foreach($_POST as $key=>$value) {
        if ($key != "fname") {
            if (empty($value)) {
                $errorMsg .= $fields[$key] . " is required.<br>";
                $success = false;
            }
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
    
    if (!checkpassword($_POST["pwd"], $_POST["pwd_confirm"])) {
        $errorMsg .= "Passwords are not the same. <br>";
        $success = false;
    }
    
    if (!isset($_POST["agree"])) {
        $errorMsg .= "Terms and Conditions not Checked. <br>";
        $success = false;
    }

    if ($success){
        echo "<div class='jumbotron text-center'>";
        echo "<h4 class='display-4'>Registration Successful!</h4>";
        echo "<p><b>Email: " . $email ."</b>";
        echo "</div>";
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
?>
<?php
    include "footer.inc.php";
?>
</body>