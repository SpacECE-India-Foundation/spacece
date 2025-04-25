<?php
include '../Db_Connection/db_spaceTube.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$vid = $_GET["vid"];
$uid = $_GET["uid"];

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
    // Check if the user has already disliked the video
    $checkDislikeSql = "SELECT * FROM `tbl_dislike` WHERE `u_id` = ? AND `v_id` = ?";
    $checkDislikeStmt = $conn->prepare($checkDislikeSql);
    $checkDislikeStmt->bind_param('ii', $uid, $vid);
    $checkDislikeStmt->execute();
    $checkDislikeResult = $checkDislikeStmt->get_result();

    if ($checkDislikeResult->num_rows > 0) {
        // User has already disliked the video, remove the dislike and add a like
        $conn->begin_transaction();

        try {
            // Decrement the cntdislike count in the videos table
            $updateDislikeCountSql = "UPDATE `videos` SET `cntdislike` = `cntdislike` - 1 WHERE `v_id` = ?";
            $updateDislikeCountStmt = $conn->prepare($updateDislikeCountSql);
            $updateDislikeCountStmt->bind_param('i', $vid);
            $updateDislikeCountStmt->execute();

            // Delete the entry from tbl_dislike
            $deleteDislikeSql = "DELETE FROM `tbl_dislike` WHERE `u_id` = ? AND `v_id` = ?";
            $deleteDislikeStmt = $conn->prepare($deleteDislikeSql);
            $deleteDislikeStmt->bind_param('ii', $uid, $vid);
            $deleteDislikeStmt->execute();

            // Increment the cntlike count in the videos table
            $updateLikeCountSql = "UPDATE `videos` SET `cntlike` = `cntlike` + 1 WHERE `v_id` = ?";
            $updateLikeCountStmt = $conn->prepare($updateLikeCountSql);
            $updateLikeCountStmt->bind_param('i', $vid);
            $updateLikeCountStmt->execute();

            // Insert a new record into tbl_like
            $likeStatus = 1; // Assuming 1 means liked
            $insertLikeSql = "INSERT INTO `tbl_like` (`u_id`, `v_id`, `like_status`) VALUES (?, ?, ?)";
            $insertLikeStmt = $conn->prepare($insertLikeSql);
            $insertLikeStmt->bind_param('iii', $uid, $vid, $likeStatus);
            $insertLikeStmt->execute();

            // Commit the transaction
            $conn->commit();

            $response['status'] = 'true';
            $response['msg'] = 'Video liked successfully';
        } catch (Exception $e) {
            // Rollback the transaction in case of error
            $conn->rollback();
            $response['status'] = 'false';
            $response['msg'] = 'Failed to like the video';
        }

        // Close statements
        if (isset($updateDislikeCountStmt)) $updateDislikeCountStmt->close();
        if (isset($deleteDislikeStmt)) $deleteDislikeStmt->close();
        if (isset($updateLikeCountStmt)) $updateLikeCountStmt->close();
        if (isset($insertLikeStmt)) $insertLikeStmt->close();
    } else {
        // Check if the user has already liked the video
        $checkLikeSql = "SELECT * FROM `tbl_like` WHERE `u_id` = ? AND `v_id` = ?";
        $checkLikeStmt = $conn->prepare($checkLikeSql);
        $checkLikeStmt->bind_param('ii', $uid, $vid);
        $checkLikeStmt->execute();
        $checkLikeResult = $checkLikeStmt->get_result();

        if ($checkLikeResult->num_rows > 0) {
            // User has already liked the video, decrease cntlike by 1 and delete the entry from tbl_like
            $conn->begin_transaction();

            try {
                // Decrement the cntlike count in the videos table
                $updateLikeCountSql = "UPDATE `videos` SET `cntlike` = `cntlike` - 1 WHERE `v_id` = ?";
                $updateLikeCountStmt = $conn->prepare($updateLikeCountSql);
                $updateLikeCountStmt->bind_param('i', $vid);
                $updateLikeCountStmt->execute();

                // Delete the entry from tbl_like
                $deleteLikeSql = "DELETE FROM `tbl_like` WHERE `u_id` = ? AND `v_id` = ?";
                $deleteLikeStmt = $conn->prepare($deleteLikeSql);
                $deleteLikeStmt->bind_param('ii', $uid, $vid);
                $deleteLikeStmt->execute();

                // Commit the transaction
                $conn->commit();

                $response['status'] = 'true';
                $response['msg'] = 'Like removed successfully';
            } catch (Exception $e) {
                // Rollback the transaction in case of error
                $conn->rollback();
                $response['status'] = 'false';
                $response['msg'] = 'Failed to remove like';
            }

            // Close statements
            if (isset($updateLikeCountStmt)) $updateLikeCountStmt->close();
            if (isset($deleteLikeStmt)) $deleteLikeStmt->close();
        } else {
            // User has not liked the video, proceed to like the video
            $conn->begin_transaction();

            try {
                // Increment the cntlike count in the videos table
                $updateLikeCountSql = "UPDATE `videos` SET `cntlike` = `cntlike` + 1 WHERE `v_id` = ?";
                $updateLikeCountStmt = $conn->prepare($updateLikeCountSql);
                $updateLikeCountStmt->bind_param('i', $vid);
                $updateLikeCountStmt->execute();

                // Insert a new record into tbl_like
                $likeStatus = 1; // Assuming 1 means liked
                $insertLikeSql = "INSERT INTO `tbl_like` (`u_id`, `v_id`, `like_status`) VALUES (?, ?, ?)";
                $insertLikeStmt = $conn->prepare($insertLikeSql);
                $insertLikeStmt->bind_param('iii', $uid, $vid, $likeStatus);
                $insertLikeStmt->execute();

                // Commit the transaction
                $conn->commit();

                $response['status'] = 'true';
                $response['msg'] = 'Video liked successfully';
            } catch (Exception $e) {
                // Rollback the transaction in case of error
                $conn->rollback();
                $response['status'] = 'false';
                $response['msg'] = 'Failed to like the video';
            }

            // Close statements
            if (isset($updateLikeCountStmt)) $updateLikeCountStmt->close();
            if (isset($insertLikeStmt)) $insertLikeStmt->close();
        }

        // Close the checkLikeStmt statement
        $checkLikeStmt->close();
    }
}

// Close the checkVideoStmt statement
$checkVideoStmt->close();

// Close the connection
$conn->close();

echo json_encode($response);
?>
