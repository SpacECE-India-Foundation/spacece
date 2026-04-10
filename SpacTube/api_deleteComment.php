<?php
include '../Db_Connection/db_spaceTube.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $vid = $_POST['vid'] ?? null;
    $comment_id = $_POST['id'] ?? null;

    if ($vid && $comment_id) {
        // Check if the video ID exists in the videos table
        $checkVideoSql = "SELECT * FROM `videos` WHERE `v_id` = ?";
        $checkVideoStmt = $conn->prepare($checkVideoSql);
        $checkVideoStmt->bind_param('i', $vid);
        $checkVideoStmt->execute();
        $checkVideoResult = $checkVideoStmt->get_result();

        if ($checkVideoResult->num_rows == 0) {
            $response['status'] = 'false';
            $response['msg'] = 'Incorrect video ID';
        } else {
            // Video ID exists, proceed with deleting the comment
            $conn->begin_transaction();

            try {
                // Delete the comment from tbl_comments
                $deleteCommentSql = "DELETE FROM `tbl_comments` WHERE `id` = ?";
                $deleteCommentStmt = $conn->prepare($deleteCommentSql);
                $deleteCommentStmt->bind_param('i', $comment_id);
                $deleteCommentStmt->execute();

                // Decrement the cntcomment count in the videos table
                $updateCommentCountSql = "UPDATE `videos` SET `cntcomment` = `cntcomment` - 1 WHERE `v_id` = ?";
                $updateCommentCountStmt = $conn->prepare($updateCommentCountSql);
                $updateCommentCountStmt->bind_param('i', $vid);
                $updateCommentCountStmt->execute();

                // Commit the transaction
                $conn->commit();

                $response['status'] = 'true';
                $response['msg'] = 'Comment deleted successfully';
            } catch (Exception $e) {
                // Rollback the transaction in case of error
                $conn->rollback();
                $response['status'] = 'false';
                $response['msg'] = 'Failed to delete comment';
            }

            // Close statements
            if (isset($deleteCommentStmt)) $deleteCommentStmt->close();
            if (isset($updateCommentCountStmt)) $updateCommentCountStmt->close();
        }

        // Close the checkVideoStmt statement
        $checkVideoStmt->close();
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Missing vid or id parameter.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

// Close the connection
$conn->close();

echo json_encode($response);
?>
