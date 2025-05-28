<?php
session_start();
if(empty($_SESSION)){
    include 'header_local.php';
    include '../common/header_module.php';
}

if(isset($_SESSION['current_user_name'])){
    if(($_SESSION['current_user_type']=='customer') || ($_SESSION['current_user_type']=='delivery_boy') || ($_SESSION['current_user_type']=='book_owner')){
        header("Location:./cits/dashboard.php");
    } elseif($_SESSION['current_user_type']=='admin'){
        header('Location:./cits/admin/dashboard.php');
    } elseif($_SESSION['current_user_type']=='consultant'){
        header('Location:./cits/healthofficer/dashboard.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Child Management Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
        }

body {
  position: relative;
  min-height: 100vh;
  padding-bottom: 100px; 
}

footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  height: 60px;
}
        .nav-bar {
            display: flex;
            gap: 14px;
            padding: 20px;
            background: #fff;
            border-bottom: 1px solid #ccc;
            position: relative;
            z-index: 1000; 
        }

        .nav-bar button {
            padding: 10px 20px;
            border: 1px solid #ccc;
            background: #fff;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 500;
        }

        .nav-bar .active {
            background-color: #fff7e6;
            border: 1px solid #f5a623;
            color: #f5a623 !important;
            font-weight: 600;
            border-radius: 12px;
            padding: 6px 18px;
        }

        .header-banner {
            position: relative;
            width: 100%;
            height: 480px;
            background-color: #e0e0e0;
            display: flex;
            align-items: center;
            padding-left: 60px;
            z-index: 1;
        }

        .header-card {
            background: #fff;
            border-radius: 18px;
            padding: 60px;
            width: 400px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            position: absolute;
            top: 70px;
            left: 60px;
            font-size: large;
        }

        .header-card h1 {
            color: #f90;
            font-size: 30px;
            margin-bottom: 20px;
        }

        .header-card p {
            font-size: 18px;
            font-weight: 600;
        }

        .header-card a {
            display: inline-block;
            margin-top: 20px;
            color: #f90;
            text-decoration: none;
            font-weight: 500;
        }

        .section-title {
            margin: 60px 60px 15px;
            font-size: 20px;
            font-weight: 600;
        }

        .children-grid {
            display: flex;
            justify-content: space-between;
            gap: 30px;
            padding: 0 60px 40px;
        }

        .child-card {
            background: #fff;
            border-radius: 12px;
            flex: 1;
            min-width: 320px;
            max-width: 300px;
            height: 360px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .child-image {
            height: 300px;
            background-color: #e0e0e0;
            background-size: cover;
            background-position: center;
        }

        .child-name {
            text-align: center;
            padding: 12px 0;
            color: #f90;
            font-weight: 500;
            font-size: 19px;
        }

        @media (max-width: 900px) {
            .children-grid {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <div class="nav-bar">
        <button class="active">Dashboard</button>
        <button>Book Appointment</button>
        <button>Appointment History</button>
        <button>Immunization History</button>
        <button>Search Immunization Info</button>
    </div>

    <div class="header-banner">
        <div class="header-card">
            <h1>Child Management</h1>
            <p>Users | Dashboard</p>
            <a href="#">Check Child Management....</a>
        </div>
    </div>

    <div class="section-title">Your Children</div>

    <div class="children-grid">
        <div class="child-card">
            <div class="child-image"></div>
            <a href="profile.php">
                <div class="child-name">Child 1</div>
            </a>
        </div>
        <div class="child-card">
            <div class="child-image"></div>
            <a href="profile.php">
                <div class="child-name">Child 2</div>
            </a>
        </div>
        <div class="child-card">
            <div class="child-image"></div>
            <a href="profile.php">
                <div class="child-name">Child 3</div>
            </a>
        </div>
    </div>

    <?php include_once '../common/footer_module.php'; ?>
</body>
</html>
