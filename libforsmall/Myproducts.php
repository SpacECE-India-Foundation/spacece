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
  height: 10px; /* leave room if header/footer is positioned fixed */
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
        <tbody>
          <tr>
            <td>Product Name</td>
            <td><img src="https://via.placeholder.com/60" alt="Product" /></td>
            <td class="price-col">
              <div>Rent Per Day - <span class="orange">₹10</span></div>
              <div>Deposit - <span class="red">₹20</span></div>
              <div>For Purchase - <span class="blue">₹150</span></div>
            </td>
            <td>30</td>
            <td>Fiction</td>
            <td>Longman</td>
            <td><button class="delete-btn">🗑 Delete</button></td>
          </tr>

            <tr>
            <td>Product Name</td>
            <td><img src="https://via.placeholder.com/60" alt="Product" /></td>
            <td class="price-col">
              <div>Rent Per Day - <span class="orange">₹10</span></div>
              <div>Deposit - <span class="red">₹20</span></div>
              <div>For Purchase - <span class="blue">₹150</span></div>
            </td>
            <td>30</td>
            <td>Fiction</td>
            <td>Longman</td>
            <td><button class="delete-btn">🗑 Delete</button></td>
          </tr>

            <tr>
            <td>Product Name</td>
            <td><img src="https://via.placeholder.com/60" alt="Product" /></td>
            <td class="price-col">
              <div>Rent Per Day - <span class="orange">₹10</span></div>
              <div>Deposit - <span class="red">₹20</span></div>
              <div>For Purchase - <span class="blue">₹150</span></div>
            </td>
            <td>30</td>
            <td>Fiction</td>
            <td>Longman</td>
            <td><button class="delete-btn">🗑 Delete</button></td>
          </tr>


            <tr>
            <td>Product Name</td>
            <td><img src="https://via.placeholder.com/60" alt="Product" /></td>
            <td class="price-col">
              <div>Rent Per Day - <span class="orange">₹10</span></div>
              <div>Deposit - <span class="red">₹20</span></div>
              <div>For Purchase - <span class="blue">₹150</span></div>
            </td>
            <td>30</td>
            <td>Fiction</td>
            <td>Longman</td>
            <td><button class="delete-btn">🗑 Delete</button></td>
          </tr>

            <tr>
            <td>Product Name</td>
            <td><img src="https://via.placeholder.com/60" alt="Product" /></td>
            <td class="price-col">
            <div>Rent Per Day - <span class="orange">₹10</span></div>
            <div>Deposit - <span class="red">₹20</span></div>
            <div>For Purchase - <span class="blue">₹150</span></div>
            </td>
            <td>30</td>
            <td>Fiction</td>
            <td>Longman</td>
            <td><button class="delete-btn">🗑 Delete</button></td>
          </tr>

            <tr>
            <td>Product Name</td>
            <td><img src="https://via.placeholder.com/60" alt="Product" /></td>
            <td class="price-col">
              <div>Rent Per Day - <span class="orange">₹10</span></div>
              <div>Deposit - <span class="red">₹20</span></div>
              <div>For Purchase - <span class="blue">₹150</span></div>
            </td>
            <td>30</td>
            <td>Fiction</td>
            <td>Longman</td>
            <td><button class="delete-btn">🗑 Delete</button></td>
          </tr>

            <tr>
            <td>Product Name</td>
            <td><img src="https://via.placeholder.com/60" alt="Product" /></td>
            <td class="price-col">
              <div>Rent Per Day - <span class="orange">₹10</span></div>
              <div>Deposit - <span class="red">₹20</span></div>
              <div>For Purchase - <span class="blue">₹150</span></div>
            </td>
            <td>30</td>
            <td>Fiction</td>
            <td>Longman</td>
            <td><button class="delete-btn">🗑 Delete</button></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="footer-space"></div>
  </div>
</body>
</html>

<?php include_once("../common/footer_module.php"); ?>