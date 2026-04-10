<?php
require_once __DIR__ . '/../Db_Connection/db_spacece.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

function send($code, $msg, $data = null) {
    http_response_code($code);
    $res = ['status' => $code, 'message' => $msg];
    if ($data !== null) $res['data'] = $data;
    echo json_encode($res);
    exit;
}

$userId  = (int)($_GET['userId']  ?? 0);
$childId = (int)($_GET['childId'] ?? 0);

if ($userId <= 0 || $childId <= 0) {
    send(400, 'userId and childId are required');
}

// Verify child belongs to parent
$stmt = $conn->prepare("SELECT id FROM children WHERE id = ? AND parent_id = ?");
$stmt->bind_param("ii", $childId, $userId);
$stmt->execute();
if ($stmt->get_result()->num_rows === 0) {
    send(403, 'Access denied');
}
$stmt->close();

// Fetch growth records
$stmt = $conn->prepare("
    SELECT height, weight, measured_at 
    FROM child_growth 
    WHERE child_id = ? 
    ORDER BY measured_at ASC
");
$stmt->bind_param("i", $childId);
$stmt->execute();
$result = $stmt->get_result();

$growth = [];
while ($row = $result->fetch_assoc()) {
    $growth[] = $row;
}
$stmt->close();
$conn->close();

if (empty($growth)) {
    send(200, 'No growth records yet', ['growth' => []]);
}

send(200, 'Growth data fetched', ['growth' => $growth]);
?>