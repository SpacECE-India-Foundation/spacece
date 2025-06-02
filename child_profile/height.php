<?php
session_start();
if(!empty($_SESSION)){
    include 'header_local.php';
    include '../common/header_module.php';
}

//if(isset($_SESSION['current_user_name'])){
  //  if(($_SESSION['current_user_type']=='customer') || ($_SESSION['current_user_type']=='delivery_boy') || ($_SESSION['current_user_type']=='book_owner')){
    //    header("Location:./cits/dashboard.php");
  //  } elseif($_SESSION['current_user_type']=='admin'){
   //     header('Location:./cits/admin/dashboard.php');
    //} elseif($_SESSION['current_user_type']=='consultant'){
     //   header('Location:./cits/healthofficer/dashboard.php');
    //}
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Height-for-age BOYS</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    /* ===== CORE RESET ===== */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    
    html {
      height: 100%;
    }
    
    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f1f1f1;
      margin: 0;
      padding: 0;
    }

    /* ===== CONTENT AREA ===== */
    .main-wrapper {
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    
    .content {
      flex: 1;
      padding: 40px;
    }

    /* ===== FOOTER ===== */
    footer {
      background: #f8f9fa;
      padding: 30px 0;
      border-top: 1px solid #dee2e6;
      margin-top: auto;
      width: 100%;
    }

    /* ===== YOUR EXISTING STYLES ===== */
    h1 {
      color: #007bff;
      font-size: 24px;
      margin-bottom: 10px;
    }

    .chart-container {
      background-color: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      margin-bottom: 40px;
    }

    canvas {
      width: 100% !important;
      max-height: 500px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      overflow: hidden;
      margin-bottom: 40px;
    }

    th, td {
      padding: 12px 16px;
      text-align: center;
      border-bottom: 1px solid #eee;
    }

    th {
      background-color: #f7f7f7;
      font-weight: 600;
    }

    tr:last-child td {
      border-bottom: none;
    }

    .status-low {
      color: red;
      font-weight: bold;
    }

    .status-medium {
      color: orange;
      font-weight: bold;
    }

    .back-button {
      display: inline-block;
      margin-top: 30px;
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      font-weight: 600;
    }
    .contents {
      padding: 40px;
    }
    /* Add New Height & Weight Data Section */
.add-data-section {
  background-color: #f1f1f1;
  padding: 60px;
  max-width: 1200px;
  margin: 0 auto;
  border-radius: 8px;
  box-sizing: border-box;
}

.add-data-section h2 {
  color: orange;
  font-size: 28px;
  margin-bottom: 20px;
}

.data-form {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
}

.form-group {
  flex: 1 1 45%;
  display: flex;
  flex-direction: column;
}

.form-group label {
  font-size: 14px;
  margin-bottom: 8px;
  font-weight: normal;
}

.form-group input {
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 16px;
}

  </style>
</head>
<body>
  <div class="main-wrapper">
    <div class="contents">
      <!-- Your existing content here -->
      <div style="display: flex; align-items: center; margin-bottom: 20px;">
        <a href="profile.php" style="
          background-color: orange;
          color: white;
          font-weight: bold;
          padding: 10px 20px;
          text-decoration: none;
          border-radius: 6px;
          margin-right: 20px;
          border: none;
        ">Back To Child Profile</a>

        <button style="
          padding: 10px 20px;
          background-color: #eaeaea;
          border: 1px solid #ccc;
          border-radius: 6px;
          margin-right: 10px;
          font-weight: bold;
        " onclick="location.href='height.php'">Height</button>

        <button style="
          padding: 10px 20px;
          background-color: white;
          border: 1px solid #ccc;
          border-radius: 6px;
          margin-right: 10px;
          font-weight: bold;
        " onclick="location.href='weight.php'">Weight</button>

        <button style="
          padding: 10px 20px;
          background-color: white;
          border: 1px solid #ccc;
          border-radius: 6px;
          font-weight: bold;
        " onclick="location.href='immunization.php'">immunization</button>
      </div>

      <div class="chart-container">
        <h1>Height-for-age BOYS</h1>
        <p>2 to 5 years (z-scores)</p>
        <canvas id="heightChart"></canvas>
      </div>

  <!-- Table section -->
  <table>
    <thead>
      <tr>
        <th>Date</th>
        <th>Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Current Weight</th>
        <th>Current Height</th>
        <th>Height Progress</th>
        <th>Height Status</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>5/07/24</td>
        <td>David</td>
        <td>7</td>
        <td>Male</td>
        <td>45 Kg</td>
        <td>5.5"</td>
        <td>2"</td>
        <td class="status-medium">Medium</td>
      </tr>
      <tr>
        <td>15/07/24</td>
        <td>David</td>
        <td>7</td>
        <td>Male</td>
        <td>45.5 Kg</td>
        <td>5.5"</td>
        <td>2"</td>
        <td class="status-medium">Medium</td>
      </tr>
      <tr>
        <td>23/07/24</td>
        <td>David</td>
        <td>7</td>
        <td>Male</td>
        <td>47 Kg</td>
        <td>6"</td>
        <td>1"</td>
        <td class="status-low">Low</td>
      </tr>
      <tr>
        <td>5/08/24</td>
        <td>David</td>
        <td>7</td>
        <td>Male</td>
        <td>48.5 Kg</td>
        <td>6.6"</td>
        <td>2"</td>
        <td class="status-medium">Medium</td>
      </tr>
      <tr>
        <td>16/07/24</td>
        <td>David</td>
        <td>7</td>
        <td>Male</td>
        <td>50</td>
        <td>8"</td>
        <td>2"</td>
        <td class="status-medium">Medium</td>
      </tr>
    </tbody>
  </table>
</div>

  <script>
    const ageLabels = [
      '2y', '2y2m', '2y4m', '2y6m', '2y8m', '2y10m',
      '3y', '3y2m', '3y4m', '3y6m', '3y8m', '3y10m',
      '4y', '4y2m', '4y4m', '4y6m', '4y8m', '4y10m',
      '5y'
    ];

    const chartData = {
      labels: ageLabels,
      datasets: [
        {
          label: '+3 SD',
          borderColor: '#000000',
          borderWidth: 1,
          fill: false,
          data: [104,106,108,110,112,114,116,117,118,119,120,121,122,123,124,124.5,125,125.2,125.5]
        },
        {
          label: '+2 SD',
          borderColor: '#ff0000',
          borderWidth: 1,
          fill: false,
          data: [99,101,103,105,107,109,111,112,113,114,115,116,117,118,119,119.5,120,120.2,120.5]
        },
        {
          label: 'Median (0 SD)',
          borderColor: '#00aa00',
          borderWidth: 1,
          fill: false,
          data: [92,94,96,98,100,102,104,105,106,107,108,109,110,111,112,112.5,113,113.2,113.5]
        },
        {
          label: '-2 SD',
          borderColor: '#ff0000',
          borderWidth: 1,
          borderDash: [4, 4],
          fill: false,
          data: [86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,100.5,101,101.2,101.5]
        },
        {
          label: '-3 SD',
          borderColor: '#000000',
          borderWidth: 1,
          borderDash: [4, 4],
          fill: false,
          data: [80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,94.5,95,95.2,95.5]
        }
      ]
    };

    const chartOptions = {
      responsive: true,
      scales: {
        y: {
          title: {
            display: true,
            text: 'Height (cm)'
          },
          min: 75,
          max: 130,
          ticks: {
            stepSize: 5
          }
        },
        x: {
          title: {
            display: true,
            text: 'Age (completed months and years)'
          }
        }
      },
      plugins: {
        legend: {
          display: true,
          position: 'right'
        }
      }
    };

    new Chart(document.getElementById('heightChart'), {
      type: 'line',
      data: chartData,
      options: chartOptions
    });
  </script>
  <!-- Add New Height & Weight Data Section -->
<div class="add-data-section">
  <h2>Add New Height & Weight Data</h2>
  <form action="#" method="post" class="data-form">
    <div class="form-group">
      <label for="date">Date</label>
      <input type="text" id="date" name="date" placeholder="Your entry here">
    </div>
    <div class="form-group">
      <label for="current-age">Current Age</label>
      <input type="text" id="current-age" name="current-age" placeholder="Your entry here">
    </div>
    <div class="form-group">
      <label for="current-height">Current Height</label>
      <input type="text" id="current-height" name="current-height" placeholder="Your entry here">
    </div>
    <div class="form-group">
      <label for="current-weight">Current Weight</label>
      <input type="text" id="current-weight" name="current-weight" placeholder="Your entry here">
    </div>
  </form>
</div>
</body>
</html>