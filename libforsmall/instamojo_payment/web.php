<?php include '../../Db_Connection/db_libforsmall.php';

?>
<?php
$data =$_POST ;
$payment_id = $data['payment_id'];
$payment_request_id = $data['payment_request_id'];
$status = $data['status'];
$email = $data['buyer'];
$phone = $data['buyer_phone'];
$sql ="INSERT INTO `webhook`( `imojo`, `payment_id`, `status`,`email`,`phone`) VALUES ('$payment_id','$payment_request_id','$status','$email','$phone')";

mysqli_query($conn,$sql);

?>