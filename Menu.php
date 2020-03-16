<?php   
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
    include($_SERVER['DOCUMENT_ROOT'].'/incl/head.inc.php');
    include($_SERVER['DOCUMENT_ROOT'].'/incl/nav.inc.php');
?>
<style>
.collapsible {
  background-color: #777;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}

.active, .collapsible:hover {
  background-color: #555;
}

.card-group {
  padding: 0 18px;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
  background-color: #f1f1f1;
}
</style>

    <body>
        <main class="container">
            <section id="MenuCards">
                <section>
                    <h2>Products</h2>
                </section>
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
                                            <button class="collapsible">
                                                 <?php echo $catrow["productCategory"];?>
                                            </button>
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
                                                                    <div class="card-body">
                                                                        <p class="card-text"><?php echo $row["productDesc"];?></p>
                                                                        <h5 class="card-text">Price: $<?php echo $row["productPrice"];?></h5>
                                                                    </div>
                                                                    <div class="card-footer">
                                                                       <input name="productID" type="hidden" value="<?php echo $row["productID"]; ?>">
                                                                       <button type="submit">Add to Cart</button>
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
<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
</script>
