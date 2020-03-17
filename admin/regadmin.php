<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
    unset($_SESSION['msg']);
    unset($_SESSION['error']);
    
    if ($_SESSION['admin'] !== true) {
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
                <section>
                    <h2>Create Account</h2>
                </section>
                <div class="card">
                    <div class="card-header text-center">
                        <h5 class="card-title">
                            Register
                        </h5>
                        <p>
                        Account creation only for admin. To register a standard account, please go to <a href="/register.php">Register Page</a>
                        </p>
                    </div>
                    <div class="card-body">
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
                </div>
            </main>
        </body>
    <?php
    }
    ?>
    