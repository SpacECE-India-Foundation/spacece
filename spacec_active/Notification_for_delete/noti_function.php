<?php


include('includes/db.php');
include('../db.php');
if(isset($_GET['notifications'])){
$sql=mysqli_query($mysqli,"SELECT * FROM notifications ORDER BY ntfID DESC LIMIT 1") or die('Sql Query1 Error'. mysqli_error($mysqli));
    if(mysqli_num_rows($sql)>0){
       $data[]=mysqli_fetch_assoc($sql);
  	echo json_encode($data);

		}


}


if(isset($_GET['getNotification'])){

$id=$_POST['id'];
$sql=mysqli_query($mysqli,"SELECT * FROM notifications where ntfID=$id LIMIT 1") or die('Sql Query1 Error'. mysqli_error($mysqli));
    if(mysqli_num_rows($sql)>0){
       $data[]=mysqli_fetch_assoc($sql);
  	echo json_encode($data);

		}


}
if(isset($_GET['get'])){

$id=$_POST['no_id'];
$sql=mysqli_query($mysqli1,"SELECT * FROM spaceactive_activities where activity_no=$id LIMIT 1") or die('Sql Query1 Error'. mysqli_error($mysqli1));
    if(mysqli_num_rows($sql)>0){
       $data[]=mysqli_fetch_assoc($sql);
   echo json_encode($data);

      }


}
