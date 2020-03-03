<!DOCTYPE html>
<html>
    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/incl/head.inc.php');
    ?>
    <body>
        <?php
            include($_SERVER['DOCUMENT_ROOT'].'/incl/nav.inc.php');
        ?>
        <main class="container">
            <div class="card">
                <div class="card-header text-center">
                    <h5 class="card-title">
                        Login
                    </h5>
                    <?php
                        if ($_SESSION['msg']) {
                            
                        }
                    ?>
                    <p>
                    Don't have an account? Register <a href="/register.php">here!</a>
                    </p>
                </div>
                <div class="card-body">
                    <form action="process_login.php" method="post">
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
                            <button class="btn btn-primary" type="submit">Login</button>
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