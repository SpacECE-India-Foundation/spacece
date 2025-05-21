<?php
session_start();

//use Google\Service\Script;

include_once './header_local.php';
include_once '../common/header_module.php';
include '../Db_Connection/db_libforsmall.php';
$user_id = $_SESSION['current_user_id'] ?? null;
$query = "
    SELECT p.product_id, p.product_title, p.product_image, p.product_price, p.product_qty, 
           p.rent_price,p.deposit, pc.cat_title, pb.brand_title
    FROM products p
    JOIN categories pc ON p.product_cat = pc.cat_id
    JOIN brands pb ON p.product_brand = pb.brand_id WHERE user_id = '$user_id'
";
$result = mysqli_query($conn, $query);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {

  $product_id = $_POST['product_id'];
  $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ? AND user_id = ?");
  $stmt->bind_param("ii", $product_id, $user_id);
  $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Saved Products</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<style>
  /* Reset and base */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: "Inter", sans-serif;
    background-color: #f2f2f2;
    width: 100%;
  }

  .nav-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: white;
    padding: 20px 25px;
    border-bottom: 1px solid #ccc;
    flex-wrap: wrap;
  }

  .nav-left {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
  }

  .nav-button {
    padding: 14px 16px;
    font-size: 13px;
    border-radius: 6px;
    border: 1px solid #ccc;
    background: white;
    cursor: pointer;
    font-weight: 500;
  }

  .nav-button.active {
    background-color: orange;
    color: white;
    border: none;
  }

  .cart-button {
    border: 1px solid #ccc;
    background: white;
    padding: 12px;
    border-radius: 8px;
    cursor: pointer;
  }

  .cart-button i {
    font-size: 18px;
  }

  /* Full-width container */
  .main-container {
    width: 100%;
  }

  /* Simulate header/footer space */
  .header-space,
  .footer-space {
    height: 10px;
    /* leave room if header/footer is positioned fixed */
  }

  /* Main content */
  .content-area {
    width: 100%;
    padding: 60px 100px;
  }

  /* Top bar */
  .top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 60px;
  }

  .top-bar h1 {
    font-size: 28px;
    color: #333;
  }

  .add-btn {
    background-color: #f5a700;
    color: white;
    border: none;
    padding: 12px 20px;
    font-size: 14px;
    border-radius: 6px;
    cursor: pointer;
  }

  /* Table styles */
  .product-table {
    width: 100%;
    border-collapse: collapse;
    background-color: white;
  }

  .product-table th,
  .product-table td {
    border: 1px solid #ddd;
    text-align: left;
    padding: 16px;
    vertical-align: top;
  }

  .product-table th {
    background-color: #f9f9f9;
    font-weight: 500;
  }

  .product-table img {
    width: 60px;
    height: 60px;
    object-fit: cover;
  }

  .price-col div {
    margin-bottom: 4px;
  }

  .orange {
    color: #f5a700;
  }

  .red {
    color: #e74c3c;
  }

  .blue {
    color: #3498db;
  }

  /* Action button */
  .delete-btn {
    background-color: #f44336;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
  }
</style>

<nav class="nav-bar">
  <div class="nav-left">
    <a href="index.php">
      <button class="nav-button <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
        Dashboard
      </button>
    </a>
    <a href="fiction.php">
      <button class="nav-button <?php echo basename($_SERVER['PHP_SELF']) == 'fiction.php' ? 'active' : ''; ?>">
        Store
      </button>
    </a>
    <a href="lib_cart.php">
      <button class="nav-button">My Orders</button></a>
    <a href="Myproducts.php">
      <button class="nav-button <?php echo basename($_SERVER['PHP_SELF']) == 'fiction.php' ? 'active' : ''; ?>">
        My Products
      </button>
    </a>
  </div>
  <div class="nav-right">
    <button class="cart-button">
      <i class="fas fa-shopping-cart"></i>
    </button>
  </div>
</nav>

<body>
  <div class="main-container">
    <div class="header-space"></div>

    <div class="content-area">
      <div class="top-bar">
        <h1>Saved Products</h1>
        <a href="Addproduct.php">
          <button class="add-btn">+ Add New Product</button>
        </a>
      </div>

      <table class="product-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Category</th>
            <th>Brand</th>
            <th>Action</th>
          </tr>
        </thead>
        <?php if (mysqli_num_rows($result) > 0): ?>
          <tbody>
            <?php
            // Loop through the results and display each product
            while ($row = mysqli_fetch_assoc($result)):
            ?>
              <tr>
                <td><?php echo htmlspecialchars($row['product_title']); ?></td>
                <td><img src="<?php echo htmlspecialchars($row['product_image']); ?>" alt="Product" width="60" height="60"></td>
                <td class="price-col">
                  <div>Rent Per Day - <span class="orange">₹<?php echo htmlspecialchars($row['rent_price']); ?></span></div>
                  <div>Deposit - <span class="red">₹<?php echo htmlspecialchars($row['deposit']); ?></span></div>
                  <div>For Purchase - <span class="blue">₹<?php echo htmlspecialchars($row['product_price']); ?></span></div>
                </td>
                <td><?php echo htmlspecialchars($row['product_qty']); ?></td>
                <td><?php echo htmlspecialchars($row['cat_title']); ?></td>
                <td><?php echo htmlspecialchars($row['brand_title']); ?></td>
                <td><button
                    onclick="event.preventDefault(); 
             if (confirm('Are you sure you want to delete this product?')) { 
               document.getElementById('product-id').value = <?= $row['product_id'] ?>; 
               document.querySelector('#delete-form').submit(); 
             }"
                    class="delete-btn">
                    🗑 Delete
                  </button></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        <?php else: ?>
          <tr>
            <td colspan="7">No products found.</td>
          </tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="footer-space"></div>
  </div>
  <form action="Myproducts.php" id="delete-form" class="hidden" method="POST">
    <input type="hidden" name="product_id" id="product-id" value="<?= $row['product_id'] ?>">
  </form>
</body>

</html>

<?php include_once("../common/footer_module.php"); ?>