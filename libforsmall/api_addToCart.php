<?php
session_start();

// Include database connection file
include '../Db_Connection/db_libforsmall.php';
error_reporting(0);

header('Content-Type: application/json');

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST["proId"];
    $status = $_POST["status"];
    $ipAddress = $_SERVER['REMOTE_ADDR']; // Assuming IP address is obtained from the server variables
    $userId = isset($_POST["user_id"]) ? intval($_POST["user_id"]) : -1; // Get user ID from POST data or default to -1

    // Check if the product ID exists in the products table
    $productCheckSql = "SELECT product_title, product_image, product_cat, product_price FROM products WHERE product_id = ?";
    $productCheckStmt = $conn->prepare($productCheckSql);
    $productCheckStmt->bind_param('s', $productId);
    $productCheckStmt->execute();
    $productCheckResult = $productCheckStmt->get_result();

    if ($productCheckResult->num_rows > 0) {
        $product = $productCheckResult->fetch_assoc();

        $response['product'] = array(
            'product_title' => $product['product_title'],
            'product_image' => $product['product_image'],
            'product_cat' => $product['product_cat'],
            'product_price' => $product['product_price']
        );

        if ($userId != -1) {
            // User is logged in
            $sql = "SELECT * FROM cart WHERE p_id = ? AND user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si', $productId, $userId);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $response['message'] = "Product is already added into the cart. Continue Shopping..!";
                $response['status'] = 'warning';
            } else {
                if ($status === "Borrow") {
                    $endDate = date($_POST['end_date']);
                    $sql = "INSERT INTO cart (p_id, ip_add, user_id, qty, status, end_date, total_duration) 
                            VALUES (?, ?, ?, 1, ?, ?, 15)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('ssiss', $productId, $ipAddress, $userId, $status, $endDate);
                } else {
                    $sql = "INSERT INTO cart (p_id, ip_add, user_id, qty, status) 
                            VALUES (?, ?, ?, 1, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('ssis', $productId, $ipAddress, $userId, $status);
                }
                if ($stmt->execute()) {
                    $response['message'] = "Product is Added..!";
                    $response['status'] = 'success';
                }
            }
            $stmt->close();
        } else {
            // User is not logged in
            $sql = "SELECT id FROM cart WHERE ip_add = ? AND p_id = ? AND user_id = -1";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $ipAddress, $productId);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $response['message'] = "Product is already added into the cart. Continue Shopping..!";
                $response['status'] = 'warning';
            } else {
                $sql = "INSERT INTO cart (p_id, ip_add, user_id, qty, status) 
                        VALUES (?, ?, -1, 1, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('sss', $productId, $ipAddress, $status);
                if ($stmt->execute()) {
                    $response['message'] = "Your product is Added Successfully..!";
                    $response['status'] = 'success';
                }
            }
            $stmt->close();
        }
    } else {
        $response['message'] = "Invalid product ID.";
        $response['status'] = 'error';
    }

    $productCheckStmt->close();
}

echo json_encode($response);
