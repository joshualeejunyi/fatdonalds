<?php
    include($_SERVER['DOCUMENT_ROOT'].'/auth/auth.php');

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
                        <h4 class="card-title">Upload News</h2>
                    </div>
                    <div class="card-body">
                        <?php
                            if ($_SESSION['newpostmsg']) {
                                echo "<div class='alert alert-success'>" . $_SESSION['newpostmsg'] . "</div>";
                            }
                            if ($_SESSION['newposterror']) {{
                                echo "<div class='alert alert-danger'>" . $_SESSION['newposterror'] . "</div>";
                            }}
                        ?>
                        <form action="/admin/process_news.php" method="post">
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
                                <input type="checkbox" name="published">
                                <label>
                                    Published
                                </label>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Upload</button>
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

