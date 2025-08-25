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
//   header("Location:./cits/dashboard.php");
//}elseif($_SESSION['current_user_type']=='admin'){
//   header('Location:./cits/admin/dashboard.php');
//}elseif($_SESSION['current_user_type']=='consultant'){
//   header('Location:./cits/healthofficer/dashboard.php');
//}
//}else{
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Vaccination Records</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }
    body {
      background-color: #f1f1f1;
      margin: 0;
      padding: 0;
    }
    .contents {
      padding: 40px;
    }
    .nav-bar {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 20px 40px 0 40px;
    }
    .nav-bar a, .nav-bar button {
      padding: 10px 20px;
      border-radius: 6px;
      font-weight: bold;
      border: 1px solid #ccc;
      background-color: #fff;
      cursor: pointer;
    }
    .nav-bar a {
      text-decoration: none;
      background-color: orange;
      color: white;
      border: none;
    }
    .buttons {
      display: flex;
      justify-content: flex-end;
      gap: 20px;
      margin: 20px 0 40px;
    }
    .buttons button {
      padding: 14px 28px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 500;
      cursor: pointer;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .book-btn {
      background-color: #f9a602;
      color: white;
    }
    .appointment-btn {
      background-color: #32c5f4;
      color: white;
    }
    .footer {
            width: 100%;
            background: #f8f9fa;
            padding: 20px 0;
            border-top: 1px solid #dee2e6;
            margin-top: auto;
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
      padding: 16px;
      text-align: left;
      border-bottom: 1px solid #ddd;
      font-size: 14px;
    }
    th {
      background-color: #efefef;
      font-weight: 500;
    }
    td button {
      background-color: #f9a602;
      color: white;
      border: none;
      padding: 12px 18px;
      border-radius: 8px;
      font-size: 14px;
      cursor: pointer;
    }
    input[type="checkbox"] {
      transform: scale(1.2);
    }
  
  </style>
</head>
<body>
  <div class="contents">
    <div class="nav-bar">
      <a href="profile.php">Back To Child Profile</a>
      <button onclick="location.href='height.php'">Height</button>
      <button onclick="location.href='weight.php'">Weight</button>
      <button onclick="location.href='immunization.php'">Immunization</button>
    </div>

    <div class="buttons">
      <button class="book-btn">Book Pediatrician</button>
      <button class="appointment-btn">Your Appointments</button>
    </div>

    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Child Name</th>
          <th>Vaccine Name</th>
          <th>Date Given</th>
          <th>Appointment Date & Time</th>
          <th>Next Due Date</th>
          <th>Batch Number</th>
          <th>Status</th>
          <th></th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>#</td>
          <td>Utkarsh</td>
          <td>Polio</td>
          <td>2025-01-15</td>
          <td>2025-01-20 13:00:00</td>
          <td>2025-02-20</td>
          <td>SPECE101</td>
          <td>
  <label>
    <input type="radio" name="status1" value="Completed"> Completed
  </label>
  <label>
    <input type="radio" name="status1" value="Pending"> Pending
  </label>
</td>
          <td><button>Book Pediatrician</button></td>
        </tr>
        <tr>
          <td>#</td>
          <td>Utkarsh</td>
          <td>Polio</td>
          <td>2025-01-15</td>
          <td>2025-01-20 13:00:00</td>
          <td>2025-02-20</td>
          <td>SPECE101</td>
          <td>
  <label>
    <input type="radio" name="status2" value="Completed"> Completed
  </label>
  <label>
    <input type="radio" name="status2" value="Pending"> Pending
  </label>
</td>
          <td><button>Book Pediatrician</button></td>
        </tr>
        <tr>
          <td>#</td>
          <td>Utkarsh</td>
          <td>Polio</td>
          <td>2025-01-15</td>
          <td>2025-01-20 13:00:00</td>
          <td>2025-02-20</td>
          <td>SPECE101</td>
          <td>
  <label>
    <input type="radio" name="status3" value="Completed"> Completed
  </label>
  <label>
    <input type="radio" name="status3" value="Pending"> Pending
  </label>
</td>
          <td><button>Book Pediatrician</button></td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>
