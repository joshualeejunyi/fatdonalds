<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
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
            $stmt = $conn->prepare($sql);
            $stmt->execute([$var]);

            if ($stmt->rowCount() > 0) {
                echo "taken";
                die();
            } else {
                echo "notTaken";
                die();
            }

        } catch (PDOException $e) {
            $errorMsg = "Failed to Connect to Database";
            $_SESSION['regerror'] = $errorMsg;
        } finally {
            $stmt = null;
            $conn = null;
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/incl/head.inc.php');
    ?>
    <script defer type="text/javascript" src="js/register.js"></script>
    <body>

        <?php
            include($_SERVER['DOCUMENT_ROOT'].'/incl/nav.inc.php');
        ?>
        <main class="container">
            <section class="card formcard">
                <div class="card-header text-center">
                    <h2 class="card-title">
                        Register
                    </h2>
                    <p>
                    For existing members, please go to the <a href="/login.php">Sign In Page</a>
                    </p>
                </div>
                <div class="card-body">
                    <?php
                        if ($_SESSION['regerror']) {
                            echo "<div class='alert alert-danger'>" . $_SESSION['regerror'] . "</div>";
                        }
                    ?>
                    <form action="auth/process_register.php" method="post">
                        <div class="form-group">
                            <label for="fname">
                                First Name:
                            </label>
                            <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name" value="<?php echo $firstname; ?>" maxlength="50">
                        </div>
                        
                        <div class="form-group">
                            <label for="lname">
                                Last Name:
                            </label>
                            <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name" value="<?php echo $lastname; ?>" maxlength="50" required>
                        </div>

                        <div class="form-group">  
                            <label for="username">
                                Username:
                            </label>
                            <span class="form-error"></span>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username"  value="<?php echo $username; ?>" required>
                        </div>
                        
                        <div class="form-group">  
                            <label for="email">
                                Email:
                            </label>
                            <span class="form-error"></span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email"  value="<?php echo $email; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="pwd">
                                Password:
                            </label>
                            <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter Password" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="pwd_confirm">
                                Confirm Password:
                            </label>
                            <input type="password" class="form-control" id="pwd_confirm" name="pwd_confirm" placeholder="Confirm Password" required>
                        </div>
                        
                        <div class="form-check">
                            <label>
                                <input type="checkbox" name="agree" required>
                                Agree to terms and  conditions.
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <div id="formerrors"></div>
                            <button class="btn btn-primary" id="regbtn" type="submit">Submit</button>
                        </div>
                        
                    </form>
                </div>
            </section>
        </main>
    </body>
</html>