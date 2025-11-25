<?php
require_once __DIR__ . '/../Db_Connection/db_spacece.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

/**
 * Send JSON response and exit
 */
function send(int $code, string $msg, ?array $data = null): void
{
    http_response_code($code);
    $response = ['status' => $code, 'message' => $msg];
    if ($data !== null) {
        $response['data'] = $data;
    }
    echo json_encode($response, JSON_UNESCAPED_SLASHES);
    exit;
}

// Validate request method
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    send(405, 'Use GET method');
}

// Get and validate parameters
$userId  = (int)($_GET['userId']  ?? 0);
$childId = (int)($_GET['childId'] ?? 0);

if ($userId <= 0 || $childId <= 0) {
    send(400, 'userId and childId are required');
}

// Fetch child DOB and current age in months
$stmt = $conn->prepare("
    SELECT dob, TIMESTAMPDIFF(MONTH, dob, CURDATE()) AS age_months
    FROM children
    WHERE id = ? AND parent_id = ?
");
$stmt->bind_param("ii", $childId, $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    send(403, 'Invalid child or access denied');
}

$child     = $result->fetch_assoc();
$ageMonths = (int)$child['age_months'];
$dob       = $child['dob'];
$stmt->close();

// Fetch all tasks matching child's current age (activities + milestones)
$stmt = $conn->prepare("
    SELECT 
        mt.id,
        mt.task_name AS task,
        mt.task_type AS type,
        mt.milestone_category AS category,
        mt.age_range_min,
        COALESCE(cmp.is_completed, 0) AS is_completed
    FROM milestone_tasks mt
    LEFT JOIN child_milestone_progress cmp
        ON cmp.milestone_task_id = mt.id AND cmp.child_id = ?
    WHERE mt.age_range_min <= ? AND mt.age_range_max >= ?
    ORDER BY 
        mt.age_range_min ASC,
        mt.task_type = 'activity' DESC,
        mt.id
");
$stmt->bind_param("iii", $childId, $ageMonths, $ageMonths);
$stmt->execute();
$result = $stmt->get_result();

$allTasks = [];
while ($row = $result->fetch_assoc()) {
    $date = date('d/m/Y', strtotime($dob . " + {$row['age_range_min']} months"));

    $allTasks[] = [
        'date'        => $date,
        'taskId'      => (string)$row['id'],
        'type'        => $row['type'],
        'category'    => $row['category'] ?? 'Uncategorized',
        'task'        => $row['task'],
        'isCompleted' => (bool)$row['is_completed']
    ];
}
$stmt->close();
$conn->close();

// Select exactly 3 activities + 1 milestone
$finalTasks     = [];
$activityCount  = 0;
$milestoneAdded = false;

foreach ($allTasks as $task) {
    if ($task['type'] === 'activity' && $activityCount < 3) {
        $finalTasks[] = $task;
        $activityCount++;
    } elseif ($task['type'] === 'milestone' && !$milestoneAdded) {
        $finalTasks[] = $task;
        $milestoneAdded = true;
    }
    if (count($finalTasks) >= 4) break;
}

// Count total and completed tasks
$milTotal = $milDone = $actTotal = $actDone = 0;
foreach ($allTasks as $t) {
    if ($t['type'] === 'milestone') {
        $milTotal++;
        if ($t['isCompleted']) $milDone++;
    } else {
        $actTotal++;
        if ($t['isCompleted']) $actDone++;
    }
}

// Send final response
send(200, 'Records Found.', [
    'childId'    => $childId,
    'milestones' => "$milDone/$milTotal",
    'activities' => "$actDone/$actTotal",
    'tasks'      => $finalTasks
]);
?>