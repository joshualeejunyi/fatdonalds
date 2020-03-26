<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');

    if (isset($_POST['catfilter'])) {
        if ($_POST['catfilter'] === "") {
            $catFilter = null;
        } else {
            $catFilter = $_POST['catfilter'];
        }
    }

    if (isset($_POST['keyword'])) {
        if ($_POST['keyword'] === "") {
            $keyword = null;
        } else {
            $keyword = $_POST['keyword'];
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
                <section>
                    <h2>Products</h2>
                </section>

                <?php
                    if ($_SESSION['prodmsg']) {
                        echo "<div class='alert alert-success'>" . $_SESSION['prodmsg'] . "</div>";
                    }
                    if ($_SESSION['proderror']) {{
                        echo "<div class='alert alert-danger'>" . $_SESSION['proderror'] . "</div>";
                    }}
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
                                        <label for="keyword">Product Name:</label>
                                        <input type="text" class="form-control" name="keyword"></input>
                                    </div>
                                    <div class="form-group">
                                        <label for="catfilter">Category:</label>
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

                                                try {
                                                    $conn = dbconnect();
                                                    $stmt = $conn->prepare("SELECT DISTINCT category from products");
                                                    $result = $stmt->execute();

                                                    if ($stmt->rowCount()>0) {
                                                        foreach($stmt as $row) {
                                            ?>
                                                <option 
                                                    value="<?php echo $row["category"]?>"
                                                    <?php 
                                                        if ($catFilter === $row["category"]) { 
                                                            echo selected; 
                                                        } ?>
                                                >
                                                    <?php echo $row["category"]?>
                                                </option>
                                            <?php

                                                        }
                                                    }
                                                } catch (PDOException $e) {
                                                    $errorMsg = "Connection failed: " . $e;
                                                    $_SESSION['proderror'] = $errorMsg;
                                                } finally {
                                                    $conn = null;
                                                    $stmt = null;
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
                    try {
                        $conn = dbconnect();

                        $queries = [];
                        $parameters = [];

                        if ($keyword !== null) {
                            $queries[] = 'name LIKE ?';
                            $parameters[] = '%' . $keyword . '%';
                        }

                        if ($catFilter !== null) {
                            $queries[] = 'category = ?';
                            $parameters[] = $catFilter;
                            $catstmt = $conn->prepare("SELECT DISTINCT category from products WHERE category = ? ORDER BY category ASC");
                            $catstmt->execute([$catFilter]);
                        } else {
                            $catstmt = $conn->prepare("SELECT DISTINCT category from products ORDER BY category ASC");
                            $catstmt->execute();
                        }

                        $sql = "SELECT * from products";


                        if ($queries) {
                            $sql .= " WHERE ".implode(" AND ", $queries);
                        }

                        $sql .= " ORDER BY category ASC;";

                        $stmt = $conn->prepare($sql);
                        $stmt->execute($parameters);

                        if ($catstmt->rowCount() > 0) {
                            if ($stmt->rowCount()>0) {
                                foreach($catstmt as $catrow) {
                                ?>
                                    <div class="col-12 cardcol">
                                        <div class="card mb-3 h-100">
                                            <div class="card-header text-white bg-dark">
                                                <h4><?php echo $catrow["category"];?></h4>
                                            </div>
                                            <div class="card-group">
                                                <?php
                                                    $stmt->execute($parameters);
                                                    foreach($stmt as $row) {
                                                        if ($row["category"] === $catrow["category"]) {
                                                ?>
                                                            <div class="col-12 col-lg-6 col-xl-3">
                                                                <div class="card mb-3 h-100 prodcard">
                                                                <?php
                                                                    echo '<img class="card-img" src="data:image/jpeg;base64,'.base64_encode($row["productimage"]).'"/>';
                                                                ?>
                                                                    <div class="card-header prod-name">
                                                                        <h4><?php 
                                                                            echo $row["name"];

                                                                            if ($row["promo"] == 1) {
                                                                                echo " ($" . $row["promoprice"] . ") <del class='promoprice'>(U.P. $" . $row["price"] . ")</del>";
                                                                            } else {
                                                                                echo " ($".$row["price"].")";
                                                                            }

                                                                            ?>
                                                                        </h4>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="card-text">
                                                                            <?php echo $row["description"];?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-footer">
                                                                        <a class="btn btn-success" href="/admin/editproduct.php?id=<?php echo $row["productID"]?>">Edit</a>
                                                                        <a class="btn btn-danger" onclick="return confirmDelete()" href="/admin/deleteproduct.php?id=<?php echo $row["productID"]?>">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        </div>        
                                    </div>
                <?php
                                    }
                                }
                            }
                    } catch (PDOException $e) {
                        $errorMsg = "Connection failed: " . $e;
                        $_SESSION['proderror'] = $errorMsg;
                    } finally {
                        $conn = null;
                        $stmt = null;
                    }
                ?>
                </div>
            </section>
        </main>
    </body>
</html>
<?php
    }
?>

