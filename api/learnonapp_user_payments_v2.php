<?php
session_start();

// Set all necessary headers
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Action, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

// Handle OPTIONS preflight request
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

include '../Db_Connection/db_spacece.php';

// Check if the connection variable exists
if (!isset($conn) || $conn->connect_error) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'result' => 'Database connection failed.']);
    die();
}

// Enable mysqli exceptions for try...catch block
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        http_response_code(405); // Method Not Allowed
        echo json_encode(['status' => 'error', 'result' => 'Invalid request method. Only GET is allowed.']);
        die();
    }

    $sql = "";
    $param_type = "";
    $param_value = "";

    if (isset($_GET['uid'])) {
        $sql = "SELECT uc.*
                FROM users u, learnonapp_courses c, learnonapp_users_courses uc
                WHERE uc.uid = u.u_id AND uc.cid = c.id AND u.u_id = ?";
        $param_type = "s"; // Assuming u_id is a string. If integer, use "i".
        $param_value = $_GET['uid'];

    } elseif (isset($_GET['cid'])) {
        $sql = "SELECT uc.*
                FROM users u, learnonapp_courses c, learnonapp_users_courses uc
                WHERE uc.uid = u.u_id AND uc.cid = c.id AND c.id = ?";
        $param_type = "s"; // Assuming c.id is a string. If integer, use "i".
        $param_value = $_GET['cid'];
        
    } else {
        http_response_code(400); // Bad Request
        echo json_encode(['status' => 'error', 'result' => 'Missing uid or cid parameter.']);
        die();
    }

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($param_type, $param_value);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res) {
        $count = $res->num_rows;
        if ($count > 0) {
            $arr = [];
            while ($row = $res->fetch_assoc()) {
                $arr[] = $row;
            }
            http_response_code(200);
            echo json_encode(['status' => 'success', 'data' => $arr, 'result' => 'found']);
        } else {
            http_response_code(404); // Not Found
            echo json_encode(['status' => 'error', 'result' => 'not found', 'data' => []]);
        }
    }
    $stmt->close();

} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'result' => 'Database Error: ' . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'result' => 'General Error: ' . $e->getMessage()]);
}

$conn->close();
?>