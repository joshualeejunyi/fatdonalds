<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');
    if(isset($_GET['id'])) {
        $newsID=$_GET['id'];

        try {
            $conn = dbconnect();
            $stmt = $conn->prepare("SELECT * FROM news WHERE newsID = ?");
            $stmt->execute([$newsID]);

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch();
                $newstitle = $row["title"];
                $newstext = $row["text"];
                $postedby = $row["postedBy"];
                $createdts = $row["created_timestamp"];
                $editedts = $row["edited_timestamp"];
                $published = $row["published"];
            }

        } catch (PDOExcption $e) {
            $errorMsg = "Error: " . $e;
            $_SESSION['editproderror'] = $errorMsg;
            header('location: /admin/editproduct.php?id='.$newsID);
        } finally {
            $stmt = null;
            $conn = null;
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
                   <section class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title">Edit News</h2>
                    </div>
                    <div class="card-body">
                        <?php
                            if ($_SESSION['editnewsmsg']) {
                                echo "<div class='alert alert-success'>" . $_SESSION['editnewsmsg'] . "</div>";
                            }
                            if ($_SESSION['editnewserror']) {{
                                echo "<div class='alert alert-danger'>" . $_SESSION['editnewserror'] . "</div>";
                            }}
                        ?>
                        <form action="/admin/process_editnews.php" method="post">
                            <div class="form-group">  
                                <label for="newsid">
                                    ID:
                                </label>
                                <input type="number" class="form-control" id="newsid" name="newsid" readonly="readonly" value="<?php echo $newsID?>">
                            </div>
                            <div class="form-group">  
                                <label for="created">
                                    Created:
                                </label>
                                <input type="text" class="form-control" id="created" name="created" readonly="readonly" value="<?php echo $createdts?>">
                            </div>
                            <?php
                                if ($editedts !== null) {
                            ?>
                                <div class="form-group">  
                                    <label for="edited">
                                        Last Edited:
                                    </label>
                                    <input type="text" class="form-control" id="edited" name="edited" readonly="readonly" value="<?php echo $editedts?>">
                                </div>
                            <?php
                            }
                            ?>
                            <div class="form-group">  
                                <label for="newstitle">
                                    Title:
                                </label>
                                <input type="text" class="form-control" id="newstitle" name="newstitle" value="<?php echo $newstitle?>" required>
                            </div>
                            <div class="form-group">
                                <label for="newstext">
                                    Text:
                                </label>
                                <textarea class="form-control" name="newstext" id="newstext" rows="3"><?php echo $newstext ?></textarea>
                            </div>
                            <div class="form-check">
                                <?php 
                                    if ($published === "1") {
                                ?>
                                    <input type="checkbox" name="published" checked>
                                <?php
                                    } else {
                                ?>
                                    <input type="checkbox" name="published">
                                <?php    
                                }
                                ?>
                                <label>
                                    Published
                                </label>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                            <div class="form-group">
                                <a href="/admin/deletenews.php?id=<?php echo $newsID ?>" class="btn btn-danger" onclick="return confirmDelete()">Delete Post</a>
                            </div>
                        </form>
                    </div>
                </section>
            </section>
        </main>
    </body>
</html>
<?php
    }
?>

