<?php
session_start();
header('Content-Type: application/json'); // send JSON back
include '../Db_Connection/db_spacece.php';

$data = json_decode(file_get_contents("php://input"), true);

// Check required data
if (!isset($_SESSION['current_user_id'], $data['video_id'], $data['course_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Missing data']);
    exit;
}

$user_id = intval($_SESSION['current_user_id']);
$vid = intval($data['video_id']);
$cid = intval($data['course_id']);

$stmt = $conn->prepare(
    "INSERT INTO learnonapp_user_video_progress (user_id, video_id, course_id, is_completed) VALUES (?, ?, ?, 1)"
);
$stmt->bind_param("iii", $user_id, $vid, $cid);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'DB insert failed: ' . $stmt->error]);
}
