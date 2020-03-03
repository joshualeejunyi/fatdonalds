<!DOCTYPE html>
<html>
<?php
    include "head.inc.php";
?>

<body>
    <?php
        include "nav.inc.php";
    ?>
    
    <main class="container">
        <div class="card">
            <div class="card-header text-center">
                <h5 class="card-title">
                    Login
                </h5>
                <p>
                For existing members, please go to the <a href="#">Sign In Page</a>
                </p>
            </div>
            <div class="card-body">
                <form action="/auth/process_register.php" method="post">
                    <div class="form-group">
                        <label for="fname">
                            First Name:
                        </label>
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name" maxlength="50">
                    </div>
                    
                    <div class="form-group">
                        <label for="lname">
                            Last Name:
                        </label>
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name" maxlength="50" required>
                        <!--<input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name" maxlength="50">-->

                    </div>
                    
                    <div class="form-group">  
                        <label for="email">
                            Email:
                        </label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                        <!--<input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" required>-->

                    </div>
                    
                    <div class="form-group">
                        <label for="pwd">
                            Password:
                        </label>
                        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter Password" required>
                        <!--<input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter Password">-->
                    </div>
                    
                    <div class="form-group">
                        <label for="pwd_confirm">
                            Confirm Password:
                        </label>
                        <input type="password" class="form-control" id="pwd_confirm" name="pwd_confirm" placeholder="Confirm Password" required>
                        <!--<input type="password" class="form-control" id="pwd_confirm" name="pwd_confirm" value="False" placeholder="Confirm Password">-->                
                    </div>
                    
                    <div class="form-check">
                        <label>
                            <input type="checkbox" name="agree" required>
                            <!--<input type="checkbox" name="agree">-->                    
                            Agree to terms and  conditions.
                        </label>
                    </div>
                    
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    
    <?php
        include "footer.inc.php";
    ?>
</body>
</html>