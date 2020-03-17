<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
    unset($_SESSION['msg']);
    unset($_SESSION['error']);
    $catFilter = $_POST['catfilter'];
    $keyword = $_POST['keyword'];
    
    if ($catFilter === "") {
        $catFilter = null;
    }

    if ($_SESSION["admin"] === true) {
        header('location: /admin/products.php');
    }

?>

<!DOCTYPE html>
<html>
    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/incl/head.inc.php');
        include($_SERVER['DOCUMENT_ROOT'].'/incl/nav.inc.php');
    ?>
    <body>
        <header>
            <div class="row">
                <div class="col">
                    <div class="banner">
                        <h1>Our Menu</h1>
                    </div>
                </div>
            </div>
        </header>
        <main class="container">
            <section id="content">
            

                <div id="accordion"">
                    <div class="card">
                        <div class="card-header text-white bg-dark">
                            <h5 class="mb-0">
                                <button class="btn btn-primary" data-toggle="collapse" data-target="#actions" aria-expanded="true" aria-controls="actions">
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
                                                    $stmt = $conn->prepare("SELECT DISTINCT productCategory from products");
                                                    $result = $stmt->execute();

                                                    if ($stmt->rowCount()>0) {
                                                        foreach($stmt as $row) {
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
                                                    }
                                                } catch (PDOException $e) {
                                                    $errorMsg = "Connection failed: " . $e;
                                                    $_SESSION['msg'] = $errorMsg;
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
                            $queries[] = 'productName LIKE ?';
                            $parameters[] = '%' . $keyword . '%';
                        }

                        if ($catFilter !== null) {
                            $queries[] = 'productCategory = ?';
                            $parameters[] = $catFilter;
                            $catstmt = $conn->prepare("SELECT DISTINCT productCategory from products WHERE productCategory = ? ORDER BY productCategory ASC");
                            $catstmt->execute([$catFilter]);
                        } else {
                            $catstmt = $conn->prepare("SELECT DISTINCT productCategory from products ORDER BY productCategory ASC");
                            $catstmt->execute();
                        }

                        $sql = "SELECT * from products";

                        if ($queries) {
                            $sql .= " WHERE ".implode(" AND ", $queries);
                        }

                        $sql .= " ORDER BY productCategory ASC;";

                        $stmt = $conn->prepare($sql);
                        $stmt->execute($parameters);

                        if ($catstmt->rowCount() > 0) {
                            if ($stmt->rowCount()>0) {
                                foreach($catstmt as $catrow) {
                                ?>
                                    <div class="col-12 cardcol">
                                        <div class="card mb-3 h-100">
                                            <div class="card-header text-white bg-dark">
                                                <?php echo $catrow["productCategory"];?>
                                            </div>
                                            <div class="card-group">
                                                <?php
                                                    $stmt->execute($parameters);
                                                    foreach($stmt as $row) {
                                                        if ($row["productCategory"] === $catrow["productCategory"]) {
                                                ?>
                                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                                                <div class="card mb-3 h-100">
                                                                <?php
                                                                    echo '<img class="card-img" src="data:image/jpeg;base64,'.base64_encode($row["productIMG"]).'"/>';
                                                                ?>
                                                                    <div class="card-header">
                                                                        <h4><?php echo $row["productName"];?></h4>
                                                                    </div>
                                                                    <div class="card-body p-3">
                                                                        <p class="card-text"><?php echo $row["productDesc"];?></p>
                                                                        <h5 class="card-text">Price: $<?php echo $row["productPrice"];?></h5>
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
                        $_SESSION['msg'] = $errorMsg;
                    } finally {
                        $conn = null;
                        $stmt = null;
                    }
                ?>
                </div>
            </section>
        </main>
    </body>

