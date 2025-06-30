<?php
session_start();

//use Google\Service\Script;


include '../Db_Connection/db_libforsmall.php';

$product_id = $_GET['product_id'] ?? null;
$user_id = $_SESSION['current_user_id'];
//var_dump($_GET);
// Fetch product details
$product_sql = "SELECT product_title,product_image,product_price,rent_price ,deposit FROM products WHERE product_id = $product_id";
$product_result = $conn->query($product_sql);
$product = $product_result->fetch_assoc();

// Fetch existing cart qty (optional, default to 1 if not found)
$cart_sql = "SELECT qty FROM cart WHERE p_id = $product_id AND user_id = $user_id ORDER BY id DESC LIMIT 1";
$cart_result = $conn->query($cart_sql);
$cart_qty = ($cart_result->num_rows > 0) ? $cart_result->fetch_assoc()['qty'] : 1;

// Extract values
$product_title = $product['product_title'];
$product_img = $product['product_image'];
$product_price = $product['product_price'];
$product_rent_price = $product['rent_price'];
$deposit = $product['deposit'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_product'])) {
  $product_id = $_GET['product_id'] ?? null;
  $user_id = $_SESSION['current_user_id'] ?? null;

  $end_date = $_POST['end_date'] ?? null;
  $qty = $_POST['qty'] ?? 1;
  $mode = $_POST['mode'] ?? 'Rent';
  $status = ($mode === 'Buy') ? 'Buy' : 'Borrow';

  if (!$product_id || !$user_id || !$qty) {
    echo "Missing required values!";
    exit;
  }
  // Step 1: Fetch start_date from cart table
  $stmt = $conn->prepare("SELECT start_date FROM cart WHERE p_id = ? AND user_id = ?");
  $stmt->bind_param("ii", $product_id, $user_id);
  $stmt->execute();
  $stmt->bind_result($start_date);

  if ($stmt->fetch()) {
    $stmt->close();

    //  Step 2: Calculate duration
    $start = new DateTime($start_date);
    $end = new DateTime($end_date);
    $interval = $start->diff($end);
    $total_duration = $interval->days;

    //  Step 3: Update cart
    $update = $conn->prepare("UPDATE cart SET qty = ?, end_date = ?, total_duration = ?, status = ? WHERE p_id = ? AND user_id = ?");
    $update->bind_param("isisii", $qty, $end_date, $total_duration, $status, $product_id, $user_id);

    if ($update->execute()) {
      // echo "Cart updated successfully.";
      header("Location: lib_cart.php?product_id=$product_id&msg=updated");
      exit;
    } else {
      echo "Error updating cart: " . $conn->error;
    }

    $update->close();
  } else {
    echo "Start date not found for the cart item.";
  }

  $conn->close();
}

