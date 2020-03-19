<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
    
    if ($_SESSION['admin'] !== true) {
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
                <section class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title">Upload Product</h2>
                    </div>
                    <div class="card-body">
                        <?php
                            if ($_SESSION['uploadmsg']) {
                                echo "<div class='alert alert-success'>" . $_SESSION['uploadmsg'] . "</div>";
                            }
                            if ($_SESSION['uploaderror']) {{
                                echo "<div class='alert alert-danger'>" . $_SESSION['uploaderror'] . "</div>";
                            }}
                        ?>
                        <form action="/admin/process_upload.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">  
                                <label for="productname">
                                    Name:
                                </label>
                                <input type="text" class="form-control" id="productname" name="productname" placeholder="Product Name" required>
                            </div>
                            <div class="form-group">
                                <label for="productcat">
                                    Category:
                                </label>
                                <input type="text" class="form-control" id="productcat" name="productcat" placeholder="Product Category" required>
                            </div>
                            <div class="form-group">
                                <label for="productdesc">
                                    Description:
                                </label>
                                <textarea class="form-control" name="productdesc" id="productdesc" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="productprice">
                                    Price:
                                </label>
                                <input type="number" step="any" class="form-control" id="productprice" name="productprice" value="<?php echo $productprice?>" required>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="promo">
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
<?php
    }
?>

