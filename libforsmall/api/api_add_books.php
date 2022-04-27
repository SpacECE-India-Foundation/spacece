<?php
include '../../Db_Connection/db_libforsmall.php';
header('Content-Type:application/json');

$user_id=$_POST['user_id'];

$product_cat=$_POST['product_cat'];
$product_brand=$_POST['product_brand'];
$product_title=$_POST['product_title'];
$product_price=$_POST['product_price'];
$product_qty =$_POST['product_qty'];
$product_desc =$_POST['product_desc'];

$product_keywords =$_POST['product_keywords'];
$exchange_price =$_POST['exchange_price'];
$rent_price =$_POST['rent_price'];
$deposit =$_POST['deposit'];

$image = $_FILES['image']['name'];
$product_image =$_FILES['image']['tmp_name'];
$target_path =  '../product_images/' . basename($_FILES["image"]["name"]);
$status=1;
move_uploaded_file($_FILES['image']['tmp_name'], $target_path);

$sql = "INSERT INTO `products`(`user_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_qty`, `product_desc`, `product_keywords`, `exchange_price`, `rent_price`, `deposit`,`status`) 
VALUES ('$user_id','$product_cat','$product_brand','$product_title','$product_price','$product_qty','$product_desc','$product_keywords','$exchange_price','$rent_price','$deposit','$status')";
  echo $sql; 
   
   $res = $conn->query($sql);


   

    if ($res) {
        // count that data is there or not in database
       
            echo json_encode(['status' => 'success',  'result' => 'Added']);
            //echo json_encode(['status'=>'success','result'=>'found']);


        
    } else {
        echo json_encode(['status' => 'failure', 'result' => 'not found']);
    }


