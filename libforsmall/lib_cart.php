<?php
//session_start();

//use Google\Service\Script;

include_once './header_local.php';
include_once '../common/header_module.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Library Cart</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }
    body {
      margin: 0;
      padding: 0;
      background: #efefef;
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


    .container {
      max-width: 1100px;
      margin: 40px auto;
      padding: 20px;
    }
    h2 {
      font-size: 28px;
      font-weight: 600;
      margin-bottom: 30px;
      color: #111;
    }
    .product-card {
      display: flex;
      background: #fff;
      border-radius: 12px;
      overflow: hidden;
      margin-bottom: 40px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .left-section {
      width: 260px;
      background: #f7f7f7;
      padding: 20px;
      text-align: center;
      border-right: 1px solid #ddd;
    }
    .image-placeholder {
      width: 100%;
      height: 320px;
      border-radius: 10px;
      margin-bottom: 20px;
    }
    .dropdown-label {
      font-size: 16px;
      margin-bottom: 8px;
      text-align: left;
    }
    select {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 14px;
    }
    .right-section {
      flex: 1;
      padding: 20px 30px;
    }
    .form-group {
      margin-bottom: 15px;
    }
    .form-label {
      font-size: 14px;
      margin-bottom: 5px;
      display: block;
      color: #333;
    }
    .input-box {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 14px;
    }
    .input-box.price {
      color: #00aaff;
      font-weight: bold;
    }
    .input-box.deposit {
      color: red;
      font-weight: bold;
    }
    .input-box.total {
      color: orange;
      font-weight: bold;
    }
    .quantity-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .quantity-box {
      flex: 1;
      margin-right: 10px;
    }
    .quantity-buttons {
      display: flex;
      gap: 5px;
    }
    .quantity-buttons button {
      width: 30px;
      height: 30px;
      font-size: 18px;
      font-weight: bold;
      border: none;
      cursor: pointer;
      border-radius: 6px;
    }
    .quantity-buttons .minus {
      background: #ffecec;
      color: red;
    }
    .quantity-buttons .plus {
      background: #eaffea;
      color: green;
    }
    .action-buttons {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 20px;
    }
    .delete-btn {
      background: #e74c3c;
      color: white;
      border: none;
      padding: 10px 18px;
      border-radius: 8px;
      font-size: 14px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 5px;
    }
    .save-btn {
      background: #2eb9f0;
      color: white;
      border: none;
      padding: 10px 18px;
      border-radius: 8px;
      font-size: 14px;
      cursor: pointer;
    }
    .total-section {
      background: #fff;
      border-radius: 12px;
      padding: 20px 30px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .total-label {
      font-size: 16px;
      font-weight: 500;
      margin-right: 10px;
    }
    .total-input {
      flex: 1;
      padding: 10px;
      font-size: 16px;
      font-weight: bold;
      border-radius: 8px;
      border: 1px solid #ccc;
      color: orange;
      max-width: 200px;
    }
    .pay-btn {
      background: #27ae60;
      color: white;
      padding: 10px 20px;
      border-radius: 8px;
      border: none;
      font-size: 14px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 6px;
    }
  </style>
</head>

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
  <div class="container">
    <h2>Library Cart</h2>

    <!-- Product Card 1 -->
    <div class="product-card">
      <div class="left-section">
        <div class="image-placeholder"></div>
        <div class="dropdown-label">Product Name</div>
        <select><option selected>Rent</option></select>
      </div>
      <div class="right-section">
        <div class="form-group">
          <label class="form-label">End Date</label>
          <input class="input-box" type="text" value="30 / 05 / 2025" />
        </div>
        <div class="form-group">
          <label class="form-label">Product Quantity</label>
          <div class="quantity-row">
            <input class="input-box quantity-box" type="text" value="1" />
            <div class="quantity-buttons">
              <button class="minus">−</button>
              <button class="plus">+</button>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Product Price Per <b>Quantity</b> Per <b>Day</b></label>
          <input class="input-box price" type="text" value="₹10" />
        </div>
        <div class="form-group">
          <label class="form-label">Deposit Per Quantity</label>
          <input class="input-box deposit" type="text" value="₹20" />
        </div>
        <div class="form-group">
          <label class="form-label">Total Price</label>
          <input class="input-box total" type="text" value="₹30" />
        </div>
        <div class="action-buttons">
          <button class="delete-btn">🗑 Delete</button>
          <button class="save-btn">Save Product</button>
        </div>
      </div>
    </div>

    <!-- Product Card 2 -->
    <div class="product-card">
      <div class="left-section">
        <div class="image-placeholder"></div>
        <div class="dropdown-label">Product Name</div>
        <select><option selected>Buy</option></select>
      </div>
      <div class="right-section">
        <div class="form-group">
          <label class="form-label">Product Quantity</label>
          <div class="quantity-row">
            <input class="input-box quantity-box" type="text" value="2" />
            <div class="quantity-buttons">
              <button class="minus">−</button>
              <button class="plus">+</button>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Product Price Per Quantity</label>
          <input class="input-box price" type="text" value="₹10" />
        </div>
        <div class="form-group">
          <label class="form-label">Total Price</label>
          <input class="input-box total" type="text" value="₹20" />
        </div>
        <div class="action-buttons">
          <button class="delete-btn">🗑 Delete</button>
          <button class="save-btn">Save Product</button>
        </div>
      </div>
    </div>

    <!-- Total Section -->
    <div class="total-section">
      <div>
        <label class="total-label">Total Billable Amount</label>
        <input class="total-input" type="text" value="₹50" />
      </div>
      <button class="pay-btn">Proceed To Payment</button>
    </div>

  </div>
</body>
</html>
<?php include_once("../common/footer_module.php"); ?>
