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
<!--                    <br />
                    <div class="card">
                      <h2>TITLE HEADING</h2>
                      <h5>Title description, Sep 2, 2017</h5>
                      <div class="fakeimg" style="height:200px;">Image</div>
                      <p>Some text..</p>
                    </div> second section end -->
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