<?php
// SubmitMilesStone_Task.php

require_once __DIR__ . '/../Db_Connection/db_spacece.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

function sendResponse(int $status, string $message): void
{
    http_response_code($status);
    echo json_encode([
        'status'  => $status,
        'message' => $message
    ], JSON_UNESCAPED_SLASHES);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse(405, 'Method Not Allowed');
}

// Required fields
$userId  = $_POST['userId']  ?? '';
$childId = $_POST['childId'] ?? '';
$taskId  = $_POST['taskId']  ?? '';

if (!is_numeric($userId) || !is_numeric($childId) || !is_numeric($taskId)) {
    sendResponse(400, 'userId, childId, taskId must be numeric.');
}

$userId  = (int)$userId;
$childId = (int)$childId;
$taskId  = (int)$taskId;

if ($userId <= 0 || $childId <= 0 || $taskId <= 0) {
    sendResponse(400, 'Invalid userId, childId or taskId.');
}

if (!isset($_FILES['taskVideo']) || $_FILES['taskVideo']['error'] !== UPLOAD_ERR_OK) {
    sendResponse(400, 'taskVideo is required and must be uploaded.');
}

$videoFile = $_FILES['taskVideo'];
$allowedTypes = ['video/mp4', 'video/mov', 'video/avi', 'video/quicktime'];
$maxSize = 50 * 1024 * 1024; // 50MB

if (!in_array($videoFile['type'], $allowedTypes)) {
    sendResponse(400, 'Invalid video format. Only MP4, MOV, AVI allowed.');
}
if ($videoFile['size'] > $maxSize) {
    sendResponse(400, 'Video too large. Max 50MB allowed.');
}

try {
    $conn->begin_transaction();

    // 1. Verify user owns the child
    $stmt = $conn->prepare("SELECT 1 FROM children WHERE id = ? AND parent_id = ?");
    $stmt->bind_param("ii", $childId, $userId);
    $stmt->execute();
    if ($stmt->get_result()->num_rows === 0) {
    $conn->rollback();
        sendResponse(403, 'Unauthorized: Child not found or access denied');
    }
    $stmt->close();

    // 2. Verify task exists and is a milestone
    $stmt = $conn->prepare("SELECT task_type, age_range_min FROM milestone_tasks WHERE id = ?");
    $stmt->bind_param("i", $taskId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        $conn->rollback();
        sendResponse(404, 'Task not found');
    }
    $task = $result->fetch_assoc();
    if ($task['task_type'] !== 'milestone') {
        $conn->rollback();
        sendResponse(400, 'This task is not a milestone');
    }
    $milestoneMinAge = (int)$task['age_range_min'];
    $stmt->close();

    // 3. Upload video
    $upload_dir = __DIR__ . '/../uploads/milestone_videos/';
    if (!is_dir($upload_dir) && !mkdir($upload_dir, 0755, true)) {
        $conn->rollback();
        sendResponse(500, 'Failed to create upload directory.');
    }

    $ext = strtolower(pathinfo($videoFile['name'], PATHINFO_EXTENSION));
    $ext = $ext ?: 'mp4';
    $video_filename = uniqid('milestone_') . '_' . time() . '.' . $ext;
    $target_path = $upload_dir . $video_filename;

    if (!move_uploaded_file($videoFile['tmp_name'], $target_path)) {
        $conn->rollback();
        sendResponse(500, 'Failed to save video on server.');
    }

    // 4. Build full public URL (same logic as addNewChild.php)
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443 ? 'https' : 'http';
    $base_url = $protocol . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    $video_url = $base_url . '/uploads/milestone_videos/' . $video_filename;

    // 5. Save to DB
    $stmt = $conn->prepare("
        INSERT INTO child_milestone_progress 
            (child_id, milestone_task_id, is_completed, video_url, updated_at)
        VALUES (?, ?, 1, ?, NOW())
        ON DUPLICATE KEY UPDATE 
            is_completed = 1,
            video_url = VALUES(video_url),
            updated_at = NOW()
    ");
    $stmt->bind_param("iis", $childId, $taskId, $video_url);
    $stmt->execute();
    $stmt->close();

    // 6. Auto-complete previous tasks
    $stmt = $conn->prepare("
        INSERT IGNORE INTO child_milestone_progress 
            (child_id, milestone_task_id, is_completed, updated_at)
        SELECT ?, mt.id, 1, NOW()
        FROM milestone_tasks mt
        WHERE mt.age_range_max < ?
    ");
    $stmt->bind_param("ii", $childId, $milestoneMinAge);
    $stmt->execute();
    $stmt->close();

    $conn->commit();

    // Success — Only status + message
    sendResponse(200, 'Task Submitted.');

} catch (Exception $e) {
    $conn->rollback();
    error_log("Video submission failed: " . $e->getMessage());
    sendResponse(500, 'Server error.');
}

$conn->close();
?>