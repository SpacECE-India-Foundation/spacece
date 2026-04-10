<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

// Include your database connection script
include '../Db_Connection/db_spacece_active.php';

// Check if all required POST data are provided
if (isset($_POST['user_id'], $_POST['activity_no'], $_POST['workdone'])) {
    
    // Sanitize input data
    $user_id = intval($_POST['user_id']);
    $activity_no = intval($_POST['activity_no']);
    $workdone = intval($_POST['workdone']);
    $name = "NULL";
    $email = "NULL";
    $oauth_type = "NULL";
    $gender = "NULL";
    
    // Validate workdone value (-1, 0, 1)
    if (!in_array($workdone, [-1, 0, 1])) {
        http_response_code(400);
        echo json_encode(array("error" => "Invalid workdone value. Expected -1, 0, or 1."));
        exit();
    }

    // Prepare SQL statement to check if the entry already exists
    $stmt = $mysqli1->prepare("SELECT COUNT(*) FROM users WHERE user_id = ? AND activity_no = ?");
    $stmt->bind_param("ii", $user_id, $activity_no);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        // If the entry exists, update it
        $stmt = $mysqli1->prepare("UPDATE users SET workdone = ? WHERE user_id = ? AND activity_no = ?");
        $stmt->bind_param("iii", $workdone, $user_id, $activity_no);

        if ($stmt->execute()) {
            http_response_code(200); // OK
            echo json_encode(array("message" => "User activity updated successfully."));
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(array("error" => "Failed to update user activity."));
        }
        $stmt->close();
    } else {
        // If the entry does not exist, insert a new entry
        $stmt = $mysqli1->prepare("INSERT INTO users (user_id, activity_no, workdone, name, email, oauth_type, gender) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiissss", $user_id, $activity_no, $workdone, $name, $email, $oauth_type, $gender);

        if ($stmt->execute()) {
            http_response_code(201); // Created
            echo json_encode(array("message" => "User activity inserted successfully."));
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(array("error" => "Failed to insert user activity."));
        }
        $stmt->close();
    }

} else {
    // Bad request if POST data are missing
    http_response_code(400);
    echo json_encode(array("error" => "Missing required POST data."));
}
?>
