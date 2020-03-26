<!--  
    Project : Fatdonald's
    File: accounts.php
    Authors: Ming Hui, Joshua  
-->

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');

    if (isset($_POST['usertype'])) {
        if ($_POST['usertype'] === "") {
            $usertype = null;
        } else {
            $usertype = $_POST['usertype'];
        }
    }

    if (isset($_POST['email'])) {
        if ($_POST['email'] === "") {
            $email = null;
        } else {
            $email = $_POST['email'];
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
                <h2>User Accounts</h2>

                <?php
                    if ($_SESSION['delmsg']) {
                        echo "<div class='alert alert-success'>" . $_SESSION['delmsg'] . "</div>";
                    }
                    if ($_SESSION['delerror']) {
                        echo "<div class='alert alert-danger'>" . $_SESSION['delerror'] . "</div>";
                    }
                ?>
                <div id="accordion">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <button class="btn btn-dark" data-toggle="collapse" data-target="#actions" aria-expanded="true" aria-controls="actions">
                                Actions
                                </button>
                            </h5>
                        </div>

                        <div id="actions" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <form method="post">
                                    <h5><b><u>Filter</u></b></h5>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="text" class="form-control" name="email"> 
                                    </div>
                                    <div class="form-group">
                                        <label for="usertype">User type:</label>
                                        <select class="form-control" name="usertype">
                                            
                                                <option value="">-</option>
                                            
                                                <option
                                                    value="customer">Customer
                                                </option>
                                                <option value="admin">Admin</option>
                                                <?php
                                            
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit">Filter</button>
                                        <a href="" class="btn btn-danger">Clear Filter</a>
                                    </div>
                                </form>
                                
                                <hr>
                                <a href="/admin/register.php" class="btn btn-primary">Register New Account</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php
                    try {
                        $conn = dbconnect();

                        
                        if ($email !== null) {
                            $utstmt = $conn->prepare("SELECT * from users WHERE email = ?");
                            $utstmt->execute([$email]);
                        }

                        else if ($usertype !== null) {
                            $utstmt = $conn->prepare("SELECT * from users WHERE usertype = ? ORDER BY usertype ASC");
                            $utstmt->execute([$usertype]);
                        } else {
                            $utstmt = $conn->prepare("SELECT DISTINCT * from users ORDER BY usertype ASC");
                            $utstmt->execute();
                        }
                        
                        
                        
                    }catch (PDOException $e) {
                            $errorMsg = "Connection failed: " . $e->getMessage();
                            print_r($errorMsg);
                            die($errorMsg);
                        } finally {
                            $conn = null;
                            $stmt = null;
                        }
    
                    
                ?>
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
                            if ($utstmt->rowCount() > 0) {
                                foreach($utstmt as $row){
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
                
                         

                    ?>
                    </tbody>
                </table>
            </section>
        </main>
    </body>
</html>
<?php
    }
    
?>