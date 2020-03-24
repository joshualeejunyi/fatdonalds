<?php
    if(isset($_GET['id'])) {
        $newsID=$_GET['id'];
        
        //Create Database Connection.
        $config = parse_ini_file('../../private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'],$config['password'], $config['dbname']);

        //Check Connection.
        if ($conn->connect_error){
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;  
        }
        else {
            $stmt = $conn->prepare("SELECT * FROM fat_news_post WHERE newsID = ?");
            $stmt->execute([$newsID]);

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch();
                $title = $row["title"];
                $postedBy = $row["postedBy"];
                $text = $row["text"];
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "incl/header.inc.php"; ?>
    </head>
    <body>
        <main class="container">
            <section id="content">
                <?php include "incl/nav.inc.php"; ?>  
                   <section class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title">Edit Post</h2>
                    </div>
                    <div class="card-body">
                        <form action="/admin/process_edit.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">  
                                <label for="title">
                                    Title:
                                </label>
                                <input type="text" class="form-control" id="title" name="title" value="<?php echo $title?>" required>
                            </div>
                            <div class="form-group">
                                <label for="editedBy">
                                    Edited By:
                                </label>
                                <input type="text" class="form-control" id="editedBy" name="editedBy" value="<?php echo $editedBy?>" required>
                            </div>
                            <div class="form-group">
                                <label for="text">
                                    Post Text:
                                </label>
                                <textarea class="form-control" name="text" id="text" rows="3"><?php echo $text ?></textarea>
                            </div>
                            <div class="form-check">
                                <?php 
                                    if ($display === "1") {
                                ?>
                                    <input type="checkbox" name="display" checked>
                                <?php
                                    } else {
                                ?>
                                    <input type="checkbox" name="display">
                                <?php    
                                }
                                ?>
                                    
                                <label>
                                    Display
                                </label>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </section>
            </section>
        </main>
    </body>
</html>

