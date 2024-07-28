<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Content-Type: application/json; charset=UTF-8');

include_once '../Db_Connection/db_spacece.php';

// Check if email and u_mob are provided
if (isset($_POST['email'], $_POST['u_mob'])) {
    $email = $_POST['email'];
    $u_mob = $_POST['u_mob'];

    // Prepare SQL statement to check if the user exists
    $query = "SELECT * FROM users WHERE u_email = ? AND u_mob = ?";
    $stmt = $conn->prepare($query);

    // Check if statement was prepared successfully
    if ($stmt) {
        $stmt->bind_param('ss', $email, $u_mob); // 'ss' because both email and mobile are strings
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            http_response_code(200); // OK
            echo json_encode(array("message" => "User found."));
        } else {
            http_response_code(404); // Not Found
            echo json_encode(array("error" => "No user found with the provided email and mobile number."));
        }

        $stmt->close();
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(array("error" => "Database query failed. " . $conn->error));
    }
} else {
    http_response_code(400); // Bad Request
    echo json_encode(array("error" => "Missing required parameters: email and u_mob."));
}
?>
