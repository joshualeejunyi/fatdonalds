<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
    unset($_SESSION['msg']);
    unset($_SESSION['error']);
    $catFilter = $_POST['catfilter'];
    
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
                <section>
                    <h2>Products</h2>
                </section>

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
                                    <div class="form-group">
                                        <label for="filter">Filter Category:</label>
                                        <select class="form-control" name="catfilter">
                                            <?php
                                                if ($catFilter === null) {
                                            ?>
                                                <option value="" selected>-</option>
                                            <?php
                                                } else {
                                            ?>
                                                <option value="">-</option>
                                            <?php
                                                }
                                            ?>
                                            <?php 

                                                $conn = dbconnect();
                                                if ($conn->connect_error) {
                                                    die($conn->connect_errno);
                                                } else {
                                                    $sql = "SELECT DISTINCT productCategory from products;";
                                                    $result = $conn->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while($row = $result->fetch_assoc()) {
                                            ?>
                                                            <option 
                                                                value="<?php echo $row["productCategory"]?>"
                                                                <?php 
                                                                    if ($catFilter === $row["productCategory"]) { 
                                                                        echo selected; 
                                                                    } ?>
                                                            >
                                                                <?php echo $row["productCategory"]?>
                                                            </option>
                                            <?php
                                                        }
                                                        $conn->close();
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit">Filter</button>
                                        <a href="" class="btn btn-danger">Clear Filter</a>
                                    </div>
                                </form>
                                
                                <hr>
                                <a href="/admin/upload.php" class="btn btn-primary">Upload New Product</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row datacards">
                <?php

                    $conn = dbconnect();
                    if ($conn->connect_error) {
                        die($conn->connect_errno);
                    } else {
                        $sql = "SELECT * from products";

                        if ($catFilter !== null) {
                            $sql .= " WHERE productCategory = '$catFilter'";
                        }

                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                ?>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 cardcol">
                                    <div class="card mb-3 h-100">
                                        <?php
                                        echo '<img class="card-img" src="data:image/jpeg;base64,'.base64_encode($row["productIMG"]).'"/>';
                                        ?>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row["productName"];?></h5>
                                            <p class="card-text"><?php echo $row["productDesc"];?></p>
                                        </div>
                                        <div class="card-footer">
                                            <a class="btn btn-success" href="/admin/editproduct.php?id=<?php echo $row["productID"]?>">Edit</a>
                                            <a class="btn btn-danger" onclick="return confirmDelete()" href="/admin/deleteproduct.php?id=<?php echo $row["productID"]?>">Delete</a>
                                        </div>
                                    </div>
                                </div>
                <?php
                            }
                            $conn->close();
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

