<?php
session_start();
include '../Db_Connection/db_libforsmall.php';
$userid = $_SESSION['current_user_id'];

// Fetch categories
$category_query = "SELECT cat_id, cat_title FROM categories";
$category_result = mysqli_query($conn, $category_query);

if (isset($_POST['submit'])) {
  $user_id = $userid;
  $product_title = $_POST['product_title'];
  $product_cat = $_POST['product_cat'];
  // Get brand ID (add if not exists)
  $brand_name = $_POST['product_brand'];
  $brand_result = mysqli_query($conn, "SELECT brand_id FROM brands WHERE brand_title = '$brand_name'");

  if (mysqli_num_rows($brand_result) == 0) {
    // Insert new brand if not exists
    mysqli_query($conn, "INSERT INTO brands (brand_title) VALUES ('$brand_name')");
    $brand_id = mysqli_insert_id($conn); // Get the new brand ID
  } else {
    $brand_row = mysqli_fetch_assoc($brand_result);
    $brand_id = $brand_row['brand_id']; // Existing brand ID
  }

  $product_desc = $_POST['product_desc'];
  $product_qty = $_POST['product_qty'];
  $product_price = $_POST['product_price'];
  $rent_price = $_POST['rent_price'];
  $deposit = $_POST['deposit'];
  $product_keywords = $_POST['product_keywords'];
  //$product_image = $_FILES['product_image']['name'];

  $product_image = '';

  if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === 0) {
    // Get file extension safely
    $ext = pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION);

    // Generate a unique filename
    $unique_name = uniqid('img_', true) . '.' . $ext;

    // Define relative and absolute paths
    $relative_path = './product_images/' . $unique_name;
    $absolute_path = getcwd() . DIRECTORY_SEPARATOR . $relative_path;

    // Move the uploaded file
    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $absolute_path)) {
      $product_image = $relative_path; // Save this in the DB
    } else {
      echo "<script>alert('Failed to move uploaded image.');</script>";
    }
  } else {
    echo "<script>alert('Image upload failed or not provided');</script>";
  }


  $stmt = $conn->prepare("INSERT INTO products (
  user_id,
  product_title,
  product_brand,
  product_cat,
  product_desc,
  product_qty,
  product_price,
  rent_price,
  deposit,
  product_keywords,
  product_image
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

  $stmt->bind_param(
    "isiiisdddds",  // Data types: i = int, s = string, d = double
    $user_id,
    $product_title,
    $brand_id,
    $product_cat,
    $product_desc,
    $product_qty,
    $product_price,
    $rent_price,
    $deposit,
    $product_keywords,
    $product_image
  );




  if ($stmt->execute()) {
    echo "<script>
    alert('Product added Successfully');
   window.location.href = './Myproducts.php';

</script>";
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add a Product</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }

    body {
      background-color: rgba(131, 131, 131, 0.92);
      display: flex;
      justify-content: center;
      padding: 40px 0;
    }

    .container {
      background-color: #f5f5f5;
      border-radius: 12px;
      padding: 40px;
      width: 100%;
      max-width: 700px;
    }

    h1 {
      font-size: 26px;
      font-weight: 600;
      margin-bottom: 30px;
    }

    label {
      font-size: 14px;
      margin-top: 20px;
      display: block;
    }

    input[type="text"],
    textarea,
    input[type="file"] {
      width: 100%;
      padding: 12px;
      margin-top: 6px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
      background-color: white;
    }

    textarea {
      resize: vertical;
      height: 80px;
    }

    select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
      background-color: #fff;
      box-sizing: border-box;
    }


    .input-box-wrapper {
      margin-top: 6px;
      background-color: white;
      border: 1px solid #ccc;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 10px;
      height: 48px;
    }

    .input-box-wrapper input[type="number"] {
      border: none;
      outline: none;
      font-size: 16px;
      width: 100%;
      background: transparent;
    }

    .step-buttons {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .step-buttons button {
      border: none;
      background: transparent;
      font-size: 18px;
      font-weight: bold;
      cursor: pointer;
    }

    .step-buttons .minus {
      color: red;
    }

    .step-buttons .plus {
      color: green;
    }

    .file-upload {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 6px;
    }

    .file-upload input[type="file"] {
      flex: 1;
      padding: 10px;
    }

    .file-upload button {
      margin-left: 10px;
      padding: 10px 15px;
      font-size: 14px;
      background-color: #ccc;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .button-row {
      display: flex;
      justify-content: space-between;
      margin-top: 30px;
    }

    .button {
      padding: 10px 20px;
      border: none;
      font-size: 14px;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 600;
    }

    .back {
      background-color: #ffb300;
      color: white;
    }

    .confirm {
      background-color: #ffa000;
      color: white;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Add A Product</h1>
    <div class="button-row">
      <a href="Myproducts.php">
        <button class="button back">← Back</button></a>
    </div>
    <form action="" method="POST" enctype="multipart/form-data">
      <label>Product Name</label>
      <input type="text" name="product_title" placeholder="Your entry here" required pattern="[A-Za-z0-9 ]+" title="Only letters, numbers, and spaces allowed">

      <label>Product Brand Name</label>
      <input type="text" name="product_brand" placeholder="Your entry here" required pattern="[A-Za-z0-9 ]+" title="Only letters, numbers, and spaces allowed">

      <label>Product Category</label>
      <select name="product_cat" required>
        <option value="">-- Select Category --</option>
        <?php
        while ($row = mysqli_fetch_assoc($category_result)) {
          echo '<option value="' . $row['cat_id'] . '">' . htmlspecialchars($row['cat_title']) . '</option>';
        }
        ?>
      </select>


      <label>Product Description</label>
      <textarea name="product_desc" placeholder="Your entry here" required minlength="10" maxlength="500"></textarea>

      <label>Product Quantity</label>
      <div class="input-box-wrapper">
        <input type="number" name="product_qty" value="1" min="1" required>
        <div class="step-buttons">
          <button class="minus">−</button>
          <button class="plus">+</button>
        </div>
      </div>

      <label>Product Price</label>
      <div class="input-box-wrapper">
        <input type="number" name="product_price" value="1" min="1" required>
        <div class="step-buttons">
          <button class="minus">−</button>
          <button class="plus">+</button>
        </div>
      </div>

      <label>Per Day Rent</label>
      <div class="input-box-wrapper">
        <input type="number" name="rent_price" value="1" min="1" required>
        <div class="step-buttons">
          <button class="minus">−</button>
          <button class="plus">+</button>
        </div>
      </div>

      <label>Deposit</label>
      <div class="input-box-wrapper">
        <input type="number" name="deposit" value="1" min="1" required>
        <div class="step-buttons">
          <button class="minus">−</button>
          <button class="plus">+</button>
        </div>
      </div>

      <label>Product Keywords</label>
      <input type="text" name="product_keywords" placeholder="Your entry here" required pattern="^[A-Za-z0-9 ,#\-_%'()]+$"
        title="Letters, numbers, and common symbols like #, -, %, _, (, ) allowed">

      <label>Product Image</label>
      <div class="file-upload">
        <input type="file" name="product_image" accept="image/*" required>
        <button>Upload</button>
      </div>

      <div class="button-row">
        <button type="submit" class="button confirm" name="submit">Confirm & Add Product</button>
      </div>
    </form>


  </div>

  <script>
    // Add click event listeners to all step buttons
    document.querySelectorAll('.input-box-wrapper').forEach(wrapper => {
      const input = wrapper.querySelector('input[type="number"]');
      const minusBtn = wrapper.querySelector('.minus');
      const plusBtn = wrapper.querySelector('.plus');

      minusBtn.addEventListener('click', () => {
        let val = parseInt(input.value) || 1;
        if (val > 1) input.value = val - 1;
      });

      plusBtn.addEventListener('click', () => {
        let val = parseInt(input.value) || 1;
        input.value = val + 1;
      });
    });
  </script>
</body>

</html>