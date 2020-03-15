<?php   
session_start();  

 $connect = mysqli_connect("fatdonalds", "root", "", "products");  
 if(isset($_POST["add_to_cart"]))  
 {  
      if(isset($_SESSION["shopping_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  
           {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array(  
                     'item_id'               =>     $_GET["id"],  
                     'item_name'               =>     $_POST["hidden_name"],  
                     'item_price'          =>     $_POST["hidden_price"],  
                     'item_quantity'          =>     $_POST["quantity"]  
                );  
                $_SESSION["shopping_cart"][$count] = $item_array;  
           }  
           else  
           {  
                echo '<script>alert("Item Already Added")</script>';  
                echo '<script>window.location="/admin/index.php"</script>';  
           }  
      }  
      else  
      {  
           $item_array = array(  
                'item_id'               =>     $_GET["id"],  
                'item_name'               =>     $_POST["hidden_name"],  
                'item_price'          =>     $_POST["hidden_price"],  
                'item_quantity'          =>     $_POST["quantity"]  
           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
      }  
 }  
 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo '<script>alert("Item Removed")</script>';  
                     echo '<script>window.location="/admin/index.php"</script>';  
                }  
           }  
      }  
 }  
 ?>  




 
<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
    unset($_SESSION['msg']);
    unset($_SESSION['error']);
    

    if ($catFilter === "") {
        $catFilter = null;
    }
    
    if ($_SESSION['admin'] != true) {
        header('HTTP/1.0 404 not found'); 
        include($_SERVER['DOCUMENT_ROOT'].'/auth/404.html');
    } else {
        include($_SERVER['DOCUMENT_ROOT'].'/incl/adminhead.inc.php');

?>
    <body>
        <main class="container">
            <?php
            include($_SERVER['DOCUMENT_ROOT'].'/incl/adminnav.inc.php');
            ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
            <?php
                include($_SERVER['DOCUMENT_ROOT'].'/incl/admintop.inc.php');
            ?>  
            <section id="MenuCards">
                <section>
                    <h2>Products</h2>
                </section>

<!--            Set Category   -->
                <h1>Set Combos</h1>
                <div class="row">
                <?php
                    try {
                        $conn = dbconnect();

                        $queries = ['productCategory LIKE ?'];
                        $parameters = ['Set'];

                        $sql = "SELECT * from products";

                        if ($queries) {
                            $sql .= " WHERE ".implode(" AND ", $queries);
                        }

                        $stmt = $conn->prepare($sql);
                        $stmt->execute($parameters);
                        if ($stmt->rowCount()>0) {
                            foreach($stmt as $row) {
                                ?>
                                <div class="cardcol">
                                    <div class="card" style="width:300px">
                                        <?php
                                        echo '<img class="card-img" style="height:100%"  src="data:image/jpeg;base64,'.base64_encode($row["productIMG"]).'"/>';
                                        ?>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row["productName"];?></h5>
                                            <p class="card-text"><?php echo $row["productDesc"];?></p>
                                            <p class="card-text"><?php echo $row["productPrice"]; ?></p>
     
                                        </div>
                                        <div class="card-footer p-1">
                                           <form method="post" action="/admin/index.php?action=add&id=<?php echo$row["productID"]; ?>">  
                                                <input type="hidden" name="id" class="id" value="<?php echo $row['productID'] ?>"/>
                                                 <input type="text" name="quantity" class="form-control" value="1" />  
                                                <input type="hidden" name="hidden_name" value="<?php echo $row["productName"]; ?>" />  
                                                <input type="hidden" name="hidden_price" value="<?php echo $row["productPrice"]; ?>" />  
                                                <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />  

                                            </form>

                                        </div>
<!--                                    </div>-->
                                </div>
                                </div>
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
                </div>
            </section>


                <!--  Burger Category   -->
            <section id="MenuCards">
                <h1>Burger</h1>
                <div class="row">
                <?php
                    try {
                        $conn = dbconnect();

                        $queries = ['productCategory LIKE ?'];
                        $parameters = ['Burger'];

                        $sql = "SELECT * from products";

                        if ($queries) {
                            $sql .= " WHERE ".implode(" AND ", $queries);
                        }

                        $stmt = $conn->prepare($sql);
                        $stmt->execute($parameters);
                        if ($stmt->rowCount()>0) {
                            foreach($stmt as $row) {
                                ?>
                                <div class="cardcol">
                                    <div class="card" style="width:300px">
                                        <?php
                                        echo '<img class="card-img" style="height:100%"  src="data:image/jpeg;base64,'.base64_encode($row["productIMG"]).'"/>';
                                        ?>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row["productName"];?></h5>
                                            <p class="card-text"><?php echo $row["productDesc"];?></p>
                                            <p class="card-text"><?php echo $row["productPrice"]; ?></p>
     
                                        </div>
                                        <div class="card-footer p-1">
                                           <form method="post" action="/admin/index.php?action=add&id=<?php echo$row["productID"]; ?>">  
                                                <input type="hidden" name="id" class="id" value="<?php echo $row['productID'] ?>"/>
                                                 <input type="text" name="quantity" class="form-control" value="1" />  
                                                <input type="hidden" name="hidden_name" value="<?php echo $row["productName"]; ?>" />  
                                                <input type="hidden" name="hidden_price" value="<?php echo $row["productPrice"]; ?>" />  
                                                <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />  

                                            </form>

                                        </div>
<!--                                    </div>-->
                                </div>
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
              </div>
            </section>
                    
            <!--  Drink Category   -->
            <section id="MenuCards">
                <h1>Drinks</h1>
                <div class="row">
                <?php
                    try {
                        $conn = dbconnect();

                        $queries = ['productCategory LIKE ?'];
                        $parameters = ['Drinks'];

                        $sql = "SELECT * from products";

                        if ($queries) {
                            $sql .= " WHERE ".implode(" AND ", $queries);
                        }

                        $stmt = $conn->prepare($sql);
                        $stmt->execute($parameters);
                        if ($stmt->rowCount()>0) {
                            foreach($stmt as $row) {
                                ?>
                                <div class="cardcol">
                                    <div class="card" style="width:300px">
                                        <?php
                                        echo '<img class="card-img" style="height:100%"  src="data:image/jpeg;base64,'.base64_encode($row["productIMG"]).'"/>';
                                        ?>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row["productName"];?></h5>
                                            <p class="card-text"><?php echo $row["productDesc"];?></p>
                                            <p class="card-text"><?php echo $row["productPrice"]; ?></p>
     
                                        </div>
                                        <div class="card-footer p-1">
                                           <form method="post" action="/admin/index.php?action=add&id=<?php echo$row["productID"]; ?>">  
                                                <input type="hidden" name="id" class="id" value="<?php echo $row['productID'] ?>"/>
                                                 <input type="text" name="quantity" class="form-control" value="1" />  
                                                <input type="hidden" name="hidden_name" value="<?php echo $row["productName"]; ?>" />  
                                                <input type="hidden" name="hidden_price" value="<?php echo $row["productPrice"]; ?>" />  
                                                <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />  

                                            </form>

                                        </div>
<!--                                    </div>-->
                                </div>
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
              </div> 
                    
             </div>
            </section>
            
        
             <div style="clear:both"></div>  
                <br />  
                <h3>Order Details</h3>  
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="40%">Item Name</th>  
                               <th width="10%">Quantity</th>  
                               <th width="20%">Price</th>  
                               <th width="15%">Total</th>  
                               <th width="5%">Action</th>  
                          </tr>  
                          <?php   
                          if(!empty($_SESSION["shopping_cart"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["shopping_cart"] as $keys => $values)  
                               {  
                          ?>  
                          <tr>  
                               <td><?php echo $values["item_name"]; ?></td>  
                               <td><?php echo $values["item_quantity"]; ?></td>  
                               <td>$ <?php echo $values["item_price"]; ?></td>  
                               <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>  
                               <td><a href="/admin/index.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>  
                          </tr>  
                          <?php  
                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                               }  
                          ?>  
                          <tr>  
                               <td colspan="3" align="right">Total</td>  
                               <td align="right">$ <?php echo number_format($total, 2); ?></td>  
                               <td></td>  
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
           <br />  
            
            
        </main>
    </body>
    <?php                 
    $conn->close();   
?>
<?php
    }
?>

    