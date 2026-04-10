<?php
include './db.php';
if(isset($_GET['get'])){

 $user_id=$_POST['user'];
 $delivery_id=$_POST['track_id'];
    //$tracking_id=$_GET['tracking_id'];
$sql="SELECT * from tracking Where user_id=$user_id and tracking_id=$delivery_id and is_Active='1' ";
$res = mysqli_query($con, $sql);

$row=mysqli_fetch_assoc($res);

echo json_encode($row);
}
//$lat2=$res['delivery_lat'];
//$lang2=$res['delivery_lang'];
if(isset($_GET['add'])){

    $user_id=$_POST['user'];
    $delivery_id=$_POST['track_id'];
    $lat=$_POST['lat'];
    $lang=$_POST['lang'];
    $sql="UPDATE  tracking SET delivery_lat=$lat,delivery_lang=$lang Where user_id=$user_id and tracking_id=$delivery_id and is_Active='1' ";


}