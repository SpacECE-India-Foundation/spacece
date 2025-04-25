<?php
include '../Db_Connection/db_spaceTube.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$vid = $_GET["vid"];
$response = [];

// Check if the video ID exists in the videos table
$checkVideoSql = "SELECT `cntlike`, `cntdislike`, `views`, `cntcomment` FROM `videos` WHERE `v_id` = ?";
$checkVideoStmt = $conn->prepare($checkVideoSql);
$checkVideoStmt->bind_param('i', $vid);
$checkVideoStmt->execute();
$checkVideoResult = $checkVideoStmt->get_result();

if ($checkVideoResult->num_rows == 0) {
    // Video ID does not exist
    $response['status'] = 'false';
    $response['msg'] = 'Incorrect video ID';
} else {
    // Video ID exists, fetch the counts
    $videoData = $checkVideoResult->fetch_assoc();
    $response['status'] = 'true';
    $response['cntlike'] = $videoData['cntlike'];
    $response['cntdislike'] = $videoData['cntdislike'];
    $response['cntcomment'] = $videoData['cntcomment'];
    $response['views'] = $videoData['views'];
}

// Close the statement and connection
$checkVideoStmt->close();
$conn->close();

echo json_encode($response);
?>
