<!-- 
    Project : Fatdonald's
    File: checkout.php
    Authors: Joshua
 -->
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
                        <h1>Checkout</h1>
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
                                                            <button class="btn btn-danger removeCart" onclick="removeItem()">Remove</button>
                                                        </td>
                                                    </tr>
                                    <?php
                                                    $total_price += ($products["price"] * $products["quantity"]);
                                                }

                                                $_SESSION["totalprice"] = $total_price;
                                    ?>
                                                    <tr>
                                                        <td colspan="4">Final Price: </td>
                                                        <td style="text-align:center;" > $<?= $total_price ?></td>
                                                    </tr>
                                                    <tr>
                                                    </tr>
                                        </tbody>
                                    </table>
                                    
                                    <form action="process_checkout.php" method="post">
                                        <div class="form-group">
                                            <label for="phone">
                                                <h5>
                                                    Phone Number:
                                                </h5>
                                            </label>
                                            <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" maxlength="50" required>
                                        </div>

                                        <div class="form-group">  
                                            <label for="address">
                                                <h5>
                                                    Address:
                                                </h5>
                                            </label>
                                            <span class="form-error"></span>
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required>
                                        </div>
                                        <div class="form-group">
                                            <div id="formerrors"></div>
                                            <button class="btn btn-primary" id="checkoutbtn" type="submit">Checkout</button>
                                        </div>
                                        
                                    </form>

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
            </section>
        </main>
        <?php
        include($_SERVER['DOCUMENT_ROOT'].'/incl/footer.inc.php');
        ?>
    </body>
</html>