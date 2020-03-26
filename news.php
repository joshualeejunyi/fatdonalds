<!-- 
    Project : Fatdonald's
    File: news.php
    Authors: Jeffrey, Joshua
 -->
<?php  
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');

    if (isset($_SESSION["admin"])) {
        if ($_SESSION["admin"] === true) {
            header('location: /admin/products.php');
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/incl/head.inc.php');
    ?>
    <body data-spy="scroll" data-target="#navbar-menu" data-offset="100">
        <?php
            include($_SERVER['DOCUMENT_ROOT'].'/incl/nav.inc.php');
        ?>
        <header>
            <div class="row">
                <div class="col">
                    <div class="banner">
                        <h1>News</h1>
                    </div>
                </div>
            </div>
        </header>
        <main class="container">
            <section class="row datacards">
                <?php
                    try {
                        $conn = dbconnect();

                        if ($keyword !== null) {
                            $sql = "SELECT * from news WHERE title LIKE ? AND published = 1 ORDER BY created_timestamp DESC, edited_timestamp DESC";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute([$keyword]);
                        } else {
                            $sql = "SELECT * from news WHERE published = 1 ORDER BY created_timestamp DESC, edited_timestamp DESC";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                        }

                        if ($stmt->rowCount()>0) {
                            foreach($stmt as $row) {
                                ?>
                                <div class="col-12 ">
                                    <a href="/viewpost.php?id=<?php echo $row["newsID"]; ?>">
                                    <div class="card mb-3 newscards">
                                        <div class="card-header prod-name">
                                            <h4><?php 
                                                
                                                echo $row["title"];
                                                ?>
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-text">
                                                <?php echo $row["text"];?>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                    <?php
                            }
                        } else {
                    ?>
                        <div class="col-12">
                            <div class="card mb-3 newscards">
                                <div class="card-body" style="color: black;">
                                    <h4>
                                        No Posts Found
                                    </h4>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                                        </div>
                                    </div>        
                                </div>
                <?php
                    } catch (PDOException $e) {
                        $errorMsg = "Connection failed: " . $e;
                        $_SESSION['proderror'] = $errorMsg;
                    } finally {
                        $conn = null;
                        $stmt = null;
                    }
                ?>
            </section>
        </main>
    </body>
    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/incl/footer.inc.php');
    ?>
</html>
