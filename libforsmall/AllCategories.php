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
<header>
  <div class="logo-section">
    <img src="http://localhost/spaceorg/spacece/img/logo/SpacECELogo.jpg" alt="Logo" class="logo">
    <h1>Spaces Web Portal</h1>
  </div>
  <div class="title-section">
    <h2>Library For Small</h2>
  </div>
  <div class="icons-section">
    <a href="index.php">
    <i class="fas fa-home"></i>
    </a>
    <i class="fas fa-info-circle"></i>
    <i class="fas fa-user-circle"></i>
  </div>
</header>

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
    <button class="cart-button">
      <i class="fas fa-shopping-cart"></i>
    </button>
  </div>
</nav>

<main>
  <h2 class="section-title">All Categories</h2>

  <div class="search-filter">
    <div class="search-box">
      <div class="input-group">
        <input type="text" class="search-input" placeholder="Search for books">
        <i class="fas fa-search search-icon"></i>
      </div>
    </div>
    
    <div class="filter-box">
      <select class="filter-select">
        <option selected>Filter</option>
        <option value="1">Price Low to High</option>
        <option value="2">Price High to Low</option>
      </select>
    </div>
  </div>
  &nbsp;
  &nbsp;

<div class="product-grid">
  <!-- Product Card 1 -->
  <div class="product-card">
    <div class="product-img" style="background-image: url('https://via.placeholder.com/300x200.png?text=Product+1')"></div>
    <div class="product-details">
      <h3>Product Name</h3>
      <select>
        <option>Rent</option>
        <option>Buy</option>
      </select>
      <div class="product-footer">
        <span class="price">₹ 10</span>
        <button class="add-cart"><i class="fas fa-plus"></i> Add To Cart</button>
      </div>
    </div>
  </div>

  <!-- Product Card 2 -->
  <div class="product-card">
    <div class="product-img" style="background-image: url('https://via.placeholder.com/300x200.png?text=Product+2')"></div>
    <div class="product-details">
      <h3>Product Name</h3>
      <select>
        <option>Rent</option>
        <option>Buy</option>
      </select>
      <div class="product-footer">
        <span class="price">₹ 10</span>
        <button class="add-cart"><i class="fas fa-plus"></i> Add To Cart</button>
      </div>
    </div>
  </div>

  <!-- Product Card 3 -->
  <div class="product-card">
    <div class="product-img" style="background-image: url('https://via.placeholder.com/300x200.png?text=Product+3')"></div>
    <div class="product-details">
      <h3>Product Name</h3>
      <select>
        <option>Rent</option>
        <option>Buy</option>
      </select>
      <div class="product-footer">
        <span class="price">₹ 10</span>
        <button class="add-cart"><i class="fas fa-plus"></i> Add To Cart</button>
      </div>
    </div>
  </div>

  <!-- Product Card 4 -->
  <div class="product-card">
    <div class="product-img" style="background-image: url('https://via.placeholder.com/300x200.png?text=Product+4')"></div>
    <div class="product-details">
      <h3>Product Name</h3>
      <select>
        <option>Rent</option>
        <option>Buy</option>
      </select>
      <div class="product-footer">
        <span class="price">₹ 10</span>
        <button class="add-cart"><i class="fas fa-plus"></i> Add To Cart</button>
      </div>
    </div>
  </div>

  <!-- Product Card 5 -->
  <div class="product-card">
    <div class="product-img" style="background-image: url('https://via.placeholder.com/300x200.png?text=Product+5')"></div>
    <div class="product-details">
      <h3>Product Name</h3>
      <select>
        <option>Rent</option>
        <option>Buy</option>
      </select>
      <div class="product-footer">
        <span class="price">₹ 10</span>
        <button class="add-cart"><i class="fas fa-plus"></i> Add To Cart</button>
      </div>
    </div>
  </div>

  <!-- Product Card 6 -->
  <div class="product-card">
    <div class="product-img" style="background-image: url('https://via.placeholder.com/300x200.png?text=Product+6')"></div>
    <div class="product-details">
      <h3>Product Name</h3>
      <select>
        <option>Rent</option>
        <option>Buy</option>
      </select>
      <div class="product-footer">
        <span class="price">₹ 10</span>
        <button class="add-cart"><i class="fas fa-plus"></i> Add To Cart</button>
      </div>
    </div>
  </div>

  <!-- Product Card 7 -->
  <div class="product-card">
    <div class="product-img" style="background-image: url('https://via.placeholder.com/300x200.png?text=Product+7')"></div>
    <div class="product-details">
      <h3>Product Name</h3>
      <select>
        <option>Rent</option>
        <option>Buy</option>
      </select>
      <div class="product-footer">
        <span class="price">₹ 10</span>
        <button class="add-cart"><i class="fas fa-plus"></i> Add To Cart</button>
      </div>
    </div>
  </div>

  <!-- Product Card 8 -->
  <div class="product-card">
    <div class="product-img" style="background-image: url('https://via.placeholder.com/300x200.png?text=Product+8')"></div>
    <div class="product-details">
      <h3>Product Name</h3>
      <select>
        <option>Rent</option>
        <option>Buy</option>
      </select>
      <div class="product-footer">
        <span class="price">₹ 10</span>
        <button class="add-cart"><i class="fas fa-plus"></i> Add To Cart</button>
      </div>
    </div>
  </div>

  <!-- Product Card 9 -->
  <div class="product-card">
    <div class="product-img" style="background-image: url('https://via.placeholder.com/300x200.png?text=Product+9')"></div>
    <div class="product-details">
      <h3>Product Name</h3>
      <select>
        <option>Rent</option>
        <option>Buy</option>
      </select>
      <div class="product-footer">
        <span class="price">₹ 10</span>
        <button class="add-cart"><i class="fas fa-plus"></i> Add To Cart</button>
      </div>
    </div>
  </div>

  <!-- Product Card 10 -->
  <div class="product-card">
    <div class="product-img" style="background-image: url('https://via.placeholder.com/300x200.png?text=Product+10')"></div>
    <div class="product-details">
      <h3>Product Name</h3>
      <select>
        <option>Rent</option>
        <option>Buy</option>
      </select>
      <div class="product-footer">
        <span class="price">₹ 10</span>
        <button class="add-cart"><i class="fas fa-plus"></i> Add To Cart</button>
      </div>
    </div>
  </div>

  <!-- Product Card 11 -->
  <div class="product-card">
    <div class="product-img" style="background-image: url('https://via.placeholder.com/300x200.png?text=Product+11')"></div>
    <div class="product-details">
      <h3>Product Name</h3>
      <select>
        <option>Rent</option>
        <option>Buy</option>
      </select>
      <div class="product-footer">
        <span class="price">₹ 10</span>
        <button class="add-cart"><i class="fas fa-plus"></i> Add To Cart</button>
      </div>
    </div>
  </div>

  <!-- Product Card 12 -->
  <div class="product-card">
    <div class="product-img" style="background-image: url('https://via.placeholder.com/300x200.png?text=Product+12')"></div>
    <div class="product-details">
      <h3>Product Name</h3>
      <select>
        <option>Rent</option>
        <option>Buy</option>
      </select>
      <div class="product-footer">
        <span class="price">₹ 10</span>
        <button class="add-cart"><i class="fas fa-plus"></i> Add To Cart</button>
      </div>
    </div>
  </div>
</div>

  <div class="pagination-wrapper">
    <div class="pagination">
      <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
      <span class="page-info">Page 1 of 100</span>
      <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
    </div>
  </div>

</main>

<!-- Styles -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<style>
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
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
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
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
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
</body>
</html>
