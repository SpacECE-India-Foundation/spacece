<?php
session_start();


header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Methods: GET, OPTIONS");
header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405); // 405 Method Not Allowed
    echo json_encode(['success' => false, 'error' => ['code' => 405, 'message' => 'Method Not Allowed']]);
    exit();
}


include '../Db_Connection/db_spacece.php'; 


$uid = isset($_GET['uid']) ? filter_var($_GET['uid'], FILTER_VALIDATE_INT) : null;
$cid = isset($_GET['cid']) ? filter_var($_GET['cid'], FILTER_VALIDATE_INT) : null;
$subid = isset($_GET['subid']) ? filter_var($_GET['subid'], FILTER_VALIDATE_INT) : null;


if ((isset($_GET['uid']) && $uid === false) || (isset($_GET['cid']) && $cid === false) || (isset($_GET['subid']) && $subid === false)) {
    http_response_code(400); 
    echo json_encode(['success' => false, 'error' => ['code' => 400, 'message' => 'Invalid ID format. IDs must be integers.']]);
    exit();
}

$sql = '';
$params = [];
$types = '';

if ($cid && $subid) {
    $sql = "SELECT sc.cid, c.title, c.description, c.logo, c.type, c.mode, c.duration, c.price, sc.id, sc.introduction, sc.topic, sc.quote, sc.question, sc.video_url, sc.author
            FROM learnonapp_courses c
            INNER JOIN learnonapp_subcourses sc ON c.id = sc.cid
            WHERE c.id = ? AND sc.id = ?";
    $types = "ii";
    $params = [$cid, $subid];
} else if ($cid && $uid) {
    $sql = "SELECT lc.*, luc.id AS luc_id, luc.payment_status
            FROM learnonapp_courses lc
            LEFT JOIN learnonapp_users_courses luc ON lc.id = luc.cid AND luc.uid = ?
            WHERE lc.id = ?";
    $types = "ii";
    $params = [$uid, $cid];
} else if ($cid) {
    $sql = "SELECT * FROM `learnonapp_courses` WHERE `id` = ?";
    $types = "i";
    $params = [$cid];
} else if ($uid) {
    $sql = "SELECT c.*
            FROM learnonapp_users_courses uc
            INNER JOIN learnonapp_courses c ON uc.cid = c.id
            WHERE uc.uid = ?";
    $types = "i";
    $params = [$uid];
} else {
    
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10; 
    $offset = ($page - 1) * $limit;

    $sql = "SELECT * FROM `learnonapp_courses` LIMIT ? OFFSET ?";
    $types = "ii";
    $params = [$limit, $offset];
}

$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }
    
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result) {
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
            http_response_code(200); 
            echo json_encode(['success' => true, 'data' => $data]);
        } else {
            http_response_code(404); 
            echo json_encode(['success' => false, 'error' => ['code' => 404, 'message' => 'No results found.']]);
        }
    } else {
        http_response_code(500); 
        echo json_encode(['success' => false, 'error' => ['code' => 500, 'message' => 'Query execution failed.']]);
    }
    mysqli_stmt_close($stmt);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => ['code' => 500, 'message' => 'Failed to prepare SQL statement.']]);
}

mysqli_close($conn);

?>