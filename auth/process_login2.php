<html>
    <head>
        <title>World of Pets</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
        <script defer
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZ\cTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
        </script>
            
        <!--Bootstrap JS-->
        <script defer
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"
            integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm"
            crossorigin="anonymous">
        </script>
        
        <!-- Custom JS -->
        <script defer 
                src="js/main.js">
        </script>
        
        <link rel="stylesheet"
              href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
              integrity=
              "sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
              crossorigin="anonymous">
        
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet"
              href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
              integrity=
              "sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
              crossorigin="anonymous">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        
        <?php
        
        /*
         *  Helper function to authenticate the login.
         */
        function authenticateUser()
        {
            global $fname, $lname, $email, $pwd, $errorMsg, $success;
            //Create database connection.
            $config = parse_ini_file('../../private/db-config.ini');
            
            $servername = $config['servername'];
            $user = $config['username'];
            $password = $config['password'];
            $schema = $config['schema'];
            
            try{
                $conn = new PDO("mysql:host=$servername;dbname=$schema", $user , $password);
        
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT * FROM world_of_pets WHERE email='$email' AND password = '$pwd'");
                
                $stmt->bindParam(':email',$email);
                $stmt->bindParam(':password',$pwd);
                
                $stmt->execute();
            
           
                if ($result->num_rows > 0){
                // Note that email field is unique, so should only have
                // one row in the result set.
                    $row = $result->fetch_assoc();
                    $fname = $row["fname"];
                    $lname = $row["lname"];

                }
                else
                {
                    $errorMsg = "Email not found or password doesn't match...";
                    $success = false;

                }
            
            }
            catch(PDOException $e)
            {
                echo "ERROR: " . $e->getMessage();
            }
                
            $result->free_result();
            $conn = null;
            }
            
            
        include "nav.inc.php";
        ?>
        <main style="padding:1%" class="container">
        



<?php


$pwd = $email = $errorMsg = "";
$success = true;


if (empty($_POST["email"])){
    $errorMsg .= "Email not found or password doesn't match...<br>";
    $success = false;
} else {
    $email = sanitize_input($_POST["email"]);
// Additional check to make sure e-mail address is well-formed.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg .= "Email not found or password doesn't match...<br>";
        $success = false;
    }
}


if (empty($_POST["pwd"])){
   $errorMsg .= "Email not found or password doesn't match...<br>";
   $success = false;
} else {
    $pwd = sanitize_input($_POST["pwd"]);
}



if (empty($_POST[""])) {
    if ($success) {
        echo "<h4>Login successful</h4>";
        authenticateUser();
        echo "<p><b>Welcome back, " . $fname . " " . $lname . ".</b>";
        
        ?>
        <div>
            <a role='button' class="btn btn-success" href="index.php">Return to Home</a>
        </div>
        <?php
    } else {
        echo "<h3>Oops!</h3>";
        echo "<h4>The following input errors were detected:</h4>";
        echo "<p>" . $errorMsg . "</p>";
        ?>
                <div>
                    <a role='button' class="btn btn-danger" href="login.php">Return to Sign Up</a>
                </div>
        <?php
    }
}

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
    </main>
<?php
include "footer.inc.php";
    ?>
        </body>
</html>

