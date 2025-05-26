<?php
session_start();

//use Google\Service\Script;


include '../Db_Connection/db_libforsmall.php';

if (empty($_SESSION['current_user_id'])) {
  echo '<script>
    alert("User must be logged in!!");
    window.location.href = "../spacece_auth/login.php";
  </script>';
  exit;
}


$user_id = $_SESSION['current_user_id'];
$query = "SELECT product_title, product_price, product_image 
          FROM products 
          WHERE user_id = '$user_id' 
          ORDER BY product_id DESC 
          LIMIT 3";

$result = mysqli_query($conn, $query);


// My Products query 
$query = "SELECT product_title, product_price, product_image 
          FROM products 
          WHERE user_id = '$user_id' 
          ORDER BY product_id DESC 
          LIMIT 3";

$result = mysqli_query($conn, $query);

// Wishlist products for display
$wishlist_product_ids = [];
$wishlist_result = null;

if ($user_id) {
  // 1. Get full wishlist product details
  $wishlist_query = "
    SELECT 
      p.product_id, 
      p.product_title, 
      p.product_price, 
      p.rent_price, 
      p.product_image
    FROM user_wishlist uw
    JOIN products p ON uw.product_id = p.product_id
    WHERE uw.user_id = ?
    ORDER BY p.product_id DESC
    LIMIT 3
  ";

  $wishlistStmt1 = $conn->prepare($wishlist_query);
  $wishlistStmt1->bind_param("i", $user_id);
  $wishlistStmt1->execute();
  $wishlist_result = $wishlistStmt1->get_result();

  //  Get only product_ids (optional, if you still need it)
  $wishlistStmt2 = $conn->prepare("SELECT product_id FROM user_wishlist WHERE user_id = ?");
  $wishlistStmt2->bind_param("i", $user_id);
  $wishlistStmt2->execute();
  $wishlistRes = $wishlistStmt2->get_result();
  while ($row = $wishlistRes->fetch_assoc()) {
    $wishlist_product_ids[] = $row['product_id'];
  }
}

// Get initial cart count for current user/ip
//$ip_add = $_SERVER['REMOTE_ADDR'];
$stmt = $conn->prepare("SELECT SUM(qty) as total_qty FROM cart WHERE user_id = ? ");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result1 = $stmt->get_result();
$total = $result1->fetch_assoc();
$cart_count = $total['total_qty'] ?? 0;

