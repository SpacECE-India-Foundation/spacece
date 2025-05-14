<?php
//session_start();

//use Google\Service\Script;

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
body {
  font-family: 'Segoe UI', sans-serif;
  margin: 0;
  background-color: #f2f2f2;
  color: #333;
}

.banner {
  background: url('https://via.placeholder.com/1200x400.png?text=Library+Background') center/cover no-repeat;
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
  color: #f5a623; /* Same yellow as title */
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
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
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

<div class="banner">
  <div class="banner-box">
    <h1 class="banner-title">Library For Small</h1>
    <p class="banner-text">
      Rent books for your kids at affordable rates, and select from our sizable collection in various genres.
    </p>
    <p class="banner-subtitle">Children's Library</a>
  </div>
</div>


<!--"My Products Section" -->
<section class="section">
<h3 class="section-heading">My Products</h3>
  &nbsp;
  &nbsp;
  <div class="product-grid">
    <?php 
    $myProductsImages = [
      'https://via.placeholder.com/300x200.png?text=My+Product+1',
      'https://via.placeholder.com/300x200.png?text=My+Product+2',
      'https://via.placeholder.com/300x200.png?text=My+Product+3'
    ];
    for ($i = 0; $i < 3; $i++) { ?>
    <div class="product-card">
      <div class="product-img" style="background-image: url('<?php echo $myProductsImages[$i]; ?>')"></div>
      <div class="product-details">
        <h3>Product Name</h3>
        <select>
          <option>Rent</option>
          <option>Buy</option>
        </select>
        <div class="product-footer">
          <span class="price">₹ 10</span>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
  &nbsp;
  <div class="grid-button">
    <button class="add">To My Products</button>
    &nbsp;
  </div>
</section>

<!--"Saved Products Section" -->
<section class="section">
<h3 class="section-heading">Saved Products</h3>
  &nbsp;
  &nbsp;
  <div class="product-grid">
    <?php 
    $savedProductsImages = [
      'https://via.placeholder.com/300x200.png?text=Saved+1',
      'https://via.placeholder.com/300x200.png?text=Saved+2',
      'https://via.placeholder.com/300x200.png?text=Saved+3',
      'https://via.placeholder.com/300x200.png?text=Saved+4',
      'https://via.placeholder.com/300x200.png?text=Saved+5',
      'https://via.placeholder.com/300x200.png?text=Saved+6'
    ];
    for ($i = 0; $i < 6; $i++) { ?>
    <div class="product-card">
      <div class="product-img" style="background-image: url('<?php echo $savedProductsImages[$i]; ?>')"></div>
      <div class="product-details">
        <h3>Product Name</h3>
        <select>
          <option>Rent</option>
          <option>Buy</option>
        </select>
        <div class="product-footer">
          <span class="price">₹ 10</span>
          <button class="add-cart"><i class="fas fa-plus"></i> Add to Cart</button>
          <button class="bin-btn">
            <i class="fas fa-trash-alt"></i>
          </button>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</section>

<!-- "Featured Products Section" -->
<section class="section">
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
</section>

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
</body>
</html>
