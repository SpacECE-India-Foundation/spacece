<?php
session_start();
include('db.php');
$id =$_SESSION['current_user_id'];
// if (isset($_POST['register'])) {
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$phone = trim($_POST['phone']);
$image = $_FILES['image']['name'];
$hashed_password = md5($password);

$destination_path = getcwd() . DIRECTORY_SEPARATOR;

$target_path = $destination_path . '../img/users/' . basename($_FILES["image"]["name"]);

move_uploaded_file($_FILES['image']['tmp_name'], $target_path);
if(isset($_POST['password'])){
    if($_POST['password'] === $_POST['cpassword'] ){
        $sql="UPDATE users SET name='$name' AND email= '$email' and phone='$phone' and password='$password' where u_id='$id'";
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
    $sql="UPDATE users SET name='$name' AND email= '$email' and phone='$phone'  where u_id='$id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "Success";
        }else{
            echo "Error ";
        }

}

