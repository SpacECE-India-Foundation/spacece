<?php
include_once './header_local.php';
include_once '../common/header_module.php';
?>

<!-- Tailwind CDN (only if not already included in your header files) -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Tailwind Config -->
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          primary: '#FFA500',
          textMain: '#333',
          bgMain: '#F5F5F5',
        }
      }
    }
  }
</script>

<!-- Page Content -->
<div class="bg-bgMain text-textMain font-sans p-8">
  <h1 class="text-3xl font-medium mb-8">Your Orders</h1>

  <div class="flex justify-end mb-6">
    <button class="bg-primary text-white text-sm font-medium px-5 py-2 rounded shadow hover:opacity-90 transition">
      + Add New Product
    </button>
  </div>

  <div class="overflow-x-auto">
    <table class="w-full border-collapse bg-white text-sm shadow-sm rounded-md overflow-hidden">
      <thead class="bg-gray-100 text-gray-700 text-left">
        <tr>
          <th class="px-4 py-3 border border-gray-300">Ser. No.</th>
          <th class="px-4 py-3 border border-gray-300">Products</th>
          <th class="px-4 py-3 border border-gray-300">Price Breakdown</th>
          <th class="px-4 py-3 border border-gray-300">Purchase Date</th>
          <th class="px-4 py-3 border border-gray-300">Return Date</th>
          <th class="px-4 py-3 border border-gray-300">Status</th>
          <th class="px-4 py-3 border border-gray-300">Action</th>
        </tr>
      </thead>
      <tbody class="text-gray-800">
        <?php
        $statuses = ["Order Placed", "Order Placed", "Canceled", "Delivered", "Items Returned"];
        $statusColors = [
          "Order Placed" => "text-orange-500",
          "Canceled" => "text-red-500",
          "Delivered" => "text-green-600",
          "Items Returned" => "text-green-500"
        ];
        foreach ($statuses as $status) {
          echo '<tr class="border-t border-gray-200 hover:bg-gray-50">';
          echo '<td class="px-4 py-3 border border-gray-300 align-top">1.</td>';
          echo '<td class="px-4 py-3 border border-gray-300 align-top leading-tight">
                  <div class="leading-snug">On Rent -<br>Product 1, Product 2</div>
                  <div class="mt-2 leading-snug">Purchased -<br>Product 3</div>
                </td>';
          echo '<td class="px-4 py-3 border border-gray-300 align-top leading-tight">
                  Product 1 = <span class="text-blue-600">₹10</span> :
                  Product 2 = <span class="text-blue-600">₹20</span> :
                  Product 3 = <span class="text-orange-500">₹30</span> :
                  Deposit = <span class="text-pink-500">₹60</span><br>
                  <strong>Total = ₹120</strong>
                </td>';
          echo '<td class="px-4 py-3 border border-gray-300 align-top">30 / 05 / 2025</td>';
          echo '<td class="px-4 py-3 border border-gray-300 align-top">30 / 06 / 2025</td>';
          echo '<td class="px-4 py-3 border border-gray-300 align-top">
                  <span class="' . $statusColors[$status] . '">' . $status . '</span>
                </td>';
          echo '<td class="px-4 py-3 border border-gray-300 align-top">';
          if ($status === "Order Placed") {
            echo '<button class="bg-red-500 text-white text-sm px-3 py-1 rounded hover:bg-red-600 transition">
                    Cancel
                  </button>';
          }
          echo '</td>';
          echo '</tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<?php include_once("../common/footer_module.php"); ?>
