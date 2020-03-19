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

    if (isset($_SESSION["admin"])) {
        if ($_SESSION["admin"] === true) {
            header('location: /admin/products.php');
        }
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
            <section>
                <?php
                    if ($_SESSION['menuerror']) {
                        echo "<div class='alert alert-danger'>" . $_SESSION['menuerror'] . "</div>";
                    }
                ?>
                <div id="accordion"">
                    <div class="card bg-dark">
                        <div class="card-header text-white bg-dark">
                            <h5 class="mb-0">
                                <button class="btn btn-primary" data-toggle="collapse" data-target="#actions" aria-expanded="true" aria-controls="actions">
                                Filter
                                </button>
                            </h5>
                        </div>

                        <div id="actions" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <form method="post">
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
                                                    $errorMsg = "Server Error";
                                                    $_SESSION['menuerror'] = $errorMsg;
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
                                                                        <h4><?php echo $row["name"];?></h4>
                                                                    </div>
                                                                    <div class="card-body p-3 proddesc">
                                                                        <p class="card-text"><?php echo $row["description"];?></p>
                                                                        <h5 class="card-text">Price: $<?php echo $row["price"];?></h5>
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
                        $errorMsg = "Server Error";
                        $_SESSION['menuerror'] = $errorMsg;
                    } finally {
                        $conn = null;
                        $stmt = null;
                    }
                ?>
                </div>
            </section>
        </main>
        <?php
        include($_SERVER['DOCUMENT_ROOT'].'/incl/footer.inc.php');
        ?>
    </body>
</html>