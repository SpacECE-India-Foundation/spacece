<?php
session_start();
include('db.php');
if(!isset($_SESSION['current_user_id'])){
    header('location:login.php');
    exit();
}
var_dump($_FILES);
$id =$_SESSION['current_user_id'];
 if (isset($_POST['name'])) {
$name = trim($_POST['name']);
$email = trim($_POST['email']);

$phone = trim($_POST['phone']);
$image = $_FILES['fileToUpload']['name'];


$destination_path = getcwd() . DIRECTORY_SEPARATOR;

$target_path = $destination_path . '../img/users/' . basename($_FILES["fileToUpload"]["name"]);

move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path);
if(!empty($_POST['password'])){
    $password = trim($_POST['password']);
    $hashed_password = md5($password);
    if($_POST['password'] === $_POST['cpassword'] ){
        $sql="UPDATE `users` SET u_name='$name', u_email= '$email', u_mob='$phone', u_image='$image',u_password='$password' where u_id='$id'";
     
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "Success";
        }else{
            echo "Error ";
        }

    }else{
        echo "Password missmatch";
    }
}else{
    $sql="UPDATE `users` SET u_name='$name', u_email= '$email', u_mob='$phone', u_image='$image'  where u_id='$id'";
  echo $sql;
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "Success";
        }else{
            echo "Error ";
        }

}

 }