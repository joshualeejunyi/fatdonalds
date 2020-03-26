<!--  
    Project : Fatdonald's
    File: news.php
    Authors: Jeffrey, Joshua  
-->

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');

    if (isset($_POST['keyword'])) {
        if ($_POST['keyword'] === "") {
            $keyword = null;
        } else {
            $keyword = $_POST['keyword'];
        }
    }

    if ($_SESSION['admin'] !== true) {
            header('HTTP/1.0 404 not found'); 
            include($_SERVER['DOCUMENT_ROOT'].'/auth/404.html');
    } else {
        include($_SERVER['DOCUMENT_ROOT'].'/incl/adminhead.inc.php');
?>
<!DOCTYPE html>
<html lang="en">
    <?php
    include($_SERVER['DOCUMENT_ROOT'].'/incl/adminnav.inc.php');
    ?>
    <body>
        <main class="container">
            <section id="content">
                <?php
                    include($_SERVER['DOCUMENT_ROOT'].'/incl/admintop.inc.php');
                ?>  
                <section>
                    <h2>Products</h2>
                </section>

                <?php
                    if ($_SESSION['newsmsg']) {
                        echo "<div class='alert alert-success'>" . $_SESSION['newsmsg'] . "</div>";
                    }
                    if ($_SESSION['newserror']) {{
                        echo "<div class='alert alert-danger'>" . $_SESSION['newserror'] . "</div>";
                    }}
                ?>

                <?php
                    if ($_SESSION['delmsg']) {
                        echo "<div class='alert alert-success'>" . $_SESSION['delmsg'] . "</div>";
                    }
                    if ($_SESSION['delerror']) {
                        echo "<div class='alert alert-danger'>" . $_SESSION['delerror'] . "</div>";
                    }
                ?>

                <div id="accordion">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <button class="btn btn-dark" data-toggle="collapse" data-target="#actions" aria-expanded="true" aria-controls="actions">
                                Actions
                                </button>
                            </h5>
                        </div>

                        <div id="actions" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <form method="post">
                                    <h5><b><u>Filter</u></b></h5>
                                    <div class="form-group">
                                        <label for="keyword">Product Name:</label>
                                        <input type="text" class="form-control" name="keyword"></input>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit">Filter</button>
                                        <a href="" class="btn btn-danger">Clear Filter</a>
                                    </div>
                                </form>
                                
                                <hr>
                                <a href="/admin/newpost.php" class="btn btn-primary">Upload New Post</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row datacards">
                <?php
                    try {
                        $conn = dbconnect();

                        if ($keyword !== null) {
                            $sql = "SELECT * from news WHERE title LIKE ? ORDER BY created_timestamp DESC, edited_timestamp DESC";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute([$keyword]);
                        } else {
                            $sql = "SELECT * from news ORDER BY created_timestamp DESC, edited_timestamp DESC";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                        }

                        if ($stmt->rowCount()>0) {
                            foreach($stmt as $row) {
                                ?>
                                <div class="col-12">
                                    <a href="/admin/editnews.php?id=<?php echo $row["newsID"]; ?>">
                                    <div class="card mb-3 newscards">
                                        <div class="card-header">
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
                                    <div class="card-body">
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
                </div>
            </section>
        </main>
    </body>
</html>
<?php
    }
?>

