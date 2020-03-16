<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
    unset($_SESSION['msg']);
    unset($_SESSION['error']);

    
    if ($_SESSION['admin'] !== true) {
        header('HTTP/1.0 404 not found'); 
        include($_SERVER['DOCUMENT_ROOT'].'/auth/404.html');
    } else {
        include($_SERVER['DOCUMENT_ROOT'].'/incl/adminhead.inc.php');
        $success = true;
        try{
            $conn = dbconnect();
            $stmt = $conn->prepare("SELECT * from users order by usertype");
            $stmt->exec();
            if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            $email = $row["email"];
            $username = $row["username"];
            $password = $row["password"];
            $fname = $row["fname"];
            $lname = $row["lname"];
            $usertype = $row["usertype"];
            }

        }catch (PDOException $e) {
        $errorMsg = "Connection failed: " . $e->getMessage();
        print_r($errorMsg);
        die($errorMsg);
        $success = false;
        }
        $conn = null;
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
                
                <table border='1' width="100%" cellspacing="0" cellpadding="0">
                    <tr style="font-size: 15px;">
                        <th>Email</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>User Type</th>
                    </tr>
                    <?php
                    for ($i = 0; $i < count($row);$i++){
                        $email = $row[$i]['email'];
                        $username = $row[$i]['username'];
                        $password = $row[$i]['password'];
                        $fname = $row[$i]['fname'];
                        $lname = $row[$i]['lname'];
                        $usertype = $row[$i]['usertype'];
                    
                    ?>
                    <tr>
                        <td><?php echo $email;?></td>
                        <td><?php echo $username;?></td>
                        <td><?php echo $password;?></td>
                        <td><?php echo $fname;?></td>
                        <td><?php echo $lname;?></td>
                        <td><?php echo $usertype;?></td>
                    <?php }?>
                    </tr>
                    
                </table>
            </section>
        </main>
    </body>
<?php
    }
?>