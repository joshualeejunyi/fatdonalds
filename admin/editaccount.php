<!--  
    Project : Fatdonald's
    File: editaccount.php
    Authors: Ming Hui, Joshua  
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
            $errorMsg = "Error: " . $e;
            $_SESSION['editaccerror'] = $errorMsg;
            header('location: /admin/editaccount.php?id='.$username);
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
                   <section class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title">Edit Account</h2>
                    </div>
                    <div class="card-body">
                        <?php
                            if ($_SESSION['editaccmsg']) {
                                echo "<div class='alert alert-success'>" . $_SESSION['editaccmsg'] . "</div>";
                            }
                            if ($_SESSION['editaccerror']) {{
                                echo "<div class='alert alert-danger'>" . $_SESSION['editaccerror'] . "</div>";
                            }}
                        ?>
                        <form action="/admin/process_editaccount.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="oldemail">
                                    Email:
                                </label>
                                <input type ="email" class="form-control" id="email" name="email" readonly="readonly" value="<?php echo $email?>">
                            
                        
                            <div class="form-group">  
                                <label for="username">
                                    Username:
                                </label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $username?>" required>
                            </div>
                            <div class="form-group">
                                <label for="firstname">
                                    First Name:
                                </label>
                                <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $fname ?>">
                            </div>
                            <div class="form-group">
                                <label for="lastname">
                                    Last Name:
                                </label>
                                <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $lname ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="usertype">
                                    User Type:
                                </label>
                                <select class="form-control" name="usertype">
                                    <?php
                                        if ($usertype === "admin") {
                                    ?>
                                        <option value="admin" selected>Administrator</option>
                                        <option value="customer">Customer</option>
                                    <?php
                                        } else {
                                    ?>
                                        <option value="admin">Administrator</option>
                                        <option value="customer" selected>Customer</option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                            <hr>
                            <h5>OR:</h5>
                            <div class="form-group">
                                <a href="/admin/resetpassword.php?id=<?php echo $username?>" class="btn btn-danger">Reset Password</a>
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
