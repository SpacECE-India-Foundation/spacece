<?php
session_start();
include('../Db_Connection/db_spacece.php');

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$phone = trim($_POST['phone']);
$image = $_FILES['image']['name'];
$type = $_POST['type'];

$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Define the upload directory
$upload_dir = realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;

// Ensure the upload directory exists
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

$target_path = $upload_dir . basename($image);

if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
    $check = $conn->prepare("SELECT * FROM users WHERE u_email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(array('status' => 'error', "message" => "Email already exists!"));
        die();
    } else {
        if ($type == 'consultant') {
            $c_categories = trim($_POST['c_categories']);
            $c_office = trim($_POST['c_office']);
            $c_from_time = trim($_POST['c_from_time']);
            $c_to_time = trim($_POST['c_to_time']);
            $c_language = trim($_POST['c_language']);
            $c_fee = trim($_POST['c_fee']);
            $c_available_from = trim($_POST['c_available_from']);
            $c_available_to = trim($_POST['c_available_to']);
            $c_qualification = trim($_POST['c_qualification']);
            $redirectUrl = '../index.php';

            // Check if c_categories is a number, if not, assume it's a category name and fetch the corresponding cat_id
            if (!is_numeric($c_categories)) {
                $category_check = $conn->prepare("SELECT cat_id FROM consultant_category WHERE cat_name = ?");
                $category_check->bind_param("s", $c_categories);
                $category_check->execute();
                $category_result = $category_check->get_result();

                if ($category_result->num_rows > 0) {
                    $category_row = $category_result->fetch_assoc();
                    $c_categories = $category_row['cat_id'];
                } else {
                    echo json_encode(array('status' => 'error', "message" => "Invalid category name!"));
                    die();
                }
            }

            $sql = $conn->prepare("INSERT INTO users (u_name, u_email, u_password, u_mob, u_image, u_type) VALUES (?, ?, ?, ?, ?, ?)");
            $sql->bind_param("ssssss", $name, $email, $hashed_password, $phone, $image, $type);

            if ($sql->execute()) {
                $last_id = $conn->insert_id;

                $query = $conn->prepare("INSERT INTO consultant (u_id, c_category, c_office, c_from_time, c_to_time, c_language, c_fee, c_available_from, c_available_to, c_qualification) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $query->bind_param("isssssssss", $last_id, $c_categories, $c_office, $c_from_time, $c_to_time, $c_language, $c_fee, $c_available_from, $c_available_to, $c_qualification);

                if ($query->execute()) {
                    echo json_encode(array('status' => 'success', 'redirect_url' => $redirectUrl));
                    die();
                } else {
                    echo json_encode(array('status' => 'error', 'message' => "Error while inserting consultant data: " . $query->error));
                    die();
                }
            } else {
                echo json_encode(array('status' => 'error', 'message' => "Error while inserting user data: " . $sql->error));
                die();
            }
        } elseif ($type == 'customer') {
            $query = $conn->prepare("INSERT INTO users (u_name, u_email, u_password, u_mob, u_image, u_type) VALUES (?, ?, ?, ?, ?, ?)");
            $query->bind_param("ssssss", $name, $email, $hashed_password, $phone, $image, $type);
            $redirectUrl = './index.php';

            if ($query->execute()) {
                echo json_encode(array('status' => 'success', 'redirect_url' => $redirectUrl));
                die();
            } else {
                echo json_encode(array('status' => 'error', 'message' => "Error while registering user: " . $query->error));
                die();
            }
        } else {
            echo json_encode(array('status' => 'error', 'message' => "Invalid user type!"));
            die();
        }
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => "Error while uploading image!"));
    die();
}
?>

