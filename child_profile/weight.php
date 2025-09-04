<?php
session_start();
 if(!empty($_SESSION)){
   include 'header_local.php';
   include '../common/header_module.php';
   
 }
 

//var_dump($_SESSION);
//if(isset($_SESSION['current_user_name'])){
   //echo "Session";
//if(($_SESSION['current_user_type']=='customer') || ($_SESSION['current_user_type']=='delivery_boy') || ($_SESSION['current_user_type']=='book_owner')){
  // header("Location:./cits/dashboard.php");
//}elseif($_SESSION['current_user_type']=='admin'){
  // header('Location:./cits/admin/dashboard.php');
//}elseif($_SESSION['current_user_type']=='consultant'){
 //  header('Location:./cits/healthofficer/dashboard.php');
//}
//}else{
//}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Weight Progress - Boys</title>

<!-- footer css link -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f1f1f1;
      margin: 0;
      padding: 0;
    }

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
      text-align: center;
    }

    .chart-container img {
      max-width: 100%;
      height: auto;
      border-radius: 6px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      overflow: hidden;
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
    .canvas {
      width: 100% !important;
      max-height: 500px;
    }
    /* Add New Height & Weight Data Section */
.add-data-section {
  background-color: #f1f1f1;
  padding: 40px;
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


.add-btn {
  padding: 10px 25px;
  background-color: orange;
  color: white;
  border: none;
  border-radius: 6px;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  display: inline-block;
  width: fit-content;          
  margin: 0 auto; 
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
    .footer {
            width: 100%;
            background: #f8f9fa;
            padding: 20px 0;
            border-top: 1px solid #dee2e6;
            margin-top: auto;
        }

  </style>
</head>
<body>
  <div class="contents">

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
    background-color: #ffffff;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin-right: 10px;
    font-weight: bold;
  " onclick="location.href='height.php'">Height</button>

  <button style="
    padding: 10px 20px;
    background-color: #eaeaea;
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
    <h1>Weight-for-age BOYS</h1>
    <p>2 to 5 years (z-scores)</p>
<canvas id="weightChart"></canvas>
  </div>

  <table>
    <thead>
      <tr>
        <th>Date</th>
        <th>Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Current Weight</th>
        <th>Current Height</th>
        <th>Weight Progress</th>
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
        <td>1 kg</td>
        <td class="status-medium">Medium</td>
      </tr>
      <tr>
        <td>15/07/24</td>
        <td>David</td>
        <td>7</td>
        <td>Male</td>
        <td>45.5 Kg</td>
        <td>5.5"</td>
        <td>0.5 kg</td>
        <td class="status-medium">Medium</td>
      </tr>
      <tr>
        <td>23/07/24</td>
        <td>David</td>
        <td>7</td>
        <td>Male</td>
        <td>47 Kg</td>
        <td>6"</td>
        <td>1.5 kg</td>
        <td class="status-low">Low</td>
      </tr>
      <tr>
        <td>5/08/24</td>
        <td>David</td>
        <td>7</td>
        <td>Male</td>
        <td>48.5 Kg</td>
        <td>6.6"</td>
        <td>1.5 kg</td>
        <td class="status-medium">Medium</td>
      </tr>
      <tr>
        <td>16/07/24</td>
        <td>David</td>
        <td>7</td>
        <td>Male</td>
        <td>50</td>
        <td>8"</td>
        <td>2 Kg</td>
        <td class="status-medium">Medium</td>
      </tr>
    </tbody>
  </table>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        data: [18.5, 19, 19.6, 20.2, 20.8, 21.5, 22.1, 22.6, 23.1, 23.6, 24.2, 24.7, 25.2, 25.7, 26.2, 26.6, 27, 27.4, 28]
      },
      {
        label: '+2 SD',
        borderColor: '#ff0000',
        borderWidth: 1,
        fill: false,
        data: [16.2, 16.7, 17.2, 17.6, 18.1, 18.6, 19, 19.5, 20, 20.4, 20.9, 21.3, 21.8, 22.2, 22.6, 23, 23.4, 23.8, 24.2]
      },
      {
        label: 'Median (0 SD)',
        borderColor: '#00aa00',
        borderWidth: 1,
        fill: false,
        data: [12.6, 13, 13.4, 13.8, 14.2, 14.6, 15, 15.4, 15.8, 16.2, 16.6, 17, 17.4, 17.8, 18.2, 18.6, 19, 19.4, 19.8]
      },
      {
        label: '-2 SD',
        borderColor: '#ff0000',
        borderWidth: 1,
        borderDash: [4, 4],
        fill: false,
        data: [10.2, 10.5, 10.8, 11.1, 11.4, 11.7, 12, 12.3, 12.6, 12.9, 13.2, 13.5, 13.8, 14.1, 14.4, 14.7, 15, 15.3, 15.6]
      },
      {
        label: '-3 SD',
        borderColor: '#000000',
        borderWidth: 1,
        borderDash: [4, 4],
        fill: false,
        data: [9, 9.2, 9.4, 9.6, 9.8, 10, 10.2, 10.4, 10.6, 10.8, 11, 11.2, 11.4, 11.6, 11.8, 12, 12.2, 12.4, 12.6]
      }
    ]
  };

  const chartOptions = {
    responsive: true,
    scales: {
      y: {
        title: {
          display: true,
          text: 'Weight (kg)'
        },
        min: 8,
        max: 30,
        ticks: {
          stepSize: 2
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

  new Chart(document.getElementById('weightChart'), {
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
    <div class="form-group full-width">
      <button type="submit" class="add-btn">Submit</button>
    </div>
  </form>
</div>
</div>

<!-- Footer -->
<?php include_once '../common/footer_module.php'; ?>

</body>
</html>