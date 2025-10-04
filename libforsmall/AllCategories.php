<?php
session_start();

//use Google\Service\Script;

include_once './header_local.php';
include_once '../common/header_module.php';
include '../Db_Connection/db_libforsmall.php';
$userid = $_SESSION['current_user_id'];

$search = $_GET['search'] ?? '';
$filter = $_GET['filter'] ?? '';
$page = isset($_GET['page']) ? max((int)$_GET['page'], 1) : 1;

$itemsPerPage = 6;
$offset = ($page - 1) * $itemsPerPage;

// Base SQL
$sql = "SELECT * FROM products WHERE user_id = ? AND product_title LIKE ?";

// Sort filter
if ($filter === 'asc') {
  $sql .= " ORDER BY rent_price ASC";
} elseif ($filter === 'desc') {
  $sql .= " ORDER BY rent_price DESC";
}

// Add pagination
$sql .= " LIMIT ? OFFSET ?";

// Prepare
$stmt = $conn->prepare($sql);
$searchTerm = "%$search%";
$stmt->bind_param("isii", $userid, $searchTerm, $itemsPerPage, $offset);
$stmt->execute();
$result = $stmt->get_result();

// total number of products to calculate the total pages -pagination
$countSql = "SELECT COUNT(*) FROM products WHERE user_id = ? AND product_title LIKE ?";
$countStmt = $conn->prepare($countSql);
$countStmt->bind_param("is", $userid, $searchTerm);
$countStmt->execute();
$countStmt->bind_result($totalProducts);
$countStmt->fetch();
$countStmt->close();
$totalPages = ceil($totalProducts / $itemsPerPage);

$wishlist_product_ids = [];

if ($userid) {
  $wishlistStmt = $conn->prepare("SELECT product_id FROM user_wishlist WHERE user_id = ?");
  $wishlistStmt->bind_param("i", $userid);
  $wishlistStmt->execute();
  $wishlistResult = $wishlistStmt->get_result();
  while ($row = $wishlistResult->fetch_assoc()) {
    $wishlist_product_ids[] = $row['product_id'];
  }
}