include_once './header_local.php';
include_once '../common/header_module.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
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

    .mode-selector {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 14px;
    }

    .right-section {
      padding: 1rem;
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .rent-section,
    .buy-section {
      flex: 1;
      padding: 20px 30px;
    }

    .form-group {
      margin-bottom: 15px;
      width: 100%;
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
      /* padding: 20px 30px; */
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
      float: right;
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
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
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
  <!-- <div class="nav-right">
    <button class="cart-button">
      <i class="fas fa-shopping-cart"></i>
    </button>
  </div> -->
</nav>

<body>
  <div class="container">
    <h2>Library Cart</h2>

    <!-- Product Card 1 -->
    <form action="" method="POST">
      <div class="product-card">
        <div class="left-section">
          <div class="image-placeholder">
            <?php
            $image_path = !empty($product_img) ? $product_img : 'https://via.placeholder.com/300x200.png?text=No+Image';
            echo "<img src=\"$image_path\" alt=\"Product Image\" style=\"width:100%; height:auto;\" />";
            ?>
          </div>
          <div class="dropdown-label">
            <h3><?php echo htmlspecialchars($product_title); ?></h3>
          </div>
          <select class="price-toggle"
            data-buy="<?php echo $product_price ?>"
            data-rent="<?php echo $product_rent_price ?>">
            <option value="rent">Rent</option>
            <option value="buy">Buy</option>
          </select>
        </div>

        <div class="right-section">

          <!-- Rent Fields -->
          <div class="rent-section">
            <div class="form-group">
              <label class="form-label">End Date</label>
              <input class="input-box end-date" name="end_date" type="date" />
            </div>
            <div class="form-group">
              <label class="form-label">Product Price Per Quantity Per Day</label>
              <input class="input-box rent-price" type="text" value="<?= $product_rent_price ?>" readonly />
            </div>
            <div class="form-group">
              <label class="form-label">Deposit Per Quantity</label>
              <input class="input-box deposit" type="text" value="<?= $deposit ?>" readonly />
            </div>
          </div>

          <!-- Common for Rent/Buy -->
          <div class="form-group" style="padding: 20px 30px;">
            <label class="form-label">Product Quantity</label>
            <div class="quantity-row">
              <input
                class="input-box quantity-box"
                type="number"
                name="qty"
                id="qty"
                value="<?= $cart_qty ?>"
                min="1"
                oninput="updateTotal()" />
              <!-- <div class="quantity-buttons">
              <button class="minus">−</button>
              <button class="plus">+</button>
            </div> -->
            </div>
          </div>

          <!-- Buy Fields -->
          <div class="buy-section" style="display: none;">
            <div class="form-group">
              <label class="form-label">Product Price Per Quantity</label>
              <input class="input-box buy-price" type="text" value="<?= $product_price ?>" readonly />
            </div>
          </div>

          <div class="form-group" style="padding: 20px 30px;">
            <label class="form-label">Total Price</label>
            <input class="input-box total" type="text" readonly />
          </div>

          <div class="action-buttons">
            <!-- <button class="delete-btn">🗑 Delete</button> -->
            <button class="save-btn" name="save_product">Save Product</button>
          </div>

        </div>

      </div>
    </form>
    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'updated'): ?>
      <script>
        alert('Cart updated successfully.Proceed To Payment');
      </script>
    <?php endif; ?>


    <!-- Total Section -->
    <div class="total-section">
      <div>
        <label class="total-label">Total Billable Amount</label>
        <input class="total-input" type="text" readonly />
      </div>
      <button class="pay-btn" onclick="openCaptchaModal()">Proceed To Payment</button>
    </div>
    <!-- CaptchaModal -->
    <div id="captchaModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:white; border:1px solid #ccc; padding:20px; z-index:9999;">
      <p>Please enter the code from the image:</p>
      <img src="cart_process.php?rand=1" id="captchaImage">

      <br><br>
      <input type="text" id="captchaInput" placeholder="Enter code" />
      <br><br>
      <button onclick="submitCaptcha()">Submit</button>
      <button onclick="closeCaptchaModal()">Cancel</button>
    </div>

  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const priceToggle = document.querySelector('.price-toggle');
      const rentSection = document.querySelector('.rent-section');
      const buySection = document.querySelector('.buy-section');
      const rentPriceInput = document.querySelector('.rent-price');
      const buyPriceInput = document.querySelector('.buy-price');

      function updatePriceSection() {
        const selected = priceToggle.value;
        const price = priceToggle.getAttribute('data-' + selected); // gets data-rent or data-buy

        if (selected === 'rent') {
          rentSection.style.display = 'block';
          buySection.style.display = 'none';
          rentPriceInput.value = price;
        } else {
          rentSection.style.display = 'none';
          buySection.style.display = 'block';
          buyPriceInput.value = price;
        }
      }

      // Initialize on page load
      updatePriceSection();

      // Update on dropdown change
      priceToggle.addEventListener('change', updatePriceSection);
    });
  </script>


  <script>
    function openCaptchaModal() {
      document.getElementById('captchaModal').style.display = 'block';
      document.getElementById('captchaImage').src = 'cart_process.php?mode=image&rand=' + Math.random(); // load fresh image
      document.getElementById('captchaInput').value = '';
      document.getElementById('captchaInput').focus();
    }


    function closeCaptchaModal() {
      document.getElementById('captchaModal').style.display = 'none';
    }

    function submitCaptcha() {
      const code = document.getElementById('captchaInput').value;

      fetch('cart_process.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: 'captchaInput=' + encodeURIComponent(code)
        })
        .then(response => response.text())
        .then(result => {
          if (result === 'success') {
            alert(' Product is successfully booked !');
          } else {
            alert('Incorrect code, please try again.');
          }
          closeCaptchaModal();
        });
    }
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      document.querySelectorAll(".mode-selector").forEach((selector) => {
        selector.addEventListener("change", function() {
          const value = this.value;
          const rightSection = this.closest(".product-card").querySelector(".right-section");

          if (value === "Rent") {
            rightSection.querySelector(".rent-section").style.display = "block";
            rightSection.querySelector(".buy-section").style.display = "none";
          } else {
            rightSection.querySelector(".rent-section").style.display = "none";
            rightSection.querySelector(".buy-section").style.display = "block";
          }
        });

        // Trigger change on page load to set correct section
        selector.dispatchEvent(new Event("change"));
      });
    });
  </script>
  <script>
    function updateTotal() {
      const mode = document.querySelector('.mode-selector').value;
      const qty = parseInt(document.getElementById('qty').value) || 0;
      const productPrice = <?= $product_price ?>;
      const deposit = <?= $deposit ?>;

      let total = 0;

      if (mode === 'Rent') {
        total = (qty * productPrice) + (deposit);
      } else if (mode === 'Buy') {
        total = qty * productPrice;
      }

      document.querySelector('.total').value = '₹' + total;
      document.querySelector('.total-input').value = '₹' + total;
    }

    document.querySelector('.mode-selector').addEventListener('change', updateTotal);
    window.onload = updateTotal;
  </script>

</body>

</html>
<?php include_once("../common/footer_module.php"); ?>