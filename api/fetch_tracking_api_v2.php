<?php
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Action, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

include '../Db_Connection/db_libforsmall.php';

if (!isset($conn) || $conn->connect_error) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    die();
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405); // Method Not Allowed
        echo json_encode(['success' => false, 'message' => 'Invalid request method. Only POST is allowed.']);
        die();
    }

    if (!isset($_POST['user_id'])) {
        http_response_code(400); // Bad Request
        echo json_encode(['success' => false, 'message' => 'user_id is required.']);
        die();
    }

    $user_id = $_POST['user_id'];

    // Use prepared statement to prevent SQL injection
    $sql = "SELECT * FROM tracking WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    // Assuming user_id is a string ("s"). If it's an integer, use "i".
    $stmt->bind_param("s", $user_id); 
    
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        $count = $result->num_rows;
        if ($count > 0) {
            $arr = [];
            while ($row = $result->fetch_assoc()) {
                $arr[] = $row;
            }
            http_response_code(200);
            echo json_encode(['success' => true, 'data' => $arr]);
        } else {
            http_response_code(404); // Not Found
            echo json_encode(['success' => false, 'message' => 'User not found']);
        }
    }

    $stmt->close();

} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database Error: ' . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'General Error: ' . $e->getMessage()]);
}

$conn->close();
?>