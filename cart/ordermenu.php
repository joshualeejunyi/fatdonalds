<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/auth/auth.php');
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hidden_ID'])) {
        $_SESSION['id'] = $_POST['hidden_ID'];
        $id = $_POST['hidden_ID'];
        $sql = "SELECT * FROM products WHERE productID = '". $id . "'";
        $conn = dbconnect();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        echo '<table border="1"><tr>';
        if ($stmt->rowCount() > 0) {
            foreach ($stmt as $row) {
                echo '<td>' . $row['productName'] . '</td>';
                echo '<td>' . $row['productPrice'] . '</td>';
            }
        }

        echo '</tr></table>';

        $stmt = null;
        $conn = null;
        exit();
    }
    //    if($_SERVER["REQUEST_METHOD"] == "POST") {
    ////        $_SESSION['hidden_ID'] = $_POST['hidden_ID'];
    //        $id = $_POST['hidden_ID'];
    //        $query = mysql_query('SELECT * FROM products WHERE productID ="'.$id);
    //        $row = mysql_num_rows($query);
    //    }
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
            <div id="auto">
                <!--                     //insert table here-->
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
        $sql .= " WHERE " . implode(" AND ", $queries);
    }

    $sql .= " ORDER BY productCategory ASC;";

    $stmt = $conn->prepare($sql);
    $stmt->execute($parameters);

    if ($catstmt->rowCount() > 0) {
        if ($stmt->rowCount() > 0) {
            foreach ($catstmt as $catrow) {
                ?>
                                        <div class="col-12 cardcol">
                                            <div class="card mb-3 h-100">
                                                <button class="collapsible">
                                        <?php echo $catrow["productCategory"]; ?>
                                                </button>
                                        <?php
                                        $stmt->execute($parameters);
                                        foreach ($stmt as $row) {
                                            if ($row["productCategory"] === $catrow["productCategory"]) {
                                                ?>         

                                                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                                            <div class="card mb-3 h-100">
                                                            <?php
                                                            echo '<img class="card-img" src="data:image/jpeg;base64,' . base64_encode($row["productIMG"]) . '"/>';
                                                            ?>
                                                                <div class="card-header">
                                                                    <h4><?php echo $row["productName"]; ?></h4>
                                                                </div>
                                                                <div class="card-body">
                                                                    <p class="card-text"><?php echo $row["productDesc"]; ?></p>
                                                                    <h5 class="card-text">Price: $<?php echo $row["productPrice"]; ?></h5>
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
