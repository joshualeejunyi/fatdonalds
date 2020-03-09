<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
    unset($_SESSION['msg']);
    unset($_SESSION['error']);
    
    if ($_SESSION['admin'] != true) {
        header('HTTP/1.0 404 not found'); 
        include($_SERVER['DOCUMENT_ROOT'].'/auth/404.html');
    } else {
        include($_SERVER['DOCUMENT_ROOT'].'/incl/adminhead.inc.php');
?>
    <body>
        <main class="wrapper">
            <?php
            include($_SERVER['DOCUMENT_ROOT'].'/incl/adminnav.inc.php');
            ?>
            <section id="content">
                <?php
                    include($_SERVER['DOCUMENT_ROOT'].'/incl/admintop.inc.php');
                ?>  
                <section>
                    <h2>Products</h2>
                    <a href="/admin/upload.php" class="btn btn-primary">Upload Product</a>
                </section>

                <div class="row">
                <?php
                    $conn = dbconnect();
                    if ($conn->connect_error) {
                        die($conn->connect_errno);
                    } else {
                        $sql = "SELECT * from products";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                ?>
                                <div class="col-sm-3 d-flex align-items-stretch">
                                    <div class="card mb-3">
                                        <?php
                                        echo '<img class="card-img" src="data:image/jpeg;base64,'.base64_encode($row["productIMG"]).'"/>';
                                        ?>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row["productName"];?></h5>
                                            <p class="card-text"><?php echo $row["productDesc"];?></p>
                                            <a class="btn btn-success">Edit</a>
                                            <a class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                <?php
                            }
                        }
                    }
                ?>
                </div>
            </section>
        </main>
    </body>
<?php
    }
?>

