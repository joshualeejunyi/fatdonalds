<?php
    /** Helper function to write the news data to the DB*/
    function editNewsToDB(){
        global $postedBy, $title, $text, $errorMsg, $success;

        // Create database connection.
        $config = parse_ini_file('../../private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'],$config['password'], $config['dbname']);

        // Check connection
        if ($conn->connect_error){
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
            
        }
        else{
            $sql = "UPDATE fat_news_post (postedBy, title, text)";
            $sql .= " VALUES ('$postedBy', '$title', '$text')";

            // Execute the query
            if (!$conn->query($sql)){
                $errorMsg = "Databaseerror: " . $conn->error;$success = false;
            }
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
        <main class="container">
            <?php
            $postedBy = $title = $text = $errorMsg = "";
            $success = true;

            if (empty($_POST["postedBy"])){
                $errorMsg .= "A name is required.<br>";
                $success = false;
            }

            if (empty($_POST["title"])){
                $errorMsg .= "A title is required.<br>";
                $success = false;
            }

            if (empty($_POST["text"])){
                $errorMsg .= "Post content is required.<br>";
                $success = false;
            }
            else{
                $postedBy = sanitize_input($_POST["postedBy"]);
                $title = sanitize_input($_POST["title"]);
                $text = sanitize_input($_POST["text"]);
            }

            if ($success){
                $addnews = "submitNewsToDB();";
                eval($addnews);
                echo "<h1>Post Updated!</h1>";
                echo "<br>";
                echo "<button type='button' class='btn btn-default'> <a href='index.php'> Return to Home. </button>";
            }
            else{
                echo "<h4>The following input errors were detected:</h4>";
                echo "<p>" . $errorMsg . "</p>";
                echo"<button type='button' class='btn btn-danger' > <a href='admin_news.php'> Please try again. <a></button>";
            }

            //Helper function that checks input for malicious or unwanted content.
            function sanitize_input($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            ?>
        </main>
        <br>
        <?php
        include "incl/footer.inc.php";
        ?>
    </body>
</html>