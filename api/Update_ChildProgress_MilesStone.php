<?php
require_once __DIR__ . '/../Db_Connection/db_spacece.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Handle CORS pre-flight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

/**
 * Unified response helper
 */
function sendResponse($httpCode, $message, $data = null) {
    http_response_code($httpCode);
    $res = [
        'status'  => $httpCode,
        'message' => $message
    ];
    if ($data !== null) {
        $res['data'] = $data;
    }
    echo json_encode($res);
    exit;
}

// ---------------------------------------------------------------
// 1. Validate request method
// ---------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse(405, 'Method Not Allowed – use POST');
}

// ---------------------------------------------------------------
// 2. Parse JSON payload
// ---------------------------------------------------------------
$input = json_decode(file_get_contents('php://input'), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    sendResponse(400, 'Invalid JSON payload');
}

// ---------------------------------------------------------------
// 3. Extract and validate required fields
// ---------------------------------------------------------------
$userId      = (int)($input['userId'] ?? 0);
$childId     = (int)($input['childId'] ?? 0);
$questionsId = (int)($input['questionsId'] ?? 0);
$answers     = $input['answers'] ?? [];

if ($userId <= 0 || $childId <= 0 || $questionsId <= 0 || empty($answers)) {
    sendResponse(400, 'userId, childId, questionsId and answers[] are required');
}

// ---------------------------------------------------------------
// 4. Verify ownership + fetch the age_year used when the set was created
// ---------------------------------------------------------------
$stmt = $conn->prepare("
    SELECT cqs.age_year
    FROM child_question_sets cqs
    JOIN children c ON cqs.child_id = c.id
    WHERE cqs.id = ? AND cqs.child_id = ? AND c.parent_id = ?
");
$stmt->bind_param("iii", $questionsId, $childId, $userId);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    sendResponse(403, 'Invalid userId, childId or questionsId – access denied');
}
$age_year = $res->fetch_assoc()['age_year'];
$stmt->close();

// ---------------------------------------------------------------
// 5. Pull all questions for that age, grouped by category
// ---------------------------------------------------------------
$qStmt = $conn->prepare("
    SELECT q.id AS question_id, c.id AS cat_id
    FROM questions q
    JOIN categories c ON q.category_id = c.id
    WHERE q.age_year = ?
    ORDER BY c.id, q.id
");
$qStmt->bind_param("i", $age_year);
$qStmt->execute();
$qResult = $qStmt->get_result();

$questionsByCat = [];   // cat_id => [question_id, ...]
while ($row = $qResult->fetch_assoc()) {
    $questionsByCat[$row['cat_id']][] = $row['question_id'];
}
$qStmt->close();

// ---------------------------------------------------------------
// 6. Map incoming answers to real question_ids
// ---------------------------------------------------------------
$progress = [];

foreach ($answers as $cat) {
    $catId   = (int)($cat['catId'] ?? 0);
    $ansList = $cat['ans'] ?? [];

    // Skip malformed category block
    if (!$catId || !isset($questionsByCat[$catId])) {
        continue;
    }

    $qIds       = $questionsByCat[$catId];   // ordered list for this category
    $expected   = ['q1', 'q2', 'q3'];        // we only accept these three
    $index      = 0;

    foreach ($expected as $qKey) {
        if (!isset($ansList[$qKey]) || !in_array($ansList[$qKey], ['1', '2'])) {
            continue;   // invalid or missing answer
        }
        if (!isset($qIds[$index])) {
            break;      // safety – should never happen
        }

        $progress[] = [
            'question_id' => $qIds[$index],
            'answer'      => $ansList[$qKey] === '1' ? 1 : 0
        ];
        $index++;
    }
}

// No usable answers after mapping
if (empty($progress)) {
    sendResponse(400, 'No valid answers were submitted');
}

// ---------------------------------------------------------------
// 7. Save / update progress (transactional)
// ---------------------------------------------------------------
try {
    $conn->autocommit(false);

    $upsert = $conn->prepare("
        INSERT INTO child_progress (child_id, question_id, answer)
        VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE
            answer      = VALUES(answer),
            updated_at  = CURRENT_TIMESTAMP
    ");

    foreach ($progress as $p) {
        $upsert->bind_param("iii", $childId, $p['question_id'], $p['answer']);
        $upsert->execute();
    }

    $conn->commit();
    sendResponse(200, 'Child Progress Updated Successfully');

} catch (Exception $e) {
    $conn->rollback();
    sendResponse(500, 'Database error: ' . $e->getMessage());
}

// ---------------------------------------------------------------
// 8. Clean-up
// ---------------------------------------------------------------
$conn->autocommit(true);
$conn->close();
?>