<?php

//action.php

include '../Db_Connection/db_libforsmall.php';

if($_POST['action'] == 'edit')
{


 $query = "
 UPDATE `orders` 
 SET p_status = '".$_POST["Status"]."'
 WHERE order_id = '".$_POST["Order_id"]."'
 ";
 $statement = $conn->query($query);
// $statement->execute($data);
 echo json_encode($_POST);
}

if($_POST['action'] == 'delete')
{
 $query = "
 DELETE FROM tbl_sample 
 WHERE order_id = '".$_POST["Order_id"]."'
 ";
 $statement = $conn->query($query);
 //$statement->execute();
 echo json_encode($_POST);
}


?>