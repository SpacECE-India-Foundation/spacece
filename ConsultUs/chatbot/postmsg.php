<?php
 session_start();
   
 include("../../Db_Connection/indexDB.php");

$msg= $_POST['text'];
$room= $_POST['room'];
$ip= $_POST['ip'];
$uname='';
if(isset($_SESSION['current_user_name'])){
$uname=$_SESSION['current_user_name'];
}

$sql="INSERT INTO `msg`( `msg`, `room`, `ip`, `rtime`,`u_name`) VALUES ('$msg','$room','$ip',CURRENT_TIMESTAMP,'$uname')";
$res = mysqli_query($conn,$sql);


?>