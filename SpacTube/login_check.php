<?php
session_start();
include '../Db_Connection/db_spaceTube.php'; 

$name=mysqli_real_escape_string($conn,$_POST['name']);
$email=mysqli_real_escape_string($conn,$_POST['email']);
$user_id=mysqli_real_escape_string($conn,$_POST['user_id']);
$image=mysqli_real_escape_string($conn,$_POST['image']);

$_SESSION['USER_ID']=$user_id;
        

$res=mysqli_query($conn,"SELECT * from user where user_id='$user_id'");
$check=mysqli_num_rows($res);
        $row=mysqli_fetch_assoc($res);
        $_SESSION['NAME']=$row['name'];
        
if($check>0){

}else{
        mysqli_query($conn,"insert into user(name,email,image,user_id) values('$name','$email','$image','$user_id')");
        $_SESSION['NAME']=$name;
}

echo "done";
?>
