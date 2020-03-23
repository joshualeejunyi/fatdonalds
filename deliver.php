<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');

    if (!isLoggedIn()) {
        $_SESSION['loginerr'] = "Please Login to Proceed";
        header('location: /login.php');
    }

    if ($_SESSION["admin"] === true) {
        header('location: /admin/products.php');
    }

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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['hidden_ID'])) {
            addToCart($_POST['hidden_ID']);
        } elseif (isset($_POST['remove_ID'])) {
            removeFromCart($_POST['remove_ID']);
        }

    }

    function addToCart($id) {
        if (!isset($_SESSION['cartLog'])) {
            $_SESSION['cartLog'] = array();
        }
    
        if (isset($_SESSION['cartLog'][$id])) {
            $_SESSION['cartLog'][$id]['quantity']++;
            $_SESSION['cartLog'][$id]['totalprice'] = $_SESSION['cartLog'][$id]['price'] * $_SESSION['cartLog'][$id]['quantity'];
            die();
        } else {
            $sql = "SELECT * FROM products WHERE productID = ?";
            $conn = dbconnect();
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
    
            if ($stmt->rowCount() > 0) {
                foreach ($stmt as $row) {
                    $totalprice = $row['price'];
                    $_SESSION['cartLog'][$id] = array('productID' => $row['productID'], 'name' => $row['name'],
                        'price' => $row['price'], 'quantity' => 1, 'totalprice' => $totalprice);
                    console . log($_SESSION['cartLog'][$id]);
                }
            }
            $stmt = null;
            $conn = null;
            die();
        }
    }

    function removeFromCart($id) {
        if (isset($_SESSION['cartLog'][$id])) {
            if ($_SESSION['cartLog'][$id]['quantity'] == 1) {
                unset($_SESSION['cartLog'][$id]);
            } else {
                $_SESSION['cartLog'][$id]['quantity']--;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/incl/head.inc.php');
        include($_SERVER['DOCUMENT_ROOT'].'/incl/nav.inc.php');
    ?>
    <script class="cart-table" defer type="text/javascript" src="/js/cart.js"></script>
    <body>
        <header>
            <div class="row">
                <div class="col">
                    <div class="banner">
                        <h1>Order</h1>
                    </div>
                </div>
            </div>
        </header>
        <main class="container">
            <section id="content">
                <?php
                    if ($_SESSION['menuerror']) {
                        echo "<div class='alert alert-danger'>" . $_SESSION['menuerror'] . "</div>";
                    }
                ?>
                <section class="shoppingcart">
                    <article class="card">
                        <div class="card-header text-white bg-dark">
                            <h5 class="card-title">Shopping Cart</h5>
                        </div>
                        <div class="card-body tbl-cart">
                            <?php
                            if (isset($_SESSION['cartLog'])) {
                                if (!empty($_SESSION['cartLog'])) {
                            ?>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col"> Name: </th>
                                                <th scope="col"> Price: </th>
                                                <th scope="col"> Quantity: </th>
                                                <th scope="col"> Total Price: </th>
                                                <th scope="col"> Remove Item: </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach ($_SESSION['cartLog'] as $id => $products) {
                                            ?>
                                                    <tr>
                                                        <td> <?php echo $products['name'] ?> </td>
                                                        <td> <?php echo "$" . $products['price']; ?> </td>
                                                        <td> <?php echo $products['quantity'] ?> </td>
                                                        <td> <?php echo "$" . $products['totalprice']; ?> </td>
                                                        <td style="text-align:center;" width="20%">
                                                            <input type="hidden" value="<?= $products['productID'] ?>"/> 
                                                            <button class="btn btn-danger removeCart" onclick="removeItem()">Remove From Cart</button>
                                                        </td>
                                                    </tr>
                                    <?php
                                                    $total_price += ($products["price"] * $products["quantity"]);
                                                    }
                                    ?>
                                                    <tr>
                                                        <td colspan="4">Final Price: </td>
                                                        <td style="text-align:right;"> $<?= $total_price ?></td>
                                                    </tr>
                                        </tbody>
                                    </table>
                        <?php
                                } else {
                        ?>
                                <div class="card-text">
                                    Shopping Cart Empty!
                                </div>
                        <?php
                                }
                            } else {
                        ?>
                            <div class="card-text">
                                Shopping Cart Empty!
                            </div>
                        <?php
                            }
                        ?>
                        </div>
                    </article>
                </section>

                <section id="accordion">
                    <article class="card bg-dark">
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
                    </article>
                </section>

                <section class="row datacards">
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
                                    <article class="col-12 cardcol">
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
                                                                        <input type="hidden" value="<?php echo $row["productID"] ?>"/> 
                                                                        <button class="btn btn-danger addCart">Add to Cart</button>
                                                                    </div>  
                                                                </div>
                                                            </div>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        </div>        
                                    </article>
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
                </section>
            </section>
        </main>
        <?php
        include($_SERVER['DOCUMENT_ROOT'].'/incl/footer.inc.php');
        ?>
    </body>
</html>