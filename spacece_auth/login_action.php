<?php
session_start();
include('db.php');

// if (isset($_POST['login'])) {
// Email login and md5 hashed password login
$email = trim($_POST['email']);
$password = md5(trim($_POST['password']));
$type = $_POST['type'];

if ($type) {
    $query = "SELECT * FROM users WHERE u_email = '$email' AND u_password = '$password' AND u_type = '$type'";
} else {
    echo json_encode(array('status' => 'error', 'message' => "Invalid user type!"));
    die();
}

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_assoc($result);

    if (isset($_POST['isAPI']) && $_POST['isAPI'] == true) {
        $data = array(
            'current_user_id' => $row['u_id'],
            'current_user_name' => $row['u_name'],
            'current_user_email' => $row['u_email'],
            'current_user_mob' => $row['u_mob'],
            'current_user_type' => $row['u_type'],
            'current_user_image' => $row['u_image'],
        );
        echo json_encode(array('status' => 'success', 'data' => $data));
        die();
    }

    $_SESSION['current_user_id'] = $row['u_id'];
    $_SESSION['current_user_email'] = $row['u_email'];
    $_SESSION['current_user_name'] = $row['u_name'];
    $_SESSION['current_user_mob'] = $row['u_mob'];
    $_SESSION['current_user_image'] = $row['u_image'];
    $_SESSION['current_user_type'] = $row['u_type'];

    $redirect_url = "index.php";

    if (isset($_SESSION['redirect_url'])) {
        $redirect_url = $_SESSION['redirect_url'];
        unset($_SESSION['redirect_url']);
    }
    // header('location: index.php');
    echo json_encode(array('status' => 'success', 'redirect_url' => $redirect_url));
    die();
} else {
    echo json_encode(array('status' => 'error', "message" => "Invalid email or password"));
    die();
}
// }