include_once './header_local.php';
include_once '../common/header_module.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Library For Small</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
  <style>
    .wishlist-btn {
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0;
      border: 1px solid #ccc;
      border-radius: 6px;
      background-color: #f8f8f8;
    }

    .wishlist-btn i {
      color: black;
      transition: color 0.3s ease;
    }

    .wishlist-btn.active i {
      color: red;
    }


    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      background-color: #f2f2f2;
      color: #333;
    }

    .banner {
      background: url('./img/banner/libforsmal.jpg') center/cover no-repeat;
      padding: 4rem 2rem;
      display: flex;
      justify-content: left;
      align-items: center;
      min-height: 400px;
    }

    .banner-box {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 4rem;
      border-radius: 16px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      max-width: 550px;
    }

    .banner-title {
      font-size: 42px;
      color: #f5a623;
      font-weight: bold;
      margin-bottom: 1.5rem;
    }

    .banner-text {
      font-size: 18px;
      color: #333;
      line-height: 1.6;
      margin-bottom: 2rem;
    }

    .banner-subtitle {
      font-size: 24px;
      color: #f5a623;
      /* Same yellow as title */
      font-weight: 600;
      margin: 0;
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

    .section {
      max-width: none;
      margin: 2rem auto;
      padding: 0 1rem;
    }

    .section h3 {
      margin-bottom: 1rem;
    }

    .section-heading {
      text-align: left;
      padding-left: 140px;
      margin: 0 0 15px 0;
      font-size: 2.5rem;
      font-weight: 600;
      color: #333;
    }

    .product-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 30px;
      margin-top: 20px;
      padding: 0 40px;
      width: 100%;
    }

    .grid-button-align {
      display: flex;
      justify-content: flex-end;
      padding-right: 130px;
      margin-top: 20px;
      width: 100%;
    }

    .grid-button-align .add {
      width: 145px;
    }

    .grid-button {
      display: flex;
      justify-content: flex-end;
      padding-right: 130px;
      margin-top: 20px;
      width: 100%;
    }

    .grid-button .add {
      width: 130px;
    }

    .add {
      background-color: #00bcd4;
      border: none;
      color: white;
      padding: 6px 10px;
      border-radius: 6px;
      font-weight: bold;
      font-size: 15px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 5px;
      height: 36px;
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

    .product-card {
      background: transparent;
      border-radius: 12px;
      overflow: hidden;
      width: 100%;
      max-width: 260px;
      line-height: 60px;
      margin: auto;
      display: flex;
      flex-direction: column;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .product-details {
      padding-bottom: 1px;
    }

    .product-details select {
      margin-bottom: 1px !important;
    }

    .product-footer {
      margin-top: 0 !important;
    }

    .product-img {
      height: 260px;
      background-size: cover;
      background-position: center;
    }

    .product-details {
      background: white;
      padding: 15px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .product-details h3 {
      font-size: 16px;
      font-weight: 500;
      color: #333;
      margin: 0 0 8px 0;
    }

    .product-details select {
      width: 100%;
      padding: 8px;
      border-radius: 6px;
      border: 1px solid #ccc;
      margin-bottom: 10px;
      font-size: 14px;
    }

    .product-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;

    }

    .price {
      font-size: 16px;
      color: #00bcd4;
      font-weight: bold;
    }

    .add-cart {
      background-color: #ffb400;
      border: none;
      color: white;
      padding: 6px 10px;
      border-radius: 6px;
      font-weight: bold;
      font-size: 13px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 5px;
      height: 36px;
    }

    .bin-btn {
      background: #f44336;
      border: none;
      color: white;
      width: 36px;
      height: 36px;
      border-radius: 6px;
      cursor: pointer;
      display: grid;
      place-items: center;
      margin-left: -50px;
    }

    .add-cart:hover {
      background-color: #ffa000;
    }

    @media (max-width: 768px) {
      .product-grid {
        grid-template-columns: repeat(2, 1fr);
        padding: 0 20px;
      }
    }

    @media (max-width: 480px) {
      .product-grid {
        grid-template-columns: 1fr;
      }
    }

    .nav-button.active {
      background-color: orange;
      color: white;
      border: none;
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
      <a href="">
        <button class="nav-button">My Orders</button></a>
      <a href="Myproducts.php">
        <button class="nav-button <?php echo basename($_SERVER['PHP_SELF']) == 'fiction.php' ? 'active' : ''; ?>">
          My Products
        </button>
      </a>
    </div>
    <div class="nav-right">
      <button class="cart-button" style="position:relative;" onclick="window.location.href='viewcart.php'">
        <i class="fas fa-shopping-cart"></i>
        <?php if ($cart_count > 0): ?>
          <span class="cart-count" style="position:absolute; top:5px; right:5px; background:red; color:#fff; border-radius:50%; padding:2px 6px; font-size:12px;">
            <?php echo $cart_count; ?>
          </span>
        <?php endif; ?>
      </button>
    </div>
  </nav>

  <div class="banner">
    <div class="banner-box">
      <h1 class="banner-title">Library For Small</h1>
      <p class="banner-text">
        Rent books for your kids at affordable rates, and select from our sizable collection in various genres.
      </p>
      <p class="banner-subtitle">Children's Library</a>
    </div>
  </div>


  <!-- "My Products Section" -->
  <section class="section">
    <h3 class="section-heading">My Products</h3>
    <div class="product-grid">
      <?php
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $image_path = !empty($row['product_image']) ? $row['product_image'] : 'https://via.placeholder.com/300x200.png?text=No+Image';
      ?>
          <div class="product-card">
            <div class="product-img" style="background-image: url('<?php echo $image_path; ?>')"></div>
            <div class="product-details">
              <h3><?php echo htmlspecialchars($row['product_title']); ?></h3>
              <div class="product-footer">
                <span class="price">₹ <?php echo htmlspecialchars($row['product_price']); ?></span>
              </div>
            </div>
          </div>
      <?php
        }
      } else {
        echo "<p>No products found.</p>";
      }
      ?>
    </div>
    <div class="grid-button">
      <a href="Myproducts.php"><button class="add">To My Products</button></a>
    </div>
  </section>


  <!--"Wishlist Products Section" -->
  <section class="section">
    <h3 class="section-heading">Wishlist Products</h3>
    <div class="product-grid">
      <?php
      if ($wishlist_result && $wishlist_result->num_rows > 0) {
        while ($row = $wishlist_result->fetch_assoc()) {
          $image_path = !empty($row['product_image']) ? $row['product_image'] : 'https://via.placeholder.com/300x200.png?text=No+Image';

          // Check if product is in wishlist (for red heart)
          $isWishlisted = in_array($row['product_id'], $wishlist_product_ids);
          $heartClass = $isWishlisted ? 'fas' : 'far'; // solid heart if wishlisted
          $heartColor = $isWishlisted ? 'style="color: red;"' : '';
      ?>
          <div class="product-card">
            <div class="product-img" style="background-image: url('<?php echo $image_path; ?>')"></div>
            <div class="product-details">
              <h3><?php echo htmlspecialchars($row['product_title']); ?></h3>
              <select class="price-toggle"
                data-buy="<?php echo $row['product_price']; ?>"
                data-rent="<?php echo $row['rent_price']; ?>">
                <option value="rent">Rent</option>
                <option value="buy">Buy</option>
              </select>
              <div class="product-footer">
                <span class="price">₹ <span class="dynamic-price"><?php echo htmlspecialchars($row['rent_price']); ?></span></span>
                <button class="wishlist-btn" data-product-id="<?php echo $row['product_id']; ?>">
                  <i class="<?php echo $heartClass; ?> fa-heart" <?php echo $heartColor; ?>></i>
                </button>
                <!-- <a href="lib_cart.php"><button class="add-cart"><i class="fas fa-plus"></i> Add to Cart</button></a> -->
                <button class="add-cart" data-product-id="<?php echo $row['product_id']; ?>">Add to Cart</button>

              </div>
            </div>
          </div>
      <?php
        }
      } else {
        echo "<p>No wishlist products found.</p>";
      }
      ?>
    </div>
  </section>


  <!-- "Featured Products Section" -->
  <!-- <section class="section">
    <h3 class="section-heading">Featured Products</h3>
    &nbsp;
    &nbsp;
    <div class="product-grid">
      <?php
      $featuredProductsImages = [
        'https://via.placeholder.com/300x200.png?text=Featured+1',
        'https://via.placeholder.com/300x200.png?text=Featured+2',
        'https://via.placeholder.com/300x200.png?text=Featured+3'
      ];
      for ($i = 0; $i < 3; $i++) { ?>
        <div class="product-card">
          <div class="product-img" style="background-image: url('<?php echo $featuredProductsImages[$i]; ?>')"></div>
          <div class="product-details">
            <h3>Product Name</h3>
            <select>
              <option>Rent</option>
              <option>Buy</option>
            </select>
            <div class="product-footer">
              <span class="price">₹ 10</span>
              <button class="add-cart"><i class="fas fa-plus"></i> Add to Cart</button>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
    &nbsp;
    <div class="grid-button-align">
      <button class="add-cart">Browse all Products</button>
      &nbsp;
    </div>
  </section> -->

  <!-- Replace the entire "Recent Orders Section" -->
  <section class="section">
    <h3 class="section-heading">Recent Orders</h3>
    &nbsp;
    &nbsp;
    <div class="product-grid">
      <?php
      $recentOrdersImages = [
        'https://via.placeholder.com/300x200.png?text=Order+1',
        'https://via.placeholder.com/300x200.png?text=Order+2',
        'https://via.placeholder.com/300x200.png?text=Order+3'
      ];
      for ($i = 0; $i < 3; $i++) { ?>
        <div class="product-card">
          <div class="product-img" style="background-image: url('<?php echo $recentOrdersImages[$i]; ?>')"></div>
          <div class="product-details">
            <h3>Product Name</h3>
            <select>
              <option>Rent</option>
              <option>Buy</option>
            </select>
            <div class="product-footer">
              <span class="price">₹ 10</span>
              <?php if ($i == 2) { ?>
                <button class="add-cart" style="background-color:#f44336">Delivered</button>
              <?php } else { ?>
                <button class="add-cart" style="background-color:#4caf50">Delivered</button>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
    <div class="grid-button">
      <button class="add">To Orders Page</button>
      &nbsp;
    </div>
  </section>
  &nbsp;
  &nbsp;
  &nbsp;
  &nbsp;
  &nbsp;

  <?php include_once("../common/footer_module.php"); ?>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('.add-cart').forEach(button => {
        button.addEventListener('click', function() {
          const productId = this.dataset.productId;

          fetch('cart.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
              },
              body: `product_id=${productId}`
            })
            .then(response => response.json())
            .then(data => {
              if (data.status === 'success') {
                // Update cart count on icon
                let cartButton = document.querySelector('.cart-button');
                let countSpan = cartButton.querySelector('.cart-count');
                if (!countSpan) {
                  countSpan = document.createElement('span');
                  countSpan.className = 'cart-count';
                  countSpan.style = 'position:absolute; top:5px; right:5px; background:red; color:#fff; border-radius:50%; padding:2px 6px; font-size:12px;';
                  cartButton.style.position = 'relative';
                  cartButton.appendChild(countSpan);
                }
                countSpan.textContent = data.cart_count;

                // Show popup confirm
                if (confirm('Product added to cart. Do you want to continue shopping? Press OK for Yes, Cancel for No.')) {
                  window.location.href = 'lib_cart.php?product_id=' + productId;
                } else {
                  // Cancel => redirect to dashboard
                  window.location.href = 'index.php';
                }
              } else {
                alert('Failed to add to cart.');
              }
            });
        });
      });
    });
  </script>


  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('.wishlist-btn').forEach(button => {
        button.addEventListener('click', function() {
          const productId = this.dataset.productId;
          const productCard = this.closest('.product-card'); // Get the card container
          const icon = this.querySelector('i');

          fetch('wishlist_toggle.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
              },
              body: `product_id=${productId}`
            })
            .then(response => response.json())
            .then(data => {
              if (data.status === 'added') {
                icon.classList.remove('far');
                icon.classList.add('fas');
                this.classList.add('active');
              } else if (data.status === 'removed') {
                icon.classList.remove('fas');
                icon.classList.add('far');
                this.classList.remove('active');

                //  Only remove the card if you're on the dashboard (index.php)
                if (window.location.pathname.includes('index.php')) {
                  productCard.remove();
                }
              }
            })
            .catch(error => {
              console.error('Wishlist toggle error:', error);
              alert('Something went wrong.');
            });
        });
      });
    });
  </script>


  <script>
    document.querySelectorAll('.price-toggle').forEach(function(select) {
      select.addEventListener('change', function() {
        const selected = this.value;
        const rent = this.getAttribute('data-rent');
        const buy = this.getAttribute('data-buy');
        const priceSpan = this.closest('.product-details').querySelector('.dynamic-price');

        priceSpan.textContent = selected === 'buy' ? buy : rent;
      });
    });
  </script>
</body>

</html>