<?php
 $user_id=$_SESSION['current_user_id'];
 $delivery_id=$_GET['id'];
    $tracking_id=$_GET['tracking_id'];
$sql="SELECT * from tracking Where user_id=$user_id,delivery_boy_id=$delivery_id and is_Active='1' ";
$res=mysqli_fetch_assoc($conn,$sql);

echo $res;
//$lat2=$res['delivery_lat'];
//$lang2=$res['delivery_lang'];