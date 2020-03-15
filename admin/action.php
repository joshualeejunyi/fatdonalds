<?php
 require'/admin/config.php';
 if(isset($_POST['pid'])){
     $pid = $_POST['pid'];
     $pname = $_POST['$pname'];
     $pprice = $_POST['pprice'];
     $pimage = $_POST['pimage'];
     $pcode = $_POST['pcode'];
     $pqty = 1;
     
     
     $stmt = $conn->prepare("SELECT productCode FROM cart WHERE productCode =?");
     $stmt -> bind_param("s",$pcode);
     $stmt -> execute ();
     $res = $stmt -> get_result();
     $r = $res -> fetch_assoc();
     $code = $r['product_code'];
     
     if(!$code){
         $query = $conn-> prepare("INSERT INTO cart (product_name, product_e, product_image, qty, total_price, product_code) VALUES(?,?,?,?,?,?);")
     ;
     
     $query -> bind_param("sssiss",$pname,$pprice, $pimage,$pqty, $pprice, $ppcode);
     $query-> execute();
     echo' <div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert" >$times; </button>'
     . '<strong> Item added to your cart! </strong> </div>';
     }
 else{
     echo '<div class="alert alert-danger alert-dismissible">'
     . '<button type="button" class = "close"'
             . 'data-dismiss="alert">&times;</button>'
             . '<strong> Item already added to your cart! </strong>'
             . '</div>';
 }
     
     
 }
 ?>