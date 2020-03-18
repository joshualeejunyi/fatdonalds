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
                <h2>User Accounts</h2>
                
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
                                            <form action="deleteaccount.php" method="get">
                                                <input type="hidden" name="email" value="<?php echo $row["email"];?>"/>
                                                <input type="submit" value="Delete"/>
                                            </form>
                                            <form action ="editaccount.php" method="get">
                                                <input type="hidden" name="email" value="<?php echo $row["email"];?>"/>
                                                <input type="submit" value="Edit"/>
                                            </form>
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