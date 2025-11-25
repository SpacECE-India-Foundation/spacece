<?php
// login.php - Fixed

// CORS Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header('Content-Type: application/json');

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once _DIR_ . '/../Db_Connection/db_spacece.php';
require_once _DIR_ . '/../vendor/autoload2.php';

use Firebase\JWT\JWT;

$config = require_once _DIR_ . '/../config/config2.php';
$secret_key = $config['jwt_secret'] ?? die(json_encode(['status' => 500, 'message' => 'JWT secret missing']));
$issuer = $config['jwt_issuer'] ?? die(json_encode(['status' => 500, 'message' => 'JWT issuer missing']));

// === INPUT HANDLING ===
$email = $password = $usertype = '';
$contentType = $_SERVER['CONTENT_TYPE'] ?? '';

// Support both: multipart/form-data AND application/json
if (stripos($contentType, 'application/json') !== false) {
    $input = json_decode(file_get_contents('php://input'), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['status' => 400, 'message' => 'Invalid JSON']);
        exit;
    }
    $email = trim($input['email'] ?? '');
    $password = $input['password'] ?? '';
    $usertype = trim($input['usertype'] ?? '');
} else {
    // multipart/form-data or x-www-form-urlencoded
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $usertype = trim($_POST['usertype'] ?? '');
}

// === VALIDATION ===
if (empty($email) || empty($password) || empty($usertype)) {
    echo json_encode(['status' => 400, 'message' => 'Missing required fields: email, password, usertype']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 400, 'message' => 'Invalid email format']);
    exit;
}

// === DATABASE QUERY ===
try {
    $query = "SELECT id, u_name, u_email, u_phone, u_password, u_type, image 
              FROM users WHERE u_email = ? AND u_type = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $email, $usertype);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(['status' => 404, 'message' => 'User not found or invalid usertype']);
        $stmt->close();
        $conn->close();
        exit;
    }

    $user = $result->fetch_assoc();
    $stmt->close();

    // === PASSWORD VERIFY ===
    if (!password_verify($password, $user['u_password'])) {
        echo json_encode(['status' => 401, 'message' => 'Invalid password']);
        $conn->close();
        exit;
    }

    // === GENERATE JWT ===
    $payload = [
        'iss' => $issuer,
        'iat' => time(),
        'exp' => time() + 3600, // 1 hour
        'data' => [
            'id' => (int)$user['id'],
            'name' => $user['u_name'],
            'email' => $user['u_email'],
            'phone' => $user['u_phone'],
            'usertype' => $user['u_type']
        ]
    ];

    $jwt = JWT::encode($payload, $secret_key, 'HS256');

    // === SUCCESS RESPONSE ===
    $response = [
        'status' => 200,
        'message' => 'Login successful',
        'data' => [
            'user' => [
                'id' => (int)$user['id'],
                'name' => $user['u_name'],
                'email' => $user['u_email'],
                'phone' => $user['u_phone'],
                'usertype' => $user['u_type'],
                'image' => $user['image'] ?? null
            ],
            'token' => $jwt
        ]
    ];

    echo json_encode($response);

} catch (Exception $e) {
    // Log error in production (don't expose in response)
    error_log("Login API Error: " . $e->getMessage());
    echo json_encode(['status' => 500, 'message' => 'Internal server error']);
} finally {
    if (isset($conn) && $conn) $conn->close();
}
?>