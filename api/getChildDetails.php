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

// 2. Get query params
$userId  = (int)($_GET['userId'] ?? 0);
$childId = (int)($_GET['childId'] ?? 0);
if ($userId <= 0 || $childId <= 0) {
    sendResponse(400, 'userId and childId are required in query string');
}

// 3. Verify ownership & fetch basic child info
$stmt = $conn->prepare("
    SELECT id, child_name, dob, gender, center, child_image
    FROM children
    WHERE id = ? AND parent_id = ?
");
$stmt->bind_param("ii", $childId, $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $stmt->close();
    sendResponse(403, 'Access denied: Invalid userId or childId');
}

$child = $result->fetch_assoc();
$stmt->close();

// Format basic data
$dob = new DateTime($child['dob']);
$formattedDob = $dob->format('d/m/Y');

$imagePath = $child['child_image'] ? "uploads/children/{$child['child_image']}" : null;

// 4. Get ALL growth records (for progress arrays)
$growthStmt = $conn->prepare("
    SELECT height, weight, DATE_FORMAT(measured_at, '%d/%m/%Y') AS date
    FROM child_growth
    WHERE child_id = ?
    ORDER BY measured_at ASC
");
$growthStmt->bind_param("i", $childId);
$growthStmt->execute();
$growthResult = $growthStmt->get_result();

$heightProgress = [];
$weightProgress = [];

while ($g = $growthResult->fetch_assoc()) {
    $heightProgress[] = [
        'date'   => $g['date'],
        'height' => (float)$g['height']
    ];
    $weightProgress[] = [
        'date'   => $g['date'],
        'weight' => (float)$g['weight']
    ];
}
$growthStmt->close();

// 5. Get latest height & weight (for top-level fields)
$latestStmt = $conn->prepare("
    SELECT height, weight
    FROM child_growth
    WHERE child_id = ?
    ORDER BY measured_at DESC
    LIMIT 1
");
$latestStmt->bind_param("i", $childId);
$latestStmt->execute();
$latestRes = $latestStmt->get_result();

$latestHeight = null;
$latestWeight = null;
if ($latestRes->num_rows > 0) {
    $latest = $latestRes->fetch_assoc();
    $latestHeight = (float)$latest['height'];
    $latestWeight = (float)$latest['weight'];
}
$latestStmt->close();

//  Get latest child progress answers per category
$progressStmt = $conn->prepare("
    SELECT 
        c.id AS catId,
        c.name AS catName,
        q.id AS question_id,
        cp.answer
    FROM child_progress cp
    JOIN questions q ON cp.question_id = q.id
    JOIN categories c ON q.category_id = c.id
    JOIN child_question_sets cqs ON q.age_year = cqs.age_year
    WHERE cp.child_id = ? AND cqs.child_id = ?
    ORDER BY c.id, q.id
");
$progressStmt->bind_param("ii", $childId, $childId);
$progressStmt->execute();
$progressResult = $progressStmt->get_result();

$childProgress = [];
$currentCat = null;
$catData = null;

while ($row = $progressResult->fetch_assoc()) {
    $catId = $row['catId'];
    
    if ($currentCat !== $catId) {
        if ($catData !== null) {
            $childProgress[] = $catData;
        }
        $currentCat = $catId;
        $catData = [
            'catId'   => (string)$catId,
            'catName' => $row['catName'],
            'ans'     => []
        ];
        $qIndex = 1;
    }

    // Only map first 3 questions per category
    if ($qIndex <= 3) {
        $catData['ans']['q' . $qIndex] = $row['answer'] == 1 ? "1" : "2"; // as string
    }
    $qIndex++;
}

// Push last category
if ($catData !== null) {
    $childProgress[] = $catData;
}
$progressStmt->close();

// 7. Build final response
$responseData = [
    'childId'         => (int)$child['id'],
    'childName'       => $child['child_name'],
    'dob'             => $formattedDob,
    'gender'          => $child['gender'],
    'center'          => $child['center'],
    'image'           => $imagePath,
    'height'          => $latestHeight,
    'weight'          => $latestWeight,
    'heightProgress'  => $heightProgress,
    'weightProgress'  => $weightProgress,
    'childProgress'   => $childProgress
];

sendResponse(200, 'Records Found.', $responseData);

$conn->close();
?>