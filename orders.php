<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');

    if (!isLoggedIn()) {
        $_SESSION['loginerr'] = "Please Login to Proceed";
        header('location: /login.php');
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
                        <h1>Orders</h1>
                    </div>
                </div>
            </div>
        </header>
        <main class="container">
            <section id="content">
                <?php
                    if ($_SESSION['ordererr']) {
                        echo "<div class='alert alert-danger'>" . $_SESSION['ordererr'] . "</div>";
                    } else if ($_SESSION['ordermsg']) {
                        echo "<div class='alert alert-success'>" . $_SESSION['ordermsg'] . "</div>";
                    }
                ?>
                <section class="shoppingcart">
                    <?php
                    try {
                        $email = $_SESSION["email"];
                        $conn = dbconnect();
                        $stmt = $conn->prepare("SELECT * from orders WHERE user = ? ORDER BY timestamp DESC;");
                        $result = $stmt->execute([$email]);

                        if ($stmt->rowCount() > 0) {

                            foreach($stmt as $row) {
                                ?>
                                <article class="card ordercard">
                                    <div class="card-header text-white bg-dark">
                                        <h5 class="card-title">Order from <?php echo $row['timestamp'];?></h5>
                                    </div>
                                    <div class="card-body tbl-cart">
                                        <h5>
                                            Delivered to: <?php echo $row['address']; ?>
                                        </h5>
                                        <h5>
                                            Phone Number: <?php echo $row['phonenumber']; ?>
                                        </h5>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col"> Name: </th>
                                                    <th scope="col"> Price: </th>
                                                    <th scope="col"> Quantity: </th>
                                                    <th scope="col"> Subtotal Price: </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $orderstmt = $conn->prepare("SELECT * from orderInfo WHERE orderID = ?");
                                                    $orderres = $orderstmt->execute([$row['orderID']]);

                                                    foreach ($orderstmt as $orderrow) {
                                                        $prodstmt = $conn->prepare("SELECT * from products WHERE productID = ?");
                                                        $prodres = $prodstmt->execute([$orderrow['productID']]);
                                                        foreach ($prodstmt as $prodrow) {
                                                            ?>
                                                            <tr>
                                                                <td> <?php echo $prodrow['name']; ?> </td>
                                                                <td> <?php echo $prodrow['price']; ?></td>
                                                                <td> <?php echo $orderrow['quantity']; ?> </td>
                                                                <td> <?php echo ($prodrow['price'] * $orderrow['quantity']); ?> </td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    }
                                                    ?>

                                                    <tr>
                                                        <td colspan="3">Total Price: </td>
                                                        <td> $<?php echo $row['amount']; ?></td>
                                                    </tr>
                                            </tbody>

                                        </table>
                                    </article>
                                <?php
                            }
                        } else {
                            ?>
                                <article class="card ordercard">
                                    <div class="card-header text-white bg-dark">
                                        <h5 class="card-title">No Orders Yet!</h5>
                                    </div>
                                </article>
                            <?php
                        }

                        unset($_SESSION['ordererr']);
                    } catch (PDOException $e) {
                        $_SESSION['ordererr'] = $e;
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