<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

// Include your database connection script
include '../Db_Connection/db_spacece_active.php';

// Check if user_id is provided in GET request
if (isset($_GET['user_id'])) {

    // Sanitize input data
    $user_id = intval($_GET['user_id']);

    // Prepare SQL statement to fetch data
    $stmt = $mysqli1->prepare("SELECT activity_no, workdone FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    
    // Execute the statement
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $activities = array();

            // Fetch all rows and store them in an array
            while ($row = $result->fetch_assoc()) {
                $activities[] = $row;
            }

            // Respond with the activities data
            http_response_code(200); // OK
            echo json_encode(array("activities" => $activities));
        } else {
            // No activities found for the given user_id
            http_response_code(404); // Not Found
            echo json_encode(array("message" => "No activities found for the given user_id."));
        }
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(array("error" => "Failed to fetch user activities."));
    }
    
    $stmt->close();
    
} else {
    // Bad request if user_id is missing
    http_response_code(400);
    echo json_encode(array("error" => "Missing required GET parameter: user_id."));
}
?>
