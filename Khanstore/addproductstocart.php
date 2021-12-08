<?php
session_start();
error_reporting();
header('content-type:application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

$data = json_decode(file_get_contents("php://input"),true);


$qty=   isset($data['qty']) ? ($data['qty']) : NULL;
$status=   isset($data['status']) ? ($data['status']) : NULL;
$exchange_product=  isset($data['exchange_product']) ?($data['exchange_product']): NULL;
$exchange_price=    isset($data['exchange_price']) ? ($data['exchange_price']) : NULL;

$servername = "localhost";
$username = "ostechnix";
$password = "Password123#@!";
$dbname = "khanstore";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sql= "INSERT INTO cart(qty,status,exchange_product,exchange_price) VALUES ($qty,'$status','$exchange_product','$exchange_price')";

if (mysqli_query($conn,$sql))
 {
    echo json_encode(array('message'=>'cart product Record Inserted','status' => 'true'));
    //echo json_encode(['status'=>'success','result'=>'found']);
}
else {
    echo json_encode(array('message'=>'cart product Record Not Inserted','status' => 'false'));
    }


?>