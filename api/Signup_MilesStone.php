<?php
// Signup API
require_once _DIR_ . '/../Db_Connection/db_spacece.php';
header('Content-Type: application/json');

// Check request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response = [
        'status' => 405,
        'message' => 'Method not allowed. Please use POST request.'
    ];
    http_response_code(200);
    echo json_encode($response);
    exit;
}

// Generate JWT token (simple implementation)
function generateToken($user_id, $email) {
    $secret = 'your-secret-key'; // Replace with your secret key
    $header = base64_encode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
    $payload = base64_encode(json_encode([
        'user_id' => $user_id,
        'email' => $email,
        'iat' => time(),
        'exp' => time() + (60 * 60) // 1 hour expiry
    ]));
    $signature = base64_encode(hash_hmac('sha256', "$header.$payload", $secret, true));
    return "$header.$payload.$signature";
}

// Get input data from multipart form
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';
$usertype = isset($_POST['usertype']) ? trim($_POST['usertype']) : '';

// Handle image upload
$image = isset($_FILES['image']) ? $_FILES['image'] : null;
$image_filename = null;

if ($image && $image['error'] === UPLOAD_ERR_OK) {
    $upload_dir = _DIR_ . '/../uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($image['type'], $allowed_types)) {
        $response['status'] = 400;
        $response['message'] = 'Invalid image format. Only JPEG, PNG, and GIF are allowed.';
        unset($response['data']);
        http_response_code(200);
        echo json_encode($response);
        exit;
    }

    if ($image['size'] > 2 * 1024 * 1024) { // 2MB limit
        $response['status'] = 400;
        $response['message'] = 'Image size exceeds 2MB limit.';
        unset($response['data']);
        http_response_code(200);
        echo json_encode($response);
        exit;
    }

    $image_filename = uniqid() . '_' . basename($image['name']);
    $target_file = $upload_dir . $image_filename;
    if (!move_uploaded_file($image['tmp_name'], $target_file)) {
        $response['status'] = 500;
        $response['message'] = 'Failed to upload image.';
        unset($response['data']);
        http_response_code(200);
        echo json_encode($response);
        exit;
    }
}

// Initialize response
$response = [
    'status' => 200,
    'message' => '',
    'data' => []
];

// Validate input
if (empty($name) || empty($email) || empty($phone) || empty($password) || empty($usertype)) {
    $response['status'] = 400;
    $response['message'] = 'Missing required fields';
    unset($response['data']);
    http_response_code(200);
    echo json_encode($response);
    exit;
}

// Validate password strength
if (strlen($password) < 8) {
    $response['status'] = 400;
    $response['message'] = 'Password must be at least 8 characters long';
    unset($response['data']);
    http_response_code(200);
    echo json_encode($response);
    exit;
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response['status'] = 400;
    $response['message'] = 'Invalid email format';
    unset($response['data']);
    http_response_code(200);
    echo json_encode($response);
    exit;
}

// Validate phone format
if (!preg_match('/^\+?[1-9]\d{1,14}$/', $phone)) {
    $response['status'] = 400;
    $response['message'] = 'Invalid phone number format';
    unset($response['data']);
    http_response_code(200);
    echo json_encode($response);
    exit;
}

try {
    // Check if user exists
    $query = "SELECT * FROM users WHERE u_email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $response['status'] = 409;
        $response['message'] = 'User already exists with this email';
        unset($response['data']);
        http_response_code(200);
        echo json_encode($response);
        exit;
    }

    // Hash password
    $password_hashed = password_hash($password, PASSWORD_BCRYPT);

    // Insert new user with image
    $insert = "INSERT INTO users (u_name, u_email, u_phone, u_password, u_type, image) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert);
    $stmt->bind_param("ssssss", $name, $email, $phone, $password_hashed, $usertype, $image_filename);

    if ($stmt->execute()) {
        $user_id = $conn->insert_id;
        $token = generateToken($user_id, $email);
        
        $response['status'] = 200;
        $response['message'] = 'Signup successful';
        $response['data'] = [
            'user' => [
                'id' => $user_id,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'usertype' => $usertype,
                'image' => $image_filename
            ],
            'token' => $token
        ];
    } else {
        $response['status'] = 500;
        $response['message'] = 'Failed to register';
        unset($response['data']);
    }
} catch (Exception $e) {
    $response['status'] = 500;
    $response['message'] = 'Error: ' . $e->getMessage();
    unset($response['data']);
}

// Remove empty 'data' if not needed
if (empty($response['data'])) {
    unset($response['data']);
}

http_response_code(200);
echo json_encode($response);
$conn->close();
?>