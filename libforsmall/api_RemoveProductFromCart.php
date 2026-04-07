<?php
session_start();

// Include database connection file
include '../Db_Connection/db_libforsmall.php';
error_reporting(0);

header('Content-Type: application/json');

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartId = $_POST["cart_id"]; // Get cart_id from POST request

    // Delete the cart entry based on the provided cart_id
    $sql = 'DELETE FROM cart WHERE id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $cartId);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $response['message'] = "Product removed from cart successfully.";
            $response['status'] = 'success';
        } else {
            $response['message'] = "Product not found in cart.";
            $response['status'] = 'error';
        }
    } else {
        $response['message'] = "Failed to remove product from cart.";
        $response['status'] = 'error';
    }

    $stmt->close();
}

echo json_encode($response);
?>
