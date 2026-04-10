<?php
include '../../Db_Connection/db_libforsmall.php';
$bytes = random_bytes(20);
//$rand_id=bin2hex($bytes);
$status=$_POST['status'];
$order_id=$_POST['order_id'];



$sql = "Update orders set p_status='$status' where order_id='$order_id'";
    $res = $conn->query($sql);
    header('Content-Type:application/json');

    if ($res) {
        // count that data is there or not in database
       
            echo json_encode(['status' => 'success',  'result' => 'Updated']);
            //echo json_encode(['status'=>'success','result'=>'found']);


        
    } else {
        echo json_encode(['status' => 'failure', 'result' => 'Invalid Details']);
    }
