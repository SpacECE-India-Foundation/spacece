<?php
session_start();
include('db.php');

// if (isset($_POST['register'])) {
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$phone = trim($_POST['phone']);
$image = $_FILES['image']['name'];
$type = $_POST['type'];

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
    if ($type == 'consultant') {
        $c_categories = $_POST['c_categories'];
        $c_office = $_POST['c_office'];
        $c_from_time = $_POST['c_from_time'];
        $c_to_time = $_POST['c_to_time'];
        $c_language = $_POST['c_language'];
        $c_fee = $_POST['c_fee'];
        $c_available_from = $_POST['c_available_from'];
        $c_available_to = $_POST['c_available_to'];
        $c_qualification = $_POST['c_qualification'];

        $sql = "INSERT INTO users (u_name, u_email, u_password, u_mob, u_image, u_type) VALUES ('$name', '$email', '$hashed_password', '$phone', '$image', '$type')";

        $result = mysqli_query($conn, $sql);

        $last_id = mysqli_insert_id($conn);

        $query = "INSERT INTO consultant (u_id, c_category, c_office, c_from_time, c_to_time, c_language, c_fee, c_available_from, c_available_to, c_qualification) VALUES ($last_id, $c_categories, '$c_office', '$c_from_time', '$c_to_time', '$c_language', '$c_fee', '$c_available_from', '$c_available_to', '$c_qualification')";
    } else if ($type == 'customer') {
        $query = "INSERT INTO users (u_name, u_email, u_password, u_mob, u_image) VALUES ('$name', '$email', '$hashed_password', '$phone', '$image')";
    } else {
        echo json_encode(array('status' => 'error', 'message' => "Invalid user type!"));
        die();
    }

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
