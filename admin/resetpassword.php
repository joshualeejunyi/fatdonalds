<!--  
    Project : Fatdonald's
    File: resetpassword.php
    Authors: Joshua
-->

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
    if(isset($_GET['id'])) {
        $username=$_GET['id'];
        try {
            $conn = dbconnect();
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch();
                $email = $row["email"];
                $username = $row["username"];
                $password = $row["password"];
                $fname = $row["firstname"];
                $lname = $row["lastname"];
                $usertype = $row["usertype"];
            }

        } catch (PDOExcption $e) {
            $errorMsg = "Account Not Found: " . $e;
            $_SESSION['passerror'] = $errorMsg;
            header('location: /admin/resetpassword?id='.$username);
        } finally {
            $stmt = null;
            $conn = null;
        }
    }
    
    if ($_SESSION['admin'] !== true) {
        header('HTTP/1.0 404 not found'); 
        include($_SERVER['DOCUMENT_ROOT'].'/auth/404.html');
    } else {
        include($_SERVER['DOCUMENT_ROOT'].'/incl/adminhead.inc.php');
?>
<!DOCTYPE html>
<html lang="en">
    <?php
    include($_SERVER['DOCUMENT_ROOT'].'/incl/adminnav.inc.php');
    ?>
    <body>
        <main class="container">
            <section id="content">
                <?php
                    include($_SERVER['DOCUMENT_ROOT'].'/incl/admintop.inc.php');
                ?>  
            <section id="content">
                <?php
                    include($_SERVER['DOCUMENT_ROOT'].'/incl/admintop.inc.php');
                ?>  
                   <section class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title">Reset Password</h2>
                    </div>
                    <div class="card-body">
                        <?php
                            if ($_SESSION['passmsg']) {
                                echo "<div class='alert alert-success'>" . $_SESSION['passmsg'] . "</div>";
                            }
                            if ($_SESSION['passerror']) {{
                                echo "<div class='alert alert-danger'>" . $_SESSION['passerror'] . "</div>";
                            }}
                        ?>
                        <form action="/admin/process_reset.php" method="post">
                            <div class="form-group">  
                                <label for="email">
                                    Email:
                                </label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email?>" readonly>
                            </div>
                            <div class="form-group">  
                                <label for="username">
                                    Username:
                                </label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $username?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="firstname">
                                    First Name:
                                </label>
                                <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $fname ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="lastname">
                                    Last Name:
                                </label>
                                <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $lname ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="usertype">
                                    User Type:
                                </label>
                                <input type="text" class="form-control" name="usertype" id="usertype" value="<?php echo $usertype?>" readonly>
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
                            <div class="form-group">
                                <button class="btn btn-danger" type="submit">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </section>
            </section>
        </main>
    </body>
</html>
<?php
    }
?>