<?php
session_start();


header('Access-Control-Allow-Origin: *');
// Allow common methods and headers
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Action, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

// Handle OPTIONS preflight request (for CORS)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

// [This is the path you provided in your script]
include '../Db_Connection/db_spacece.php';

// Check connection
if (!isset($conn) || $conn->connect_error) {
    http_response_code(500); // Internal Server Error
    echo json_encode(['status' => 'failure', 'result' => 'Database connection failed.']);
    die();
}

// Enable mysqli exceptions to make the try/catch block work
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
  
    // FIX 1: Use == for comparison, not =
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'delete') {
        
        if (!isset($_POST['id'])) {
            http_response_code(400); // Bad Request
            echo json_encode(['status' => 'failure', 'result' => 'Course ID is required for deletion.']);
            die();
        }

        $course_id = $_POST['id'];

        // [FIX 2: Use prepared statements to prevent SQL Injection]
        $sql = "DELETE FROM learnonapp_courses WHERE id = ?";
        $stmt = $conn->prepare($sql);
        
        // "i" for integer. Change to "s" if your ID is a string/varchar.
        $stmt->bind_param("i", $course_id); 
        
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            // No row was deleted, probably because the ID didn't exist
            http_response_code(404); // Not Found
            echo json_encode(['status' => 'failure', 'result' => 'Course ID not found.']);
            die();
        }
        
        // If delete was successful, close the statement and let the script
        // continue to the "Fetch All" section to return the *new* list.
        $stmt->close();
    }

    
    
    $sql = "SELECT * FROM `learnonapp_courses`";
    $res = mysqli_query($conn, $sql); // $res will be set here

    // Check if the query itself was successful
    if ($res) {
        $count = mysqli_num_rows($res);
        $arr = []; // Initialize array

        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $arr[] = $row; // making array of data
            }
            http_response_code(200);
            echo json_encode(['status' => 'success', 'data' => $arr, 'result' => 'found']);
        } else {
            // No courses found (table is empty)
            http_response_code(200); // It's a successful request, just no data
            echo json_encode(['status' => 'success', 'data' => $arr, 'result' => 'not found']);
        }
    } 
    // The 'else' for a failed $res is handled by the try/catch block

} catch (mysqli_sql_exception $e) {
    
    http_response_code(500); // Internal Server Error
    echo json_encode(['status' => 'failure', 'result' => 'Database Error: ' . $e->getMessage()]);
} catch (Exception $e) {
   
    http_response_code(500); // Internal Server Error
    echo json_encode(['status' => 'failure', 'result' => 'General Error: ' . $e->getMessage()]);
}

// Close the connection
$conn->close();

// Exit the script.
exit;
?>