<?php
error_reporting(0);
$main_logo = "../img/logo/SpacECELogo.jpg";
$module_logo = "../img/logo/ConsultUs.jpeg";
$module_name = "ConsultUs";
include_once '../common/header_module.php';
include '../Db_Connection/constants.php';
include '../Db_Connection/db_cits1.php';

if (isset($_POST['submit'])) {
  $docid = $_SESSION['current_user_id'];
  $childname = $_POST['childname'];
  $parentcontact = $_POST['parentcontact'];
  $parentemail = $_POST['parentemail'];
  $gender = $_POST['gender'];
  $parentaddress = $_POST['parentaddress'];
  $dob = $_POST['childob'];
  $medhis = $_POST['medhis'];

  // Calculate age from date of birth
  $today = new DateTime();
  $birthdate = new DateTime($dob);
  $interval = $today->diff($birthdate);
  $childage = $interval->y;

  $sql = mysqli_query($conn, "INSERT INTO cits1.tblchildren(childName, parentContno, parentEmail, childGender, parentAdd, childAge, childImmu, childDoB) 
    VALUES('$childname', '$parentcontact', '$parentemail', '$gender', '$parentaddress', '$childage', '$medhis', '$dob')");

  if ($sql) {
    echo "<script>alert('Patient info added Successfully');</script>";
    header('location:add-child.php');
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor | Register Child</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
    }

    .container {
      margin: auto;
      max-width: 85%;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-top: 50px;
    }

    h1 {
      color: red;
      text-align: center;
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    textarea,
    input[type="date"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    .clip-radio {
      display: flex;
      align-items: center;
    }

    .clip-radio input[type="radio"] {
      margin-right: 5px;
    }

    button {
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      background-color: #007bff;
      color: #fff;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #0056b3;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Doctor | Register Child</h1>
    <form role="form" method="post">
      <div class="form-group">
        <label for="childname">Child Name</label>
        <input type="text" name="childname" class="form-control" placeholder="Enter the name of the Child" required>
      </div>
      <div class="form-group">
        <label for="parentcontact">Parent Contact no</label>
        <input type="text" name="parentcontact" class="form-control" placeholder="Enter Parent Contact No." required maxlength="10" pattern="[0-9]+">
      </div>
      <div class="form-group">
        <label for="parentemail">Parent Email</label>
        <input type="email" id="parentemail" name="parentemail" class="form-control" placeholder="Enter Parent Email id here" required onBlur="userAvailability()">
        <span id="user-availability-status1" style="font-size:12px;"></span>
      </div>
      <div class="form-group">
        <label class="block">Child Gender</label>
        <div class="clip-radio radio-primary">
          <input type="radio" id="rg-female" name="gender" value="female">
          <label for="rg-female">Female</label>
          <input type="radio" id="rg-male" name="gender" value="male">
          <label for="rg-male">Male</label>
        </div>
      </div>
      <div class="form-group">
        <label for="parentaddress">Parent Address/Residence</label>
        <textarea name="parentaddress" class="form-control" placeholder="Enter parent address and area of residence" required></textarea>
      </div>
      <div class="form-group">
        <label for="childob">Date of birth</label>
        <input type="date" name="childob" class="form-control" placeholder="Select dob" required>
      </div>
      <div class="form-group">
        <label for="medhis">Disease being sought immunization for</label>
        <textarea name="medhis" class="form-control" placeholder="Enter name of the disease to be vaccinated for" required></textarea>
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Register</button>
    </form>
  </div>

  <?php include('../common/footer_module.php'); ?>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="vendor/modernizr/modernizr.js"></script>
  <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
  <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
  <script src="vendor/switchery/switchery.min.js"></script>
  <script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
  <script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
  <script src="vendor/autosize/autosize.min.js"></script>
  <script src="vendor/selectFx/classie.js"></script>
  <script src="vendor/selectFx/selectFx.js"></script>
  <script src="vendor/select2/select2.min.js"></script>
  <script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="assets/js/form-elements.js"></script>
</body>

</html>
