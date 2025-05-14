<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add a Product</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }

    body {
      background-color:rgba(131, 131, 131, 0.92);
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

    <label>Product Name</label>
    <input type="text" placeholder="Your entry here">

    <label>Product Brand Name</label>
    <input type="text" placeholder="Your entry here">

    <label>Product Category Name</label>
    <input type="text" placeholder="Your entry here">

    <label>Product Description</label>
    <textarea placeholder="Your entry here"></textarea>

    <label>Product Quantity</label>
    <div class="input-box-wrapper">
      <input type="number" value="1" min="1">
      <div class="step-buttons">
        <button class="minus">−</button>
        <button class="plus">+</button>
      </div>
    </div>

    <label>Product Price</label>
    <div class="input-box-wrapper">
      <input type="number" value="1" min="1">
      <div class="step-buttons">
        <button class="minus">−</button>
        <button class="plus">+</button>
      </div>
    </div>

    <label>Per Day Rent</label>
    <div class="input-box-wrapper">
      <input type="number" value="1" min="1">
      <div class="step-buttons">
        <button class="minus">−</button>
        <button class="plus">+</button>
      </div>
    </div>

    <label>Deposit</label>
    <div class="input-box-wrapper">
      <input type="number" value="1" min="1">
      <div class="step-buttons">
        <button class="minus">−</button>
        <button class="plus">+</button>
      </div>
    </div>

    <label>Product Keywords</label>
    <input type="text" placeholder="Your entry here">

    <label>Product Image</label>
    <div class="file-upload">
      <input type="file">
      <button>Upload</button>
    </div>

    <div class="button-row">
        <a href="Myproducts.php">
      <button class="button back">← Back</button></a>
      <a href="Orders.php">
        <button class="button confirm">Confirm & Add Product</button>
      </a>
    </div>
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
