<?php
/** Helper function to authenticate the login.*/
function getNews(){
    global $postedBy, $title, $text, $created_timestamp, $errorMsg, $success;

    // Create database connection.
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'],$config['password'], $config['dbname']);

    // Check connection
    if ($conn->connect_error){
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;  
    }
    else{
        $sql = "SELECT * FROM fat_news_post";

        // Execute the query
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
        // Note that email field is unique, so should only have one row in the result set.
            $row = $result->fetch_assoc();
            $postedBy = $row["postedBy"];
            $title = $row["title"];
            $text = $row["text"];
            $created_timestamp = $row["created_timestamp"];
        }
        else{
            $errorMsg = "Post not found...";
            $success = false;
        }
        $result->free_result();
    }
    $conn->close();
}
?>

<html>
    <head>
        <?php
        include "incl/header.inc.php";
        ?>
    </head>
    <body>
        <?php
        include "incl/nav.inc.php";
        ?>
        <main>
            <section id="block">
                <div class="container">
                    <!-- Blog section -->
                    <div class="card">
                        <?php
                            eval(getNews());
                            echo "<h2>$title</h2>";
                            echo "<h5>Posted by: $postedBy</h5>";
                            echo "<h5>Posted on: $created_timestamp</h5>";
                            echo "<br>";
                            echo "<p>$text</p>";
                        ?>
                    </div>
                    <br />
                    <div class="newsform">
                        <h2>Edit News</h2>
                        <form action="process_editnews.php" method="post">
                            <div class="form-group">
                                <label for="fname">Posted By:</label>
                                <input class="form-control" type="text" id="postedBy" maxlength="50" name="postedBy" placeholder="Enter your name">
                            </div>

                            <div class="form-group">
                                <label for="lname">Title:</label>
                                <input class="form-control" type="text" id="title" required maxlength="50" name="title" placeholder="Enter post title">
                            </div>

                            <div class="form-group">
                                <label for="email">Text:</label>
                                <input class="form-control" type="text" id="text" required name="text" placeholder="Enter text">
                            </div>
                               <br />
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    <br />
                </div>
            </section>
        
        </main>
        <br>
        <?php
        include "incl/footer.inc.php";
        ?>
    </body>
</html>