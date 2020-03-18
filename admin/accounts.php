<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');

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
                <h2>User Accounts</h2>

                <?php
                    if ($_SESSION['delmsg']) {
                        echo "<div class='alert alert-success'>" . $_SESSION['delmsg'] . "</div>";
                    }
                    if ($_SESSION['delerror']) {
                        echo "<div class='alert alert-danger'>" . $_SESSION['delerror'] . "</div>";
                    }
                ?>

                <a href="/admin/register.php" class="btn btn-primary">Register New Account</a>
                
                <table class="table table-striped table-dark">
                    <thead>
                    <tr style="font-size: 15px;">
                        <th scope="col">Email</th>
                        <th scope="col">Username</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">User Type</th>
                        <th scope ="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        try{
                            $conn = dbconnect();
                            $stmt = $conn->prepare("SELECT * FROM users ORDER BY usertype");
                            $stmt->execute();
                            if ($stmt->rowCount() > 0) {
                                foreach($stmt as $row){
                                ?>
                                    <tr>
                                        <td><?php echo $row["email"];?></td>
                                        <td><?php echo $row["username"];?></td>
                                        <td><?php echo $row["firstname"];?></td>
                                        <td><?php echo $row["lastname"];?></td>
                                        <td><?php echo $row["usertype"];?></td>
                                        <td>
                                            <a class="btn btn-success" href="/admin/editaccount.php?id=<?php echo $row["username"]?>">Edit</a>
                                            <a class="btn btn-danger" onclick="return confirmDelete()" href="/admin/deleteaccount.php?id=<?php echo $row["username"]?>">Delete</a>
                                        </td>
                                        
                                    </tr>
                                    
                                <?php
                                }
                                
                                
                            }
                
                        } catch (PDOException $e) {
                            $errorMsg = "Connection failed: " . $e->getMessage();
                            print_r($errorMsg);
                            die($errorMsg);
                        } finally {
                            $conn = null;
                            $stmt = null;
                        }

                    ?>
                    </tbody>
                </table>
                <p class="message"><a href="regadmin.php">Register an account></a></p>
            </section>
        </main>
    </body>
<?php
    }
?>