<?php
include '../../Db_Connection/db_libforsmall.php';
$owner_id=$_POST['owner_id'];
$sql = "SELECT * from orders Where owner_id='$owner_id'";
    $res = $conn->query($sql);
    if ($res) {
    header('Content-Type:application/json');
   
while($row=mysqli_fetch_assoc($res)){
    $data[]=array('order_id'=>$row['order_id'],
    'product_id'=>$row['product_id'],
    'product_id'=>$row['product_id'],
    'qty'=>$row['qty'],
    'trx_id'=>$row['trx_id'],
    'p_status'=>$row['p_status'],
    'grand_total'=>$row['grand_total'],
    'address'=>$row['address'],
    'mobile'=>$row['mobile'],
    'user_name'=>$row['user_name'],
    'owner_id'=>$row['owner_id'],
    'order_status'=>$row['order_status'],
    );
}
  
        // count that data is there or not in database
       
            echo json_encode(['status' => 'success',  'data' => $data,  'result' => 'found']);
            //echo json_encode(['status'=>'success','result'=>'found']);


        
    } else {
        echo json_encode(['status' => 'failure', 'result' => 'not found']);
    }
