<?php
session_start();
include('db.php');

// if (isset($_POST['register'])) {
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$phone = trim($_POST['phone']);
$image = $_FILES['image']['name'];

$hashed_password = md5($password);

$destination_path = getcwd() . DIRECTORY_SEPARATOR;

$target_path = $destination_path . 'images/' . basename($_FILES["image"]["name"]);

move_uploaded_file($_FILES['image']['tmp_name'], $target_path);

$check = "SELECT * FROM users WHERE u_email = '$email'";

$run = mysqli_query($conn, $check);

if (mysqli_num_rows($run) > 0) {
    echo json_encode(array('status' => 'error', "message" => "Email already exists!"));
    die();
} else {
    $query = "INSERT INTO users (u_name, u_email, u_password, u_mob, u_image) VALUES ('$name', '$email', '$hashed_password', '$phone', '$image')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        // header('location: login.php');
        echo json_encode(array('status' => 'success'));
        die();
    } else {
        echo json_encode(array('status' => 'error', 'message' => "Error while registering user!"));
        die();
    }
}
// }
