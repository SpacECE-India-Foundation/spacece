<?php
session_start();
include('../Db_Connection/db_spacece.php');
function isValidEmail($email)
{
    // Check if the email has a valid format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    // Extract domain name from email
    list(, $domain) = explode('@', $email);

    // Check if the domain has a valid MX record (valid email domain)
    return checkdnsrr($domain, 'MX');
}

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$phone = trim($_POST['phone']);
$image = $_FILES['image']['name'];
$type = $_POST['type'];

$hashed_password = md5($password);

$destination_path = getcwd() . DIRECTORY_SEPARATOR;

$target_path = $destination_path . '../img/users/' . basename($_FILES["image"]["name"]);

move_uploaded_file($_FILES['image']['tmp_name'], $target_path);

if (!isValidEmail($email)) {
    echo json_encode(array('status' => 'error', "message" => "Invalid email address or domain!"));
    die();
}

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
        $c_available_days = $_POST['selectedItem'];
        // Convert the comma-separated string into an array
        $days_array = explode(',', $c_available_days);

        // Get the first and last items
        $c_available_from = $days_array[0]; // Tuesday
        $c_available_to = end($days_array); // Thursday
        //$c_available_from = $_POST['c_available_from'];
        //$c_available_to = $_POST['c_available_to'];
        $c_qualification = $_POST['c_qualification'];
        //$redirectUrl = '../index.php';
        $sql = "INSERT INTO users (u_name, u_email, u_password, u_mob, u_image, u_type) VALUES ('$name', '$email', '$hashed_password', '$phone', '$image', '$type')";

        $result = mysqli_query($conn, $sql);

        $last_id = mysqli_insert_id($conn);

        $query = "INSERT INTO consultant (u_id, c_category, c_office, c_from_time, c_to_time, c_language, c_fee, c_available_from, c_available_to, c_qualification,c_aval_days) 
      VALUES ($last_id, $c_categories, '$c_office', '$c_from_time', '$c_to_time', '$c_language', '$c_fee', '$c_available_from','$c_available_to','$c_qualification','$c_available_days')";
        $result = mysqli_query($conn, $query);
        $redirectUrl = '../index.php';
    } else if (($type == 'customer') || ($type == 'admin') || ($type == 'book_owner') || ($type == 'delivery_boy')) {
        $conn1 = new mysqli(DB_HOST_NAME, DB_USER_NAME, DB_USER_PASSWORD, DB_NAME_SPACECE);
        // $conn1 = new mysqli('localhost', 'root', '', 'spacece');
        $query1 = "INSERT INTO users (u_name, u_email, u_password, u_mob, u_image, u_type) VALUES ('$name', '$email', '$hashed_password', '$phone', '$image', '$type')";
        $result = mysqli_query($conn1, $query1);

        $conn2 = new mysqli(DB_HOST_NAME, DB_USER_NAME, DB_USER_PASSWORD, DB_NAME_CONSULTANT_APP);
        // $conn2 = new mysqli('localhost', 'root', '', 'consultant_app');
        $query2 = "INSERT INTO `login`(username,name,email,phone) VALUES ('$name','$name', '$email','$phone')";
        $result = mysqli_query($conn2, $query2);
        $redirectUrl = '../index.php';
    } else {
        echo json_encode(array('status' => 'error', 'message' => "Invalid user type!"));
        die();
    }

    // $result = mysqli_query($conn, $query);

    if ($result) {
        echo json_encode(array('status' => 'success', 'message' => "Registration successful! Redirecting to login page...", 'redirectUrl' => $redirectUrl));
        die();
    } else {
        echo json_encode(array('status' => 'error', 'message' => "Error while registering user!"));
        die();
    }
}
