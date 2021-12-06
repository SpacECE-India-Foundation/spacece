<?php
include './db.php';
 $user_id=$_POST['user'];
 $delivery_id=$_POST['track_id'];
    //$tracking_id=$_GET['tracking_id'];
$sql="SELECT * from tracking Where user_id=$user_id and tracking_id=$delivery_id and is_Active='1' ";
$res = mysqli_query($con, $sql);

$row=mysqli_fetch_assoc($res);

echo json_encode($row);
//$lat2=$res['delivery_lat'];
//$lang2=$res['delivery_lang'];