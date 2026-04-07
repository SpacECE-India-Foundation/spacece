<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');

// ── Preflight ─────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Allow only GET & POST
if (!in_array($_SERVER['REQUEST_METHOD'], ['POST', 'GET'])) {
    echo json_encode([
        'status' => 405,
        'message' => 'Method Not Allowed'
    ]);
    exit;
}

// ── API Base URL ──────────────────────────────────────────
define('BASE_API_URL', 'http://localhost/spacece-main/api');

// ── Endpoint Mapping ──────────────────────────────────────
$endpoints = [
    // Child
    'add_child'        => BASE_API_URL . '/AddNewChild_MilesStone.php',
    'get_children'     => BASE_API_URL . '/Parent_GetChildren.php',

    // Growth
    'get_growth'       => BASE_API_URL . '/Get_ChildGrowth.php',
    'update_growth'    => BASE_API_URL . '/Update_ChildGrowth.php', // ✅ FIX ADDED

    // Tasks
    'get_tasks'        => BASE_API_URL . '/Get_MilesStoneTask.php',
    'update_task'      => BASE_API_URL . '/Update_TaskMilesStone.php',
    'submit_milestone' => BASE_API_URL . '/SubmitMilesStone_Task.php',
];

// GET-type actions
$getActions = ['get_children', 'get_tasks', 'get_growth'];

// ── Get Action ────────────────────────────────────────────
$action = trim($_POST['action'] ?? $_GET['action'] ?? '');

if ($action === '') {
    echo json_encode([
        'status' => 400,
        'message' => 'Missing action'
    ]);
    exit;
}

if (!array_key_exists($action, $endpoints)) {
    echo json_encode([
        'status' => 400,
        'message' => 'Unknown action: ' . htmlspecialchars($action)
    ]);
    exit;
}

$backendURL  = $endpoints[$action];
$isGetAction = in_array($action, $getActions);

// Merge params
$params = array_merge($_GET, $_POST);
unset($params['action']);

// Debug log
error_log("[API PROXY] Action: $action | Params: " . json_encode($params));

// ── CURL START ────────────────────────────────────────────
$ch = curl_init();

if ($isGetAction) {
    $query = http_build_query($params);
    $url = $backendURL . ($query ? '?' . $query : '');

    error_log("[API PROXY] GET → $url");

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);

} else {
    $postData = $params;

    // Handle file uploads
    foreach ($_FILES as $key => $file) {
        if ($file['error'] === UPLOAD_ERR_OK) {
            $postData[$key] = new CURLFile(
                $file['tmp_name'],
                $file['type'],
                $file['name']
            );
        }
    }

    error_log("[API PROXY] POST → $backendURL");

    curl_setopt($ch, CURLOPT_URL, $backendURL);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
}

// CURL options
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT        => 30,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_SSL_VERIFYPEER => false, // ✅ important for localhost
    CURLOPT_SSL_VERIFYHOST => false,
]);

$response  = curl_exec($ch);
$httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);

curl_close($ch);

// Debug response
error_log("[API PROXY] HTTP: $httpCode | Error: $curlError");

// ── ERROR HANDLING ────────────────────────────────────────

// CURL error
if ($curlError) {
    echo json_encode([
        'status'  => 502,
        'message' => 'cURL Error: ' . $curlError,
        'url'     => $backendURL
    ]);
    exit;
}

// Empty response
if ($response === false || $response === '') {
    echo json_encode([
        'status'  => 500,
        'message' => 'No response from backend',
        'url'     => $backendURL
    ]);
    exit;
}

// Backend HTTP error (like 404)
if ($httpCode >= 400) {
    echo json_encode([
        'status'       => $httpCode,
        'message'      => 'Backend returned HTTP ' . $httpCode,
        'action'       => $action,
        'raw_response' => substr($response, 0, 500)
    ]);
    exit;
}

// ── JSON VALIDATION ───────────────────────────────────────
$decoded = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode([
        'status'       => $httpCode,
        'message'      => 'Backend did not return valid JSON',
        'raw_response' => substr($response, 0, 500)
    ]);
    exit;
}

// ── SUCCESS ───────────────────────────────────────────────
echo json_encode($decoded);
?>