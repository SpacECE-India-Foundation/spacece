<?php
session_start();
include('../Db_Connection/db_spacece.php');

if (!isset($_SESSION['current_user_id'])) {
    header('location:login.php');
    exit();
}

if (isset($_POST['name'], $_POST['email'], $_POST['phone'])) {
    $id = $_SESSION['current_user_id'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    
    $image = null;
    if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['fileToUpload']['name'];
        $image_tmp = $_FILES['fileToUpload']['tmp_name'];
        $upload_directory = '../img/users/';
        
        if (!move_uploaded_file($image_tmp, $upload_directory . $image)) {
            echo "File upload failed.";
            exit();
        }
    }
    
    if (!empty($_POST['password']) && $_POST['password'] === $_POST['cpassword']) {
        $password = trim($_POST['password']);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    } else {
        $sql_password = "SELECT u_password FROM users WHERE u_id='$id'";
        $result_password = mysqli_query($conn, $sql_password);
        $row_password = mysqli_fetch_assoc($result_password);
        $hashed_password = $row_password['u_password'];
    }

    if ($image) {
        $sql = "UPDATE users SET u_name='$name', u_email='$email', u_mob='$phone', u_image='$image', u_password='$hashed_password' WHERE u_id='$id'";
        $_SESSION['current_user_image'] = $image;
    } else {
        $sql = "UPDATE users SET u_name='$name', u_email='$email', u_mob='$phone', u_password='$hashed_password' WHERE u_id='$id'";
    }

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Profile updated successfully";
    } else {
        echo "Error updating profile";
    }
} else {
    echo "All fields are required";
}
?>