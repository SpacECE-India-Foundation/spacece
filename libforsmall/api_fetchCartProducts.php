<?php
session_start();

// Include database connection file
include '../Db_Connection/db_libforsmall.php';
error_reporting(0);

header('Content-Type: application/json');

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $ipAddress = $_SERVER['REMOTE_ADDR']; // Get IP address of the client
    $userId = isset($_GET['user_id']) ? intval($_GET['user_id']) : -1; // Get user_id from GET request or default to -1

    if ($userId != -1) {
        $sql = 'SELECT
                    c.id,
                    c.p_id,
                    c.user_id,
                    c.qty,
                    c.status,
                    c.exchange_product,
                    c.exchange_price,
                    p.product_title,
                    p.product_qty,
                    p.product_price,
                    p.product_brand,
                    p.product_image,
                    p.product_cat
                FROM
                    cart c
                INNER JOIN products p ON
                    c.p_id = p.product_id
                WHERE
                    c.user_id = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $userId);
    } else {
        $sql = 'SELECT
                    c.id,
                    c.p_id,
                    c.user_id,
                    c.qty,
                    c.status,
                    c.exchange_product,
                    c.exchange_price,
                    p.product_title,
                    p.product_qty,
                    p.product_price,
                    p.product_brand,
                    p.product_image,
                    p.product_cat
                FROM
                    cart c
                INNER JOIN products p ON
                    c.p_id = p.product_id
                WHERE
                    c.user_id = ? AND c.ip_add = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('is', $userId, $ipAddress);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $response['cart'] = array();
        while ($row = $result->fetch_assoc()) {
            $response['cart'][] = array(
                'cart_id' => $row['id'],
                'product_id' => $row['p_id'],
                'user_id' => $row['user_id'],
                'quantity' => $row['qty'],
                'status' => $row['status'],
                'exchange_product' => $row['exchange_product'],
                'exchange_price' => $row['exchange_price'],
                'product_title' => $row['product_title'],
                'product_quantity' => $row['product_qty'],
                'product_price' => $row['product_price'],
                'product_brand' => $row['product_brand'],
                'product_image' => $row['product_image'],
                'product_cat' => $row['product_cat']
            );
        }
        $response['status'] = 'success';
    } else {
        $response['message'] = "No products found in the cart.";
        $response['status'] = 'error';
    }

    $stmt->close();
}

echo json_encode($response);
?>
