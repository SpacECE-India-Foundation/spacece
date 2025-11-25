<?php
require_once __DIR__ . '/../Db_Connection/db_spacece.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Handle CORS pre-flight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

function sendResponse($code, $message, $data = null) {
    http_response_code($code);
    $res = ['status' => $code, 'message' => $message];
    if ($data !== null) $res['data'] = $data;
    echo json_encode($res);
    exit;
}

// 1. Method check
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse(405, 'Method Not Allowed  use POST');
}

// 2. Get query params
$userId  = (int)($_GET['userId'] ?? 0);
$childId = (int)($_GET['childId'] ?? 0);
if ($userId <= 0 || $childId <= 0) {
    sendResponse(400, 'userId and childId are required in query string');
}

// 3. Read from $_POST (FormData)
$height = trim($_POST['height'] ?? '');
$weight = trim($_POST['weight'] ?? '');

if ($height === '' || $weight === '') {
    sendResponse(400, 'height and weight are required');
}
if (!is_numeric($height) || !is_numeric($weight) || $height <= 0 || $weight <= 0) {
    sendResponse(400, 'height and weight must be positive numbers');
}
$height = (float)$height;
$weight = (float)$weight;

// 4. Verify child belongs to parent
$stmt = $conn->prepare("SELECT id FROM children WHERE id = ? AND parent_id = ?");
$stmt->bind_param("ii", $childId, $userId);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    $stmt->close();
    sendResponse(403, 'Access denied: Invalid userId or childId');
}
$stmt->close();

// 5. Insert growth record
try {
    $conn->autocommit(false);

    $insert = $conn->prepare("
        INSERT INTO child_growth (child_id, height, weight, measured_at) 
        VALUES (?, ?, ?, NOW())
    ");
    $insert->bind_param("idd", $childId, $height, $weight);
    $insert->execute();
    $insert->close();

    $conn->commit();
    sendResponse(200, 'Child Growth Updated.');

} catch (Exception $e) {
    $conn->rollback();
    sendResponse(500, 'Database error: ' . $e->getMessage());
}

$conn->autocommit(true);
$conn->close();
?>
</DOCUMENT>