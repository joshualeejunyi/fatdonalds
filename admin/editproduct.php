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
                $prodname = $row["name"];
                $prodcat = $row["category"];
                $proddesc = $row["description"];
                $productprice = $row["price"];
                $promo = $row["promo"];
                $promoprice = $row["promoprice"];
            }

        } catch (PDOExcption $e) {
            $errorMsg = "Error: " . $e;
            $_SESSION['editproderror'] = $errorMsg;
            header('location: /admin/editproduct.php?id='.$productID);
        } finally {
            $stmt = null;
            $conn = null;
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
                   <section class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title">Edit Product</h2>
                    </div>
                    <div class="card-body">
                        <?php
                            if ($_SESSION['editprodmsg']) {
                                echo "<div class='alert alert-success'>" . $_SESSION['editprodmsg'] . "</div>";
                            }
                            if ($_SESSION['editproderror']) {{
                                echo "<div class='alert alert-danger'>" . $_SESSION['editproderror'] . "</div>";
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
                                <label for="productprice">
                                    Price:
                                </label>
                                <input type="number" step="any" class="form-control" id="productprice" name="productprice" value="<?php echo $productprice?>" required>
                            </div>
                            <div class="form-check">
                                <?php 
                                    if ($promo === "1") {
                                ?>
                                    <input type="checkbox" name="promo" checked>
                                <?php
                                    } else {
                                ?>
                                    <input type="checkbox" name="promo">
                                <?php    
                                }
                                ?>
                                    
                                <label>
                                    Promotion
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="promoprice">
                                    Promotional Price:
                                </label>
                                <input type="number" step="any" class="form-control" id="promoprice" name="promoprice" value="<?php echo $promoprice?>">
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
</html>
<?php
    }
?>

