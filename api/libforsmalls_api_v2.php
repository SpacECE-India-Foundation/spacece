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

include '../Db_Connection/db_libforsmall.php';

// Check if the connection variable exists
if (!isset($conn) || $conn->connect_error) {
    http_response_code(500);
    echo json_encode(['status' => 'failure', 'result' => 'Database connection failed.']);
    die();
}

// Enable mysqli exceptions for try...catch block
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // This API should only respond to GET requests
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        http_response_code(405); // Method Not Allowed
        echo json_encode(['status' => 'error', 'result' => 'Invalid request method. Only GET is allowed.']);
        die();
    }

    // Check for the 'action' parameter
    if (isset($_GET['action']) && $_GET['action'] == "fetch_products") {
        
        // This specific query is safe as it takes no user input
        $sql = "SELECT * FROM `products` LIMIT 9";
        $res = $conn->query($sql);

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
                echo json_encode(['status' => 'failure', 'result' => 'not found', 'data' => []]);
            }
        }
        // No 'else' needed here, the try/catch block will handle query failures
    
    } else {
        http_response_code(400); // Bad Request
        echo json_encode(['status' => 'failure', 'result' => 'Missing or invalid action. Try ?action=fetch_products']);
    }

} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'failure', 'result' => 'Database Error: ' . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'failure', 'result' => 'General Error: ' . $e->getMessage()]);
}

$conn->close();
?>