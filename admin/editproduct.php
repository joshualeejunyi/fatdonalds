<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
    if(isset($_GET['id'])) {
        $productID=$_GET['id'];

        try {
            $conn = dbconnect();
            $stmt = $conn->prepare("SELECT * FROM products WHERE productID = ?");
            $stmt->execute([$productID]);

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch();
                $prodname = $row["productName"];
                $prodcat = $row["productCategory"];
                $proddesc = $row["productDesc"];
            }

        } catch (PDOExcption $e) {
            $errorMsg = "Product Not Found: " . $e;
            $_SESSION['msg'] = $errorMsg;
            print_r($e);
        } finally {
            $stmt = null;
            $conn = null;
        }
    }
    
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
                   <section class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title">Edit Product</h2>
                    </div>
                    <div class="card-body">
                        <?php
                            if ($_SESSION['msg']) {
                                echo "<div class='alert alert-success'>" . $_SESSION['msg'] . "</div>";
                            }
                            if ($_SESSION['error']) {{
                                echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
                            }}
                        ?>
                        <form action="/admin/process_edit.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">  
                                <label for="productid">
                                    ID:
                                </label>
                                <input type="number" class="form-control" id="productid" name="productid" readonly="readonly" value="<?php echo $productID?>">
                            </div>
                            <div class="form-group">  
                                <label for="productname">
                                    Name:
                                </label>
                                <input type="text" class="form-control" id="productname" name="productname" value="<?php echo $prodname?>" required>
                            </div>
                            <div class="form-group">
                                <label for="productcat">
                                    Category:
                                </label>
                                <input type="text" class="form-control" id="productcat" name="productcat" value="<?php echo $prodcat?>" required>
                            </div>
                            <div class="form-group">
                                <label for="productdesc">
                                    Description:
                                </label>
                                <textarea class="form-control" name="productdesc" id="productdesc" rows="3"><?php echo $proddesc ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="imagefile">
                                    Image:
                                </label>
                                <input type="file" class="form-control-file" name="imagefile" id="imagefile">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Upload</button>
                            </div>
                        </form>
                    </div>
                </section>
            </section>
        </main>
    </body>
<?php
    }
?>

