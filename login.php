<?php  
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');

    if (isLoggedIn()) {
        header('location: /deliver.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/incl/head.inc.php');
    ?>
    <body>
        <?php
            include($_SERVER['DOCUMENT_ROOT'].'/incl/nav.inc.php');
        ?>
        <main class="container">
            <section class="card formcard">
                <div class="card-header text-center">
                    <h2 class="card-title">
                        Login
                    </h2>
                    <p>
                    Don't have an account? Register <a href="/register.php">here!</a>
                    </p>
                </div>
                <div class="card-body">
                    <?php
                        if ($_SESSION['loginerr']) {
                            echo "<div class='alert alert-danger'>" . $_SESSION['loginerr'] . "</div>";
                        }
                    ?>
                    <form action="auth/process_login.php" method="post">
                        <div class="form-group">  
                            <label for="email">
                                Email:
                            </label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>

                        </div>
                        <div class="form-group">
                            <label for="pwd">
                                Password:
                            </label>
                            <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter Password" required>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </section>
        </main>

    </body>
</html>