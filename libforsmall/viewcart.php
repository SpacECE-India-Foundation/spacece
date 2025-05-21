<?php
session_start();

include '../Db_Connection/db_libforsmall.php';

$user_id = $_SESSION['current_user_id'] ?? null;

if (!$user_id) {
    echo "Please log in to view your cart.";
    exit;
}

$cart_sql = "SELECT c.*, p.product_title, p.product_image, p.product_price 
             FROM cart c
             JOIN products p ON c.p_id = p.product_id
             WHERE c.user_id = $user_id
             ORDER BY c.id DESC";

$cart_result = $conn->query($cart_sql);

// Handle remove from cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND p_id = ?");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $stmt->close();

    // Optional: show success message
    header("Location: viewcart.php?removed=1");
    exit;
}

$conn->close();
include_once './header_local.php';
include_once '../common/header_module.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Your Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .product-info img {
            width: 100px;
            height: auto;
            border: 1px solid #ccc;
        }

        .product-details {
            display: flex;
            flex-direction: column;
        }

        .cart-actions {
            text-align: right;
        }

        .cart-actions p {
            margin: 4px 0;
        }

        .cart-actions button {
            margin-top: 8px;
            padding: 6px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .cart-actions button.remove {
            background-color: #dc3545;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Cart</h2>

        <?php if ($cart_result->num_rows > 0): ?>
            <?php while ($row = $cart_result->fetch_assoc()): ?>
                <div class="cart-item">
                    <div class="product-info">
                        <img src="<?= $row['product_image'] ?: 'https://via.placeholder.com/100x100' ?>" alt="">
                        <div class="product-details">
                            <strong><?= htmlspecialchars($row['product_title']) ?></strong>
                        </div>
                    </div>
                    <div class="cart-actions">
                        <p>Qty: <?= $row['qty'] ?></p>
                        <p>Price: ₹<?= $row['product_price'] ?></p>
                        <p>Total: ₹<?= $row['product_price'] * $row['qty'] ?></p>
                        <form method="get" action="lib_cart.php" style="display:inline;">
                            <input type="hidden" name="product_id" value="<?= $row['p_id'] ?>">
                            <button type="submit">Purchase</button>
                        </form>

                        <form method="post" style="display:inline;">
                            <input type="hidden" name="product_id" value="<?= $row['p_id'] ?>">
                            <button type="submit" class="remove" onclick="return confirm('Are you sure you want to remove this item from your cart?')">Remove</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>

    </div>

</body>


</html>