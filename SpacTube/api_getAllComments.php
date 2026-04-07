<?php
include '../Db_Connection/db_spaceTube.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$response = [];

$vid = $_GET["vid"]; // Assuming you want to fetch comments for a specific video

// Check if video ID is provided
if (isset($vid)) {
    // Prepare SQL statement to fetch comments for the given video ID
    $fetchCommentsSql = "SELECT * FROM `tbl_comments` WHERE `v_id` = ? ORDER BY `date` DESC";
    $fetchCommentsStmt = $conn->prepare($fetchCommentsSql);
    $fetchCommentsStmt->bind_param('i', $vid);
    $fetchCommentsStmt->execute();
    $fetchCommentsResult = $fetchCommentsStmt->get_result();

    if ($fetchCommentsResult->num_rows > 0) {
        $comments = [];

        // Fetch all comments
        while ($row = $fetchCommentsResult->fetch_assoc()) {
            $comments[] = $row;
        }

        $response['status'] = 'true';
        $response['comments'] = $comments;
    } else {
        $response['status'] = 'false';
        $response['msg'] = 'No comments found for this video';
    }

    // Close the statement
    $fetchCommentsStmt->close();
} else {
    $response['status'] = 'false';
    $response['msg'] = 'Video ID not provided';
}

// Close the connection
$conn->close();

echo json_encode($response);
?>
