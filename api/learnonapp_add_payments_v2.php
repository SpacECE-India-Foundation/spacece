<?php
session_start();

// Headers must be sent before any output
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Action, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

// Handle OPTIONS preflight request
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Include your database connection
include '../Db_Connection/db_spacece.php';

// Check if the connection variable exists
if (!isset($conn) || $conn->connect_error) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed.']);
    die();
}

// Enable mysqli exceptions for try...catch block
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // This API appears to use GET parameters
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        http_response_code(405); // Method Not Allowed
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method. Only GET is allowed.']);
        die();
    }

    // Check for all required parameters, including session variables
    if (!isset($_SESSION['current_user_id'])) {
         http_response_code(400); // Bad Request
         echo json_encode(['status' => 'error', 'message' => 'User session not found. Please log in.']);
         die();
    }
    if (!isset($_SESSION['course_id'])) {
         http_response_code(400);
         echo json_encode(['status' => 'error', 'message' => 'Course ID not found in session.']);
         die();
    }
    if (!isset($_GET['payment_status']) || !isset($_GET['payment_id'])) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Missing payment_status or payment_id parameters.']);
        die();
    }

    // All parameters are present
    $uid = $_SESSION['current_user_id'];
    $cid = $_SESSION['course_id'];
    $payment_status = $_GET['payment_status'];
    $payment_id = $_GET['payment_id'];

    // Use prepared statement to prevent SQL injection
    $sql = "INSERT INTO `learnonapp_users_courses` (`payment_details`, `user_id`, `course_id`, `payment_status`) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    // Assuming all values are stored as strings. If user_id or course_id are integers, change "s" to "i"
    $stmt->bind_param("ssss", $payment_id, $uid, $cid, $payment_status);

    if ($stmt->execute()) {
        http_response_code(200);
        echo json_encode(['status' => 'success', 'message' => "Payment Successful"]);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => "Payment Failed (Statement Execute)"]);
    }
    $stmt->close();

} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Database Error: ' . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'General Error: ' . $e->getMessage()]);
}

$conn->close();
?>