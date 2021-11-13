<?php include('connect.php')?>
<?php
echo '<pre>';
print_r($_POST);
echo '</pre>';

/*$data =$_POST ;
$payment_id = $data['payment_id'];
$payment_request_id = $data['payment_request_id'];
$status = '';
$sql ="INSERT INTO `webhook`( `imojo`, `payment_id`, `status`) VALUES ('$payment_id','$payment_request_id','$status')";

mysqli_query($conn,$sql);*/

?>