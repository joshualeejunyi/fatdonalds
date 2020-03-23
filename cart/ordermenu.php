<?php
include($_SERVER['DOCUMENT_ROOT'] . '/FatDonalds/auth/auth.php');
session_start();
$total_price = 0;

//    Add to cart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hidden_ID'])) {
    addToCart($_POST['hidden_ID']);
}

function addToCart($id) {
    if (!isset($_SESSION['cartLog'])) {
        $_SESSION['cartLog'] = array();
    }

    if (isset($_SESSION['cartLog'][$id])) {
// already in session
        console . log("duplicate");
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
//            print_r($_SESSION['cartLog']);
        die();
    }
}

//    remove from cart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_ID'])) {
    removeFromCart($_POST['remove_ID']);
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
//function removeFromCart($id) {
//    unset($_SESSION['cartLog'][$id]);
//}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include($_SERVER['DOCUMENT_ROOT'] . '/incl/head.inc.php');
        include($_SERVER['DOCUMENT_ROOT'] . '/incl/nav.inc.php');
        ?>
        <style>
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/FatDonalds/cart/cart.css');
?>
        </style>
        <script src="/FatDonalds/cart/cart.js" defer></script>

    </head>

    <body>
        <main class="container">      
            <article class="card" id="auto">
                <div class="card-header text-white bg-dark">
                    <h5 class="card-title">Shopping Cart</h5>
                </div>
                <!--                
                                <section id="table"> -->
                <div class="card-body tbl-cart">
                    <?php
                    if (isset($_SESSION['cartLog'])) {
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
                            }
                            ?>
                            <tr>
                                <td colspan="4">Final Price: </td>
                                <td style="text-align:right;"> $<?= $total_price ?></td>
                            </tr>
                    </table>
                </div>
            </article>
            <div class="col-md-8 text-right header-box">
            </div>
            <section>
                <h2>Products</h2>
            </section>
            <section id="products">
                <div id="actions" class="collapsed" data-parent="#accordion">
                    <div class="card-body">
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
                                $sql .= " WHERE " . implode(" AND ", $queries);
                            }

                            $sql .= " ORDER BY category ASC;";

                            $stmt = $conn->prepare($sql);
                            $stmt->execute($parameters);

                            if ($catstmt->rowCount() > 0) {
                                if ($stmt->rowCount() > 0) {
                                    foreach ($catstmt as $catrow) {
                                        ?>
                                        <div class="col-12 cardcol">
                                            <div class="card mb-3 h-100">
                                                <div class="card-header text-white bg-dark">
                                                    <h4><?php echo $catrow["category"]; ?></h4>
                                                </div>
                                                <div class="card-group">
                                                    <?php
                                                    $stmt->execute($parameters);
                                                    foreach ($stmt as $row) {
                                                        if ($row["category"] === $catrow["category"]) {
                                                            ?>         

                                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 cardcol">
                                                                <div class="card mb-3 h-100">
                                                                    <?php
                                                                    echo '<img class="card-img" src="data:image/jpeg;base64,' . base64_encode($row["productimage"]) . '"/>';
                                                                    ?>
                                                                    <div class="card-header">
                                                                        <h4><?php echo $row["name"]; ?></h4>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <p class="card-text"><?php echo $row["description"]; ?></p>
                                                                        <h5 class="card-text">Price: $<?php echo $row["price"]; ?></h5>
                                                                    </div>
                                                                    <div class="card-footer">
                                                                        <input type="hidden" value="<?php echo $row["productID"] ?>"/> 
                                                                        <button class="btn btn-success addCart">Add to Cart</button>
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
        </section>
    </main>     
</body>
</html>