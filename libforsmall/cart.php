<?php
session_start();
header('Content-Type: application/json');
include '../Db_Connection/db_libforsmall.php';

$user_id = $_SESSION['current_user_id'] ?? null;
$ip_add = $_SERVER['REMOTE_ADDR'];
$product_id = $_POST['product_id'] ?? null;

if (!$product_id) {
	echo json_encode(['status' => 'error']);
	exit;
}

// Check if product already in cart for this user/ip
$stmt = $conn->prepare("SELECT qty FROM cart WHERE p_id = ? AND (user_id = ? OR ip_add = ?)");
$stmt->bind_param("iis", $product_id, $user_id, $ip_add);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
	// If exists, update qty +1
	$row = $result->fetch_assoc();
	$new_qty = $row['qty'] + 1;

	$stmt = $conn->prepare("UPDATE cart SET qty = ? WHERE p_id = ? AND (user_id = ? OR ip_add = ?)");
	$stmt->bind_param("iiss", $new_qty, $product_id, $user_id, $ip_add);
	$stmt->execute();
} else {
	// Insert new row with qty = 1
	$qty = 1;
	$stmt = $conn->prepare("INSERT INTO cart (p_id, ip_add, user_id, qty) VALUES (?, ?, ?, ?)");
	$stmt->bind_param("isii", $product_id, $ip_add, $user_id, $qty);
	$stmt->execute();
}

// Get current total count in cart for user/ip
$stmt = $conn->prepare("SELECT SUM(qty) as total_qty FROM cart WHERE user_id = ? OR ip_add = ?");
$stmt->bind_param("is", $user_id, $ip_add);
$stmt->execute();
$result = $stmt->get_result();
$total = $result->fetch_assoc();
$cart_count = $total['total_qty'] ?? 0;

echo json_encode(['status' => 'success', 'cart_count' => $cart_count]);
exit;
