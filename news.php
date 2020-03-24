<?php
    function getNews(){
        global $errorMsg, $success;
        
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
            $stmt = $conn->query($sql);
            foreach($stmt as $row)
            {
                echo " Title: ".$row["title"];
                if ($row["editedBy"] == NULL)
                {
                    echo " Posted By: ".$row["postedBy"];
                } 
                else 
                {
                    echo " Edited By: ".$row["editedBy"];
                }
                
                if ($row["edited_timestamp"] == NULL)
                {
                    echo " Posted on: ".$row["created_timestamp"];
                } 
                else 
                {
                    echo " Edited on: ".$row["edited_timestamp"];
                }
                echo $row["text"];
                echo "<br />";
            }
            
            if (!$conn->query($sql)){
                $errorMsg = "Databaseerror: " . $conn->error;$success = false;
            }
        }
    $conn->close();
}
?>

<!DOCTYPE html>
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
                            $updates = "getNews();";
                            eval ($updates);
                        ?>
                        <br />
                        <button> <a href='index.php'> Back to Home </button>
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