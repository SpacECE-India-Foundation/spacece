<?php

$servername = "3.109.14.4";
$username = "ostechnix";
$password = "Password123#@!";
// $servername = "localhost";
// $username = "root";
// $password = "";
    $dbname = "spaceece";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
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