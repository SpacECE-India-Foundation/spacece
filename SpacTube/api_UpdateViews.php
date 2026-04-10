<?php
include '../Db_Connection/db_spaceTube.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$vid = $_GET["vid"];
$response = [];

// First, check if the video ID exists in the videos table
$checkVideoSql = "SELECT * FROM `videos` WHERE `v_id` = ?";
$checkVideoStmt = $conn->prepare($checkVideoSql);
$checkVideoStmt->bind_param('i', $vid);
$checkVideoStmt->execute();
$checkVideoResult = $checkVideoStmt->get_result();

if ($checkVideoResult->num_rows == 0) {
    // Video ID does not exist
    $response['status'] = 'false';
    $response['msg'] = 'Incorrect video ID';
} else {
    // Increase the views count by 1
    $conn->begin_transaction();

    try {
        // Increment the views count in the videos table
        $updateViewsSql = "UPDATE `videos` SET `views` = `views` + 1 WHERE `v_id` = ?";
        $updateViewsStmt = $conn->prepare($updateViewsSql);
        $updateViewsStmt->bind_param('i', $vid);
        $updateViewsStmt->execute();

        // Commit the transaction
        $conn->commit();

        $response['status'] = 'true';
        $response['msg'] = 'View count updated successfully';
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $conn->rollback();
        $response['status'] = 'false';
        $response['msg'] = 'Failed to update view count';
    }

    // Close statement
    if (isset($updateViewsStmt)) $updateViewsStmt->close();
}

// Close the checkVideoStmt statement
if (isset($checkVideoStmt)) $checkVideoStmt->close();

// Close the connection
$conn->close();

echo json_encode($response);
?>
