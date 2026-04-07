<?php
require_once __DIR__ . '/../Db_Connection/db_spacece.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

function send($status, $message) {
    http_response_code(200);
    echo json_encode([
        'status'  => $status,
        'message' => $message
    ], JSON_UNESCAPED_SLASHES);
    exit;
}

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    send(400, 'Only POST method allowed');
}

// Get query params
$userId  = intval($_GET['userId'] ?? 0);
$childId = intval($_GET['childId'] ?? 0);

if ($userId <= 0 || $childId <= 0) {
    send(400, 'userId and childId are required in query params');
}

// Read JSON body
$input = json_decode(file_get_contents('php://input'), true);
if (!$input || !isset($input['taskId']) || !isset($input['completed'])) {
    send(400, 'Invalid JSON: taskId and completed are required');
}

$taskId    = intval($input['taskId']);
$completed = filter_var($input['completed'], FILTER_VALIDATE_BOOLEAN); // "true" → true, "false" → false

if ($taskId <= 0) {
    send(400, 'Invalid taskId');
}

try {
    // Start transaction
    $conn->begin_transaction();

    // Check if child belongs to user
    $stmt = $conn->prepare("SELECT 1 FROM children WHERE id = ? AND parent_id = ?");
    $stmt->bind_param("ii", $childId, $userId);
    $stmt->execute();
    if ($stmt->get_result()->num_rows === 0) {
        $conn->rollback();
        send(403, 'Unauthorized: Child not found or access denied');
    }
    $stmt->close();

    // Check if this task is a MILESTONE
    $stmt = $conn->prepare("SELECT task_type, age_range_min FROM milestone_tasks WHERE id = ?");
    $stmt->bind_param("i", $taskId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        $conn->rollback();
        send(404, 'Task not found');
    }
    $task = $result->fetch_assoc();
    $isMilestone = ($task['task_type'] === 'milestone');
    $milestoneMinAge = (int)$task['age_range_min'];
    $stmt->close();

    // Update the requested task
    $stmt = $conn->prepare("
        INSERT INTO child_milestone_progress (child_id, milestone_task_id, is_completed, updated_at)
        VALUES (?, ?, ?, NOW())
        ON DUPLICATE KEY UPDATE 
            is_completed = VALUES(is_completed),
            updated_at = NOW()
    ");
    $stmt->bind_param("iii", $childId, $taskId, $completed);
    $stmt->execute();
    $stmt->close();

    //  If a MILESTONE is marked TRUE → auto-complete ALL previous tasks
    if ($isMilestone && $completed) {
        // Get child's current age in months
        $stmt = $conn->prepare("SELECT TIMESTAMPDIFF(MONTH, dob, CURDATE()) AS age_months FROM children WHERE id = ?");
        $stmt->bind_param("i", $childId);
        $stmt->execute();
        $ageResult = $stmt->get_result()->fetch_assoc();
        $currentAgeMonths = (int)$ageResult['age_months'];
        $stmt->close();

        // Auto-complete all tasks where age_range_max < current milestone's min age
        $stmt = $conn->prepare("
            INSERT IGNORE INTO child_milestone_progress (child_id, milestone_task_id, is_completed, updated_at)
            SELECT ?, mt.id, 1, NOW()
            FROM milestone_tasks mt
            WHERE mt.age_range_max < ?
              AND mt.id != ?
        ");
        $stmt->bind_param("iii", $childId, $milestoneMinAge, $taskId);
        $stmt->execute();
        $stmt->close();
    }

    // Commit everything
    $conn->commit();

    send(200, 'Task Status Updated.');

} catch (Exception $e) {
    $conn->rollback();
    send(500, 'Server Error: ' . $e->getMessage());
}
?>