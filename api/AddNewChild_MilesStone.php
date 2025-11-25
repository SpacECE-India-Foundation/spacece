<?php
// addNewChild.php -
require_once __DIR__ . '/../Db_Connection/db_spacece.php';

header('Content-Type: application/json');

function sendResponse($status, $message, $data = null) {
    http_response_code(200);
    $res = ['status' => $status, 'message' => $message];
    if ($data !== null) $res['data'] = $data;
    echo json_encode($res);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse(405, 'Method Not Allowed');
}

// === Get user_id from POST 
$user_id = $_POST['user_id'] ?? '';
if (!is_numeric($user_id) || $user_id <= 0) {
    sendResponse(400, 'Valid user_id is required.');
}
$user_id = (int)$user_id;

// === Input ===
$childName = trim($_POST['childName'] ?? '');
$dob = $_POST['dob'] ?? '';
$gender = strtolower(trim($_POST['gender'] ?? ''));
$center = trim($_POST['center'] ?? '');

if (empty($childName) || empty($dob) || empty($gender) || empty($center)) {
    sendResponse(400, 'All fields are required.');
}
if (!in_array($gender, ['male', 'female', 'other'])) {
    sendResponse(400, 'Invalid gender.');
}
if (!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $dob)) {
    sendResponse(400, 'DOB must be DD/MM/YYYY');
}

$dob_obj = DateTime::createFromFormat('d/m/Y', $dob);
if (!$dob_obj || $dob_obj->format('d/m/Y') !== $dob) {
    sendResponse(400, 'Invalid date');
}
$dob_mysql = $dob_obj->format('Y-m-d');

$today = new DateTime();
$diff = $today->diff($dob_obj);
$age_years = $diff->y + ($diff->m >= 6 ? 1 : 0);

if ($dob_obj > $today) {
    sendResponse(400, 'Future DOB not allowed');
}

// === Image Upload ===
$upload_dir = __DIR__ . '/../uploads/children/';
if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

$image_filename = null;
if (isset($_FILES['childImage']) && $_FILES['childImage']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['childImage'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($ext, $allowed)) sendResponse(400, 'Invalid image type');
    if ($file['size'] > 5 * 1024 * 1024) sendResponse(400, 'Image too large');

    $image_filename = uniqid('child_') . '.' . $ext;
    $target = $upload_dir . $image_filename;
    if (!move_uploaded_file($file['tmp_name'], $target)) {
        sendResponse(500, 'Image upload failed');
    }
}

// === Insert Child + Create Question Set ===
try {
    $conn->begin_transaction();

    $stmt = $conn->prepare("
        INSERT INTO children (parent_id, child_name, dob, gender, center, child_image)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("isssss", $user_id, $childName, $dob_mysql, $gender, $center, $image_filename);
    $stmt->execute();
    $child_id = $conn->insert_id;

    // Create question set
    $setStmt = $conn->prepare("
        INSERT INTO child_question_sets (child_id, age_year) 
        VALUES (?, ?)
        ON DUPLICATE KEY UPDATE age_year = VALUES(age_year)
    ");
    $setStmt->bind_param("ii", $child_id, $age_years);
    $setStmt->execute();
    $questionsId = $conn->insert_id;

    // Fetch questions
    $qStmt = $conn->prepare("
        SELECT c.id AS catId, c.name AS catName, q.question_text
        FROM questions q
        JOIN categories c ON q.category_id = c.id
        WHERE q.age_year = ?
        ORDER BY c.id, q.id
    ");
    $qStmt->bind_param("i", $age_years);
    $qStmt->execute();
    $result = $qStmt->get_result();

    $questions = [];
    $catMap = [];
    $qIndex = 1;
    $currentCat = null;

    while ($row = $result->fetch_assoc()) {
        $catId = $row['catId'];
        if ($currentCat !== $catId) {
            $currentCat = $catId;
            $qIndex = 1;
            if (!isset($catMap[$catId])) {
                $catMap[$catId] = true;
                $questions[] = [
                    'catId' => (string)$catId,
                    'catName' => $row['catName'],
                    'que' => []
                ];
            }
        }
        $questions[count($questions)-1]['que']['q' . $qIndex] = $row['question_text'];
        $qIndex++;
    }

    $conn->commit();

    sendResponse(201, 'Child added successfully.', [
        'childId' => $child_id,
        'childName' => $childName,
        'dob' => $dob,
        'gender' => $gender,
        'center' => $center,
        'image' => $image_filename ? "uploads/children/{$image_filename}" : null,
        'questionsId' => (string)$questionsId,
        'questions' => $questions
    ]);

} catch (Exception $e) {
    $conn->rollback();
    sendResponse(500, 'Error: ' . $e->getMessage());
}

$conn->close();
?>