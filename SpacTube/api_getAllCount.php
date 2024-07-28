<?php
include '../Db_Connection/db_spaceTube.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$response = [];

// Fetch cntlike, cntdislike, and cntcomment for each video
$fetchCountsSql = "SELECT `v_id`, `cntlike`, `cntdislike`, `cntcomment` FROM `videos`";
$fetchCountsResult = $conn->query($fetchCountsSql);

if ($fetchCountsResult->num_rows > 0) {
    $videos = [];
    while ($row = $fetchCountsResult->fetch_assoc()) {
        $videos[] = [
            'v_id' => $row['v_id'],
            'cntlike' => $row['cntlike'],
            'cntdislike' => $row['cntdislike'],
            'cntcomment' => $row['cntcomment']
        ];
    }
    $response['status'] = 'true';
    $response['videos'] = $videos;
} else {
    $response['status'] = 'false';
    $response['msg'] = 'No videos found';
}

// Close the connection
$conn->close();

echo json_encode($response);
?>