// Get initial cart count for current user/ip
//$ip_add = $_SERVER['REMOTE_ADDR'];
$stmt = $conn->prepare("SELECT SUM(qty) as total_qty FROM cart WHERE user_id = ? ");
$stmt->bind_param("i", $userid);
$stmt->execute();
$result1 = $stmt->get_result();
$total = $result1->fetch_assoc();
$cart_count = $total['total_qty'] ?? 0;
//var_dump($cart_count);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Library For Small</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="allcategories-page">

  <nav class="nav-bar">
    <div class="nav-left">
      <a href="index.php">
        <button class="nav-button ">Dashboard</button></a>
      <a href="fiction.php">
        <button class="nav-button">Fiction</button></a>
      <a href="nonfiction.php">
        <button class="nav-button">Non-Fiction</button></a>
      <a href="classics.php">
        <button class="nav-button">Classics</button></a>
      <a href="Academics.php">
        <button class="nav-button">Academics</button></a>
      <a href="Popular.php">
        <button class="nav-button">Popular</button></a>
      <a href="ScienceFiction.php">
        <button class="nav-button">Science Fiction</button></a>
      <a href="Mythology.php">
        <button class="nav-button">Mythology</button></a>
      <a href="AllCategories.php">
        <button class="nav-button active">All Categories</button></a>
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

  <main>
    <h2 class="section-title">All Categories</h2>

    <form method="GET" id="searchForm">
      <div class="search-filter">
        <div class="search-box">
          <div class="input-group">
            <input type="text" name="search" id="searchInput" class="search-input" placeholder="Search for books">
            <i class="fas fa-search search-icon"></i>
          </div>
        </div>

        <div class="filter-box">
          <select class="filter-select" id="filterSelect" name="filter">
            <option value="" <?php if ($filter === '') echo 'selected'; ?>>Filter</option>
            <option value="asc" <?php if (isset($_GET['filter']) && $_GET['filter'] === 'asc') echo 'selected'; ?>>Price Low to High</option>
            <option value="desc" <?php if (isset($_GET['filter']) && $_GET['filter'] === 'desc') echo 'selected'; ?>>Price High to Low</option>
          </select>
        </div>
      </div>

    </form>
    &nbsp;
    &nbsp;

    <?php if (mysqli_num_rows($result) === 0): ?>
      <div class="no-products-message">
        <p>No products are found.</p>
      </div>
    <?php else: ?>
      <div class="product-grid">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <div class="product-card">
            <div class="product-img" style="background-image: url('<?php echo htmlspecialchars($row['product_image']); ?>')"></div>
            <div class="product-details">
              <h3><?php echo htmlspecialchars($row['product_title']); ?></h3>
              <select class="price-toggle"
                data-buy="<?php echo $row['product_price']; ?>"
                data-rent="<?php echo $row['rent_price']; ?>">
                <option value="rent">Rent</option>
                <option value="buy">Buy</option>
              </select>
              <div class="product-footer">
                <span class="price">₹ <span class="dynamic-price"><?php echo $row['rent_price']; ?></span></span>
                <?php
                $isWishlisted = in_array($row['product_id'], $wishlist_product_ids);
                $heartClass = $isWishlisted ? 'fas' : 'far'; // solid if wishlisted, regular if not
                $heartColor = $isWishlisted ? 'style="color: red;"' : '';
                ?>
                <button class="wishlist-btn" data-product-id="<?php echo $row['product_id']; ?>">
                  <i class="<?php echo $heartClass; ?> fa-heart" <?php echo $heartColor; ?>></i>
                </button>
                <button class="add-cart" data-product-id="<?php echo $row['product_id']; ?>">Add to Cart</button>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    <?php endif; ?>

    <div class="pagination-wrapper">
      <div class="pagination">
        <?php if ($page > 1): ?>
          <a class="page-btn" href="AllCategories.php?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>&filter=<?php echo $filter; ?>"><i class="fas fa-chevron-left"></i></a>
        <?php endif; ?>

        <span class="page-info">Page <?php echo $page; ?> of <?php echo $totalPages; ?></span>

        <?php if ($page < $totalPages): ?>
          <a class="page-btn" href="AllCategories.php?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>&filter=<?php echo $filter; ?>"><i class="fas fa-chevron-right"></i></a>
        <?php endif; ?>
      </div>
    </div>

  </main>

  <!-- Styles -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

  <style>
    .allcategories-page .navbar .logo img {
      width: 75px;
      height: auto;
      max-height: 75px;
      object-fit: contain;
      position: absolute;
      margin-top: 10px;
       /* Bug No -> 489 Give the margin to display the full name */
      margin:-70px;

    }

    .no-products-message {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 200px;
      /* adjust as needed */
      font-size: 1.2rem;
      color: #666;
      text-align: center;
    }

    .wishlist-btn i {
      color: black;
      transition: color 0.3s ease;
    }

    .wishlist-btn.active i {
      color: red;
    }


    body {
      margin: 0;
      font-family: 'Roboto', sans-serif;
      background: #f3f3f3;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 25px 28px;
      background: white;
      border-bottom: 1px solid #ccc;
    }

    .logo-section {
      display: flex;
      align-items: center;
    }

    .logo {
      height: 30px;
      margin-right: 10px;
    }

    .logo-section h1 {
      font-size: 20px;
      font-weight: 500;
      margin: 0;
    }

    .title-section h2 {
      font-size: 22px;
      color: orange;
      margin: 0;
      font-weight: 600;
    }

    /* Icons */
    .icons-section {
      display: flex;
      gap: 15px;
    }

    .icons-section i {
      font-size: 22px;
      color: black;
      cursor: pointer;
    }

    /* Cart Button */
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

    /* Navbar */
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

    /* Fiction Heading */
    .section-title {
      font-size: 30px;
      margin: 45px 50px 20px 200px;
      color: black;
      font-weight: 600;
      font-weight: normal;
      width: 360px;
    }

    /* Search and Filter */
    .search-filter {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin: 10px auto 20px auto;
      width: 1190px;
      padding: 0 40px;
    }

    .input-group {
      position: relative;
      width: 260px;
    }

    .search-input {
      width: 100%;
      padding: 12px 40px 12px 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 16px;
      outline: none;
    }

    .search-icon {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      color: gray;
      font-size: 16px;
    }

    .search-btn {
      padding: 20px 40px;
      background-color: grey;
      border: none;
      color: white;
      font-size: 14px;
      font-weight: normal;
      border-radius: 0 8px 8px 0;
      cursor: pointer;
    }

    .search-btn:hover {
      background-color: #a2a2a2;
    }

    .filter-box select {
      width: 260px;
      padding: 13px 35px 20px 20px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 18px;
      outline: none;
    }

    .filter-select {
      width: 260px;
      padding: 15px 25px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 14px;
    }


    /* Product Grid */
    .product-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 30px;
      margin: 20px auto;
      padding: 0 40px;
      width: 100%;
      max-width: 1320px;
    }

    /* Product Card */
    .product-card {
      width: 260px;
      margin: 0 auto;
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .product-img {
      height: 260px;
      background-size: cover;
      background-position: center;
    }

    .product-details {
      background: white;
      padding: 12px;
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

    .add-cart:hover {
      background-color: #ffa000;
    }

    .pagination-wrapper {
      display: flex;
      width: 1375px;
      justify-content: flex-end;
      padding: 40px 0;
    }

    .pagination {
      display: flex;
      align-items: end;
      background: white;
      padding: 10px 20px;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      gap: 20px;
    }

    .page-btn {
      background: white;
      border: 1px solid #ccc;
      padding: 8px 12px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
    }

    .page-btn:hover {
      background: #f0f0f0;
    }

    .page-info {
      font-size: 16px;
      font-weight: 500;
      color: black;
    }

    @media (max-width: 900px) {
      .product-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 600px) {
      .product-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>

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
                //console.log("Returned cart count:", data.cart_count);


                // Show popup confirm
                if (confirm('Product added to cart. Do you want to continue shopping? Press OK for Yes, Cancel for No.')) {
                  window.location.href = 'lib_cart.php?product_id=' + productId;
                } else {
                  // Cancel => redirect to Allcategories
                  window.location.href = 'AllCategories.php';
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

          fetch('wishlist_toggle.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
              },
              body: `product_id=${productId}`
            })
            .then(response => response.json())
            .then(data => {
              const icon = this.querySelector('i');
              if (data.status === 'added') {
                icon.classList.remove('far');
                icon.classList.add('fas');
                this.classList.add('active');
              } else if (data.status === 'removed') {
                icon.classList.remove('fas');
                icon.classList.add('far');
                this.classList.remove('active');
              }
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
  <script>
    const form = document.getElementById('searchForm');
    const searchInput = document.getElementById('searchInput');
    const filterSelect = document.getElementById('filterSelect');

    // Submit form on dropdown change
    filterSelect.addEventListener('change', function() {
      form.submit();
    });

    // Submit form on typing (after short delay)
    let typingTimer;
    searchInput.addEventListener('input', function() {
      clearTimeout(typingTimer);
      typingTimer = setTimeout(() => {
        form.submit();
      }, 500); // delay so it doesn't submit on every keystroke
    });
  </script>
</body>

</html>