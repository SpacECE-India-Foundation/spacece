<?php
include '../../Db_Connection/db_libforsmall.php';
header('Content-Type:application/json');

$deliboy_id=$_POST["delivery_boy_id"];
$order_id=$_POST['Order_id'];
$query = "UPDATE `orders` SET   delivery_boy_id='$deliboy_id' WHERE order_id = '$order_id'";

$statement = $conn->query($query);
if($statement){
    echo json_encode(['status' => 'success',    'result' => 'Updated']);
}else{
    echo json_encode(['status' => 'failure', 'result' => 'Error While  Updating']);
}
