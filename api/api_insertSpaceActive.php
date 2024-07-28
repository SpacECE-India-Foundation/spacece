<?php
header("Content-Type: application/json");

include '../Db_Connection/db_spacece_active.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the content type is JSON
    if (isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
        // Get the POST data from JSON input
        $data = json_decode(file_get_contents("php://input"), true);
    } else {
        // Get the POST data from form input
        $data = $_POST;

        // Handle file upload
        if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == UPLOAD_ERR_OK) {
            // Define the upload directory
            $upload_dir = getcwd() . DIRECTORY_SEPARATOR . '../img/users/';
            // Ensure the upload directory exists
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            // Get the original file name
            $file_name = basename($_FILES['image_url']['name']);
            // Define the full path to save the file
            $file_path = $upload_dir . $file_name;

            // Move the uploaded file to the destination directory
            if (move_uploaded_file($_FILES['image_url']['tmp_name'], $file_path)) {
                // Store the file path in the data array
                $data['image_url'] = $file_name; // Store the filename, not the full path
            } else {
                echo json_encode(["message" => "Failed to upload image"]);
                exit;
            }
        } else {
            $data['image_url'] = null; // or set to a default value
        }
    }

    // Check if all required fields are provided
    if (
        isset($data['activity_no'], $data['activity_name'], $data['activity_level'], $data['activity_dev_domain'], $data['activity_objectives'], $data['activity_key_dev'], $data['activity_material'], $data['activity_assessment'], $data['activity_process'], $data['activity_instructions'], $data['status'], $data['activity_date'], $data['playlist_id'], $data['playlist_descr'], $data['playlist_name'], $data['v_id'], $data['image_url'])
    ) {
        // Check if the activity_no already exists in the database
        $stmt_check = $mysqli1->prepare("SELECT activity_no FROM spaceactive_activities WHERE activity_no = ?");
        $stmt_check->bind_param("i", $data['activity_no']);
        $stmt_check->execute();
        $stmt_check->store_result();
        
        if ($stmt_check->num_rows > 0) {
            // Update if activity_no exists
            $stmt = $mysqli1->prepare("UPDATE spaceactive_activities SET activity_name=?, activity_level=?, activity_dev_domain=?, activity_objectives=?, activity_key_dev=?, activity_material=?, activity_assessment=?, activity_process=?, activity_instructions=?, status=?, activity_date=?, playlist_id=?, playlist_descr=?, playlist_name=?, v_id=?, image_url=? WHERE activity_no=?");
            $stmt->bind_param("sississsssssssssi", $data['activity_name'], $data['activity_level'], $data['activity_dev_domain'], $data['activity_objectives'], $data['activity_key_dev'], $data['activity_material'], $data['activity_assessment'], $data['activity_process'], $data['activity_instructions'], $data['status'], $data['activity_date'], $data['playlist_id'], $data['playlist_descr'], $data['playlist_name'], $data['v_id'], $data['image_url'], $data['activity_no']);
        } else {
            // Insert if activity_no does not exist
            $stmt = $mysqli1->prepare("INSERT INTO spaceactive_activities (activity_no, activity_name, activity_level, activity_dev_domain, activity_objectives, activity_key_dev, activity_material, activity_assessment, activity_process, activity_instructions, status, activity_date, playlist_id, playlist_descr, playlist_name, v_id, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isississsssssssss", $data['activity_no'], $data['activity_name'], $data['activity_level'], $data['activity_dev_domain'], $data['activity_objectives'], $data['activity_key_dev'], $data['activity_material'], $data['activity_assessment'], $data['activity_process'], $data['activity_instructions'], $data['status'], $data['activity_date'], $data['playlist_id'], $data['playlist_descr'], $data['playlist_name'], $data['v_id'], $data['image_url']);
        }

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(["message" => "Activity saved successfully"]);
        } else {
            echo json_encode(["message" => "Failed to save activity"]);
        }

        $stmt->close();
        $stmt_check->close();
    } else {
        echo json_encode(["message" => "Invalid input"]);
    }
} else {
    echo json_encode(["message" => "Invalid request method"]);
}

$mysqli1->close();
?>
