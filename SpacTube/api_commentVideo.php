<?php
include '../Db_Connection/db_spaceTube.php';

// Set PHP time zone to IST
date_default_timezone_set('Asia/Kolkata');

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$vid = $_POST["vid"];
$uid = $_POST["uid"];
$u_comment = $_POST["u_comment"];

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
    // Video ID exists, proceed with adding the comment
    $conn->begin_transaction();

    try {
        // Get the current timestamp
        $timestamp = date("Y-m-d H:i:s");

        // Insert the comment into tbl_comments
        $insertCommentSql = "INSERT INTO `tbl_comments` (`u_no`, `v_id`, `u_comment`, `date`) VALUES (?, ?, ?, ?)";
        $insertCommentStmt = $conn->prepare($insertCommentSql);
        $insertCommentStmt->bind_param('iiss', $uid, $vid, $u_comment, $timestamp);
        $insertCommentStmt->execute();

        // Increment the cntcomment count in the videos table
        $updateCommentCountSql = "UPDATE `videos` SET `cntcomment` = `cntcomment` + 1 WHERE `v_id` = ?";
        $updateCommentCountStmt = $conn->prepare($updateCommentCountSql);
        $updateCommentCountStmt->bind_param('i', $vid);
        $updateCommentCountStmt->execute();

        // Commit the transaction
        $conn->commit();

        $response['status'] = 'true';
        $response['msg'] = 'Comment added successfully';
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $conn->rollback();
        $response['status'] = 'false';
        $response['msg'] = 'Failed to add comment';
    }

    // Close statements
    if (isset($insertCommentStmt)) $insertCommentStmt->close();
    if (isset($updateCommentCountStmt)) $updateCommentCountStmt->close();
}

// Close the checkVideoStmt statement
$checkVideoStmt->close();

// Close the connection
$conn->close();

echo json_encode($response);
?>
