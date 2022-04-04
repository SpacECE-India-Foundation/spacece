<?php
include './Db_Connection/db_spacece.php';
if(isset($_POST['update'])){


    $name=$_POST['name'];
    $email=$_POST['email'];
    $mob=$_POST['mobile'];
    $type=$_POST['type'];
  // $email= $_SESSION['current_user_email'];
$sql= "UPDATE  `users` SET 	u_name='$name',u_mob='$mob',u_type='$type' WHERE `u_email`='$email'";

$result =mysqli_query($conn,$sql);
if($result){
    echo "Success";
}
}