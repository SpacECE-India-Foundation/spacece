<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
header('Content-Type: application/json');
include '../Db_Connection/db_libforsmall.php';

$user_id = $_SESSION['current_user_id'] ?? null;
$product_id = $_POST['product_id'] ?? null;


if (!$user_id || !$product_id) {
    echo json_encode(['status' => 'error']);
    exit;
}

// Check if product already in wishlist
$stmt = $conn->prepare("SELECT * FROM user_wishlist WHERE user_id = ? AND product_id = ?");
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Remove from wishlist
    $stmt = $conn->prepare("DELETE FROM user_wishlist WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    echo json_encode(['status' => 'removed']);
    exit;
} else {
    // Add to wishlist
    $stmt = $conn->prepare("INSERT INTO user_wishlist (user_id, product_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    echo json_encode(['status' => 'added']);
    exit;
}
