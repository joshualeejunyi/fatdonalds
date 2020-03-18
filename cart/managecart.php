<?php

if(isset($_POST["productID"])) {
    foreach($_POST as $key => $value){
        $product[$key] = filter_var($value, FILTER_SANITIZE_STRING);
    }
        $statement = $conn->prepare("SELECT productName, productPrice FROM products WHERE productID=? LIMIT 1");
        $statement->bind_param('s', $product['productID']);
        $statement->execute();
        $statement->bind_result($product_name, $product_price);
        while($statement->fetch()){
        $product["product_name"] = $productName;
        $product["product_price"] = $productPrice;
        if(isset($_SESSION["products"])){
        if(isset($_SESSION["products"][$product['productID']])) 
        {
            $_SESSION["products"][$product['productID']]["product_qty"] = $_SESSION["products"][$product['productID']]["product_qty"] + $_POST["product_qty"];
        } else 
        {
            $_SESSION["products"][$product['productID']] = $product;
        }
        } else 
        {
            $_SESSION["products"][$product['productID']] = $product;
        }
        }
        $total_product = count($_SESSION["products"]);
    die(json_encode(array('products'=>$total_product)));
}
?>