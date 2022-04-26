<?php
include '../../Db_Connection/db_libforsmall.php';
$bytes = random_bytes(20);
//$rand_id=bin2hex($bytes);
$user_id=$_POST['user_id'];
$product_id=$_POST['product_id'];
$qty=$_POST['qty'];
$p_status="Ordered";
$grand_total=$_POST['grand_total'];
$address=$_POST['address'];
$mobile=$_POST['mobile'];
$payment_id=bin2hex($bytes);
$user_name=$_POST['user_name'];
$u_note=$_POST['u_note'];
$owner_id=$_POST['owner_id'];


$sql = "INSERT INTO `orders`( `user_id`, `product_id`, `qty`, `trx_id`, `p_status`, `grand_total`, `address`, `mobile`, `payment_id`, `user_name`, `u_note`, `owner_id`) 
VALUES ('$user_id','$product_id','$qty','$payment_id','$p_status','$grand_total','$address','$mobile','$payment_id','$user_name','$u_note','$owner_id')";
    $res = $conn->query($sql);
    header('Content-Type:application/json');

    if ($res) {
        // count that data is there or not in database
       
            echo json_encode(['status' => 'success',  'result' => 'Added']);
            //echo json_encode(['status'=>'success','result'=>'found']);


        
    } else {
        echo json_encode(['status' => 'failure', 'result' => 'not found']);
    }
