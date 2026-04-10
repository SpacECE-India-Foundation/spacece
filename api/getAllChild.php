<?php
require_once __DIR__ . '/../Db_Connection/db_spacece.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
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
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    sendResponse(405, 'Method Not Allowed – use GET');
}

// 2. Get userId
$userId = (int)($_GET['userId'] ?? 0);
if ($userId <= 0) {
    sendResponse(400, 'userId is required');
}

// 3. Fetch children
$stmt = $conn->prepare("
    SELECT id, child_name, dob, gender, center, child_image 
    FROM children 
    WHERE parent_id = ?
    ORDER BY child_name
");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$children = [];
while ($child = $result->fetch_assoc()) {
    $childId = (int)$child['id'];

    // Format DOB
    $dob = new DateTime($child['dob']);
    $child['dob'] = $dob->format('d/m/Y');

    // Image path
    $child['image'] = $child['child_image'] ? "uploads/children/{$child['child_image']}" : null;
    unset($child['child_image']);

    // Get latest growth
    $growthStmt = $conn->prepare("
        SELECT height, weight 
        FROM child_growth 
        WHERE child_id = ? 
        ORDER BY measured_at DESC 
        LIMIT 1
    ");
    $growthStmt->bind_param("i", $childId);
    $growthStmt->execute();
    $growthRes = $growthStmt->get_result();

    if ($growthRes->num_rows > 0) {
        $g = $growthRes->fetch_assoc();
        $child['height'] = (float)$g['height'];
        $child['weight'] = (float)$g['weight'];
    } else {
        $child['height'] = null;
        $child['weight'] = null;
    }
    $growthStmt->close();

    // Rename keys
    $child['childId'] = $childId;
    $child['childName'] = $child['child_name'];
    unset($child['id'], $child['child_name']);

    $children[] = $child;
}
$stmt->close();

$message = empty($children) ? 'No Records Found.' : 'Records Found.';
sendResponse(200, $message, ['children' => $children]);

$conn->close();
?>