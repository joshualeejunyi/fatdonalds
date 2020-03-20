<?php
include($_SERVER['DOCUMENT_ROOT'] . '/FatDonalds/auth/auth.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hidden_ID']))
{
    
    if (!isset($_SESSION['cartLog'])) {
        $_SESSION['cartLog'] = array();
    }
    
    if (isset($_SESSION['cartLog'][$id])) 
    {
        // do nothing - already in session
        console.log("duplicate");
        $_SESSION['cartLog'][$id]['quanity']++;
        $stmt = null;
        $conn = null;
        exit();
    } 
    else 
    {
        
        $sql = "SELECT * FROM products WHERE productID = '" . $id . "'";
        $conn = dbconnect();
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) 
        {
            foreach ($stmt as $row) {
                echo '<tr>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>$' . $row['price'] . '</td>';
                echo '</tr>';
                $_SESSION['cartLog'][$id] = array('productID' => $row['productID'], 'price' => $row['price'], 'quanity' => 1);
                console.log($_SESSION['cartLog'][$id]);
            }
        }
    }
//
//    $_SESSION['id'] = $_POST['hidden_ID'];
//    $id = $_POST['hidden_ID'];
//    
//    $idSaveArray=array("id"=>$id);
//    array_push($_SESSION['cartLog'],$idSaveArray); // Items added to cart


//    $sql = "SELECT * FROM products WHERE productID = '" . $id . "'";
//    $conn = dbconnect();
//    $stmt = $conn->prepare($sql);
//    $stmt->execute();
//
//    if ($stmt->rowCount() > 0) {
//        foreach ($stmt as $row) {
//            echo '<tr>';
//            echo '<td>' . $row['name'] . '</td>';
//            echo '<td>$' . $row['price'] . '</td>';
//            echo '</tr>';
//        }
//    }

    $stmt = null;
    $conn = null;
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include($_SERVER['DOCUMENT_ROOT'] . '/incl/head.inc.php');
        include($_SERVER['DOCUMENT_ROOT'] . '/incl/nav.inc.php');
        ?>
        <script src="/cart/cart.js" defer></script>
    </head>
    <body>
        <main class="container">
            <div>
                <table id="auto" border="1">
                    <tr>
                        <td> Name: </td>
                        <td> Price: </td>
                    </tr>
                <!--//insert table here-->
                </table>
            </div> 

            <section id="content">
                <div class="col-md-8 text-right header-box">

                </div>
                <section>
                    <h2>Products</h2>
                </section>
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
                                                <button class="collapsible">
                                                    <?php echo $catrow["category"]; ?>
                                                </button>
                                                <?php
                                                $stmt->execute($parameters);
                                                foreach ($stmt as $row) {
                                                    if ($row["category"] === $catrow["category"]) {
                                                        ?>         

                                                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
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
</html>