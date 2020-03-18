<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
    if(isset($_GET['email'])) {
        $email=$_GET['email'];

        try {
            $conn = dbconnect();
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);

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
            $errorMsg = "Accounnt Not Found: " . $e;
            $_SESSION['msg'] = $errorMsg;
            print_r($e);
        } finally {
            $stmt = null;
            $conn = null;
        }
    }
    
    if ($_SESSION['admin'] != true) {
        header('HTTP/1.0 404 not found'); 
        include($_SERVER['DOCUMENT_ROOT'].'/auth/404.html');
    } else {
        include($_SERVER['DOCUMENT_ROOT'].'/incl/adminhead.inc.php');
?>
    <body>
        <main class="container">
            <?php
            include($_SERVER['DOCUMENT_ROOT'].'/incl/adminnav.inc.php');
            ?>
            <section id="content">
                <?php
                    include($_SERVER['DOCUMENT_ROOT'].'/incl/admintop.inc.php');
                ?>  
                   <section class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title">Edit Product</h2>
                    </div>
                    <div class="card-body">
                        <?php
                            if ($_SESSION['msg']) {
                                echo "<div class='alert alert-success'>" . $_SESSION['msg'] . "</div>";
                            }
                            if ($_SESSION['error']) {{
                                echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
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
                                <label for="password">
                                    Password:
                                </label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">
                                    Confirm Password:
                                </label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            <div class="form-group">
                                <label for="firstname">
                                    First Name:
                                </label>
                                <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $fname ?>" required>
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
                                <input type="text" class="form-control" name="usertype" id="usertype" readonly="readonly" value="<?php echo $usertype ?>">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </section>
            </section>
        </main>
    </body>
<?php
    }
?>

