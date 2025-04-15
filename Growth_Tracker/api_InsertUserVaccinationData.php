<?php
// Include the database connection file
include '../Db_Connection/db_growth_tracker.php';

// Set headers to allow cross-origin requests
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if all required fields are present
    if (isset($_POST['u_id']) && isset($_POST['vaccine_id']) && isset($_POST['dose_number']) && isset($_POST['age']) && isset($_POST['status'])) {

        // Prepare the insert statement
        $stmt = $conn->prepare("INSERT INTO User_vaccination_record (u_id, vaccine_id, dose_number, age, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiisi", $_POST['u_id'], $_POST['vaccine_id'], $_POST['dose_number'], $_POST['age'], $_POST['status']);

        // Execute the insert statement
        if ($stmt->execute()) {
            echo json_encode(array("message" => "Record inserted successfully"));
        } else {
            // Check if the error is due to a duplicate entry
            if ($conn->errno == 1062) { 
                // Prepare the update statement
                $update_stmt = $conn->prepare("UPDATE User_vaccination_record SET status = ? WHERE u_id = ? AND vaccine_id = ? AND dose_number = ?");
                $update_stmt->bind_param("iiii", $_POST['status'], $_POST['u_id'], $_POST['vaccine_id'], $_POST['dose_number']);

                // Execute the update statement
                if ($update_stmt->execute()) {
                    echo json_encode(array("message" => "Record updated successfully"));
                } else {
                    echo json_encode(array("error" => "Error updating record: " . $update_stmt->error));
                }

                // Close the update statement
                $update_stmt->close();
            } else {
                echo json_encode(array("error" => "Error inserting record: " . $stmt->error));
            }
        }

        // Close the insert statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // Send error response if required fields are missing
        echo json_encode(array("error" => "Missing required fields"));
    }
} else {
    // Send error response if the request method is not POST
    echo json_encode(array("error" => "Invalid request method"));
}
?>
