<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Content-Type: application/json; charset=UTF-8');

include_once '../Db_Connection/db_spacece.php';

    if (isset($_POST['email'], $_POST['u_mob'], $_POST['password'])) {
        $email = $_POST['email'];
        $u_mob = $_POST['u_mob'];
        $new_password = $_POST['password'];

        // Hash the password using md5 (not recommended for security reasons)
        $hashed_password = md5($new_password);

        // Update password in the database
        $update_query = "UPDATE users SET u_password = ? WHERE u_email = ? AND u_mob = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param('sss', $hashed_password, $email, $u_mob);

        if ($update_stmt->execute()) {
            http_response_code(200); // OK
            echo json_encode(array("message" => "Password updated successfully."));
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(array("error" => "Failed to update password. Please try again."));
        }
    } else {
        http_response_code(400); // Bad Request
        echo json_encode(array("error" => "Missing required parameters: email, u_mob, and password."));
    }
