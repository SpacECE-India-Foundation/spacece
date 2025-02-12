<?php
include '../Db_Connection/db_spaceTube.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log function
function logDebug($message, $data = null) {
    $log = date('Y-m-d H:i:s') . " - " . $message;
    if ($data !== null) {
        $log .= " - Data: " . print_r($data, true);
    }
    error_log($log);
}

$vid = $_GET["vid"] ?? null;
$uid = $_GET["uid"] ?? null;

if (!$vid || !$uid) {
    echo json_encode(['status' => 'false', 'msg' => 'Missing vid or uid']);
    exit;
}

logDebug("Input parameters", ['vid' => $vid, 'uid' => $uid]);

try {
    $conn->begin_transaction();

    // Check if video exists
    $videoCheck = "SELECT v_id FROM videos WHERE v_id = '$vid'";
    $result = $conn->query($videoCheck);
    
    if (!$result) {
        throw new Exception("Video check failed: " . $conn->error);
    }

    if ($result->num_rows == 0) {
        throw new Exception("Video doesn't exist");
    }

    // Check if user already liked the video
    $likeCheck = "SELECT * FROM tbl_like WHERE u_id = '$uid' AND v_id = '$vid'";
    $result = $conn->query($likeCheck);
    
    if (!$result) {
        throw new Exception("Like check failed: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        // Remove like
        $deleteLike = "DELETE FROM tbl_like WHERE u_id = '$uid' AND v_id = '$vid'";
        if (!$conn->query($deleteLike)) {
            throw new Exception("Failed to remove like: " . $conn->error);
        }

        // Decrease like count
        $updateCount = "UPDATE videos SET cntlike = cntlike - 1 WHERE v_id = '$vid'";
        if (!$conn->query($updateCount)) {
            throw new Exception("Failed to update like count: " . $conn->error);
        }

        $conn->commit();
        logDebug("Like removed successfully");
        echo json_encode(['status' => 'true', 'msg' => 'Like removed successfully']);
    } else {
        // Add like
        $insertLike = "INSERT INTO tbl_like (u_id, v_id, like_status) VALUES ('$uid', '$vid', '1')";
        if (!$conn->query($insertLike)) {
            throw new Exception("Failed to insert like: " . $conn->error);
        }

        // Increase like count
        $updateCount = "UPDATE videos SET cntlike = cntlike + 1 WHERE v_id = '$vid'";
        if (!$conn->query($updateCount)) {
            throw new Exception("Failed to update like count: " . $conn->error);
        }

        $conn->commit();
        logDebug("Like added successfully");
        echo json_encode(['status' => 'true', 'msg' => 'Video liked successfully']);
    }
} catch (Exception $e) {
    $conn->rollback();
    logDebug("Transaction failed", $e->getMessage());
    echo json_encode(['status' => 'false', 'msg' => $e->getMessage()]);
}

$conn->close();
?>
