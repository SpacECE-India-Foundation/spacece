<?php
// Parent_GetChildren.php
require_once __DIR__ . '/../Db_Connection/db_spacece.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

function sendResponse($status, $message, $data = null) {
    http_response_code(200); // always 200 at HTTP level; status in body
    $res = ['status' => $status, 'message' => $message];
    if ($data !== null) $res['data'] = $data;
    echo json_encode($res);
    exit;
}

// ── Get userId ────────────────────────────────────────────
$userId = $_GET['userId'] ?? $_POST['userId'] ?? '';

if (!is_numeric($userId) || (int)$userId <= 0) {
    sendResponse(400, 'Valid userId is required.');
}
$userId = (int)$userId;

// ── Query children for this parent ───────────────────────
try {
    $stmt = $conn->prepare("
        SELECT 
            id,
            parent_id,
            child_name,
            dob,
            gender,
            center,
            child_image AS image
        FROM children
        WHERE parent_id = ?
        ORDER BY id ASC
    ");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    $children = [];
    while ($row = $result->fetch_assoc()) {
        // Calculate age
        $dob = $row['dob'] ? new DateTime($row['dob']) : null;
        $age = $dob ? (int)(new DateTime())->diff($dob)->y : null;

        $children[] = [
            'id'         => (int)$row['id'],
            'parent_id'  => (int)$row['parent_id'],
            'child_name' => $row['child_name'],
            'dob'        => $row['dob'],
            'age'        => $age,
            'gender'     => $row['gender'],
            'center'     => $row['center'],
            // Return relative path so JS can build the URL
            'image' => $row['image'] ? '/spacece-main/uploads/children/' . $row['image'] : null,
        ];
    }
    $stmt->close();

    if (empty($children)) {
        sendResponse(200, 'No children found.', ['children' => []]);
    }

    sendResponse(200, 'Children fetched successfully.', ['children' => $children]);

} catch (Exception $e) {
    sendResponse(500, 'Error: ' . $e->getMessage());
} finally {
    $conn->close();
}
?>
