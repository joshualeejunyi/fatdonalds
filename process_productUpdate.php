<?php
$success = true;
$product_name = $errorMsg = "";
$product_description = $errorMsg = "";
$product_category = $errorMsg = "";
$product_status = $errorMsg = "";
$product_image = $_FILES['product_image']['name'];


if (empty($_POST["product_name"]))
{
    $errorMsg .= "Product name is required.<br>";
    $success = false;
}
else
{
    $product_name = sanitize_input($_POST["product_name"]);
}

if (empty($_POST["product_description"]))
{
    $errorMsg .= "Product description is required.<br>";
    $success = false;
}
else
{
    $product_description = sanitize_input($_POST["product_description"]);
}


//edit here
if (empty($_POST["product_status"]))
{
    $errorMsg .= "Product status is required.<br>";
    $success = false;
}
else
{
     $product_status = sanitize_input($_POST["product_status"]);
}



if (empty($_POST["product_category"]))
{
    $errorMsg .= "Product_category is required.<br>";
    $success = false;
}
else
{
    $product_category = sanitize_input($_POST["product_category"]);
}



//if (empty($_POST["product_image"]))
//{
//    $errorMsg .= "Product image is required.<br>";
//    $success = false;
//}
//else
//{
//    $product_image = sanitize_input($_POST["product_image"]);
//}








//Helper function that checks input for malicious or unwanted content. 
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data); 
    return $data;
}
?>
</body>












<head>
    <?php
    include "HeadInclude.php";
    ?>
</head>
<body>
    <?php
    include "nav.inc.php";
    ?>
</body>

<?php
    if ($success)
    {
        saveProductToDB();
        echo "<h4>Registration successful!</h4>";
        echo "<p>Product has been successfully uploaded in database, " .  $lname;
        echo "<p>"."</p>";
        echo "<a href="."productUpdatePage.php".">" . "<input type='button' name='return' onclick='productUpdatePage.php' value='Add more products!'>";

    }
    else
    {
        echo "<h1>Oops!</h1>";
        echo "<h4>The following input errors were detected: </h4>";
        echo "<p>" . $errorMsg . "</p>";
        echo "<a href="."productUpdatePage.php".">" . "<input type='button' name='return' onclick='productUpdatePage.php' value='Add more products!'>";
    }
?>

<?php
include "footer.inc.php";
?>

</html>














<?php 
 
/*  * Helper function to write the member data to the DB  */ 
function saveProductToDB() 
{     
    global $product_name, $product_description, $product_category, $product_status, $product_image, $errorMsg, $success; 

    // Create database connection.
        $config = parse_ini_file('../../private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'],
                $config['password'], $config['dbname']); 
          
 
    // Check connection     
        if ($conn->connect_error)     
        {         
            $errorMsg = "Connection failed: " . $conn->connect_error;         
            $success = false;
        }     
        else     
        {         
            $sql = "INSERT INTO product_table (product_name, product_description, product_category, product_status,product_image)";
            $sql .= " VALUES ('$product_name', '$product_description', '$product_category', '$product_status',$product_image)"; 
        }
 
        // Execute the query         
        if (!$conn->query($sql))         
        {             
            $errorMsg = "Database error: " . $conn->error;
            $success = false;
        }
} 
    $conn->close(); 
?>












