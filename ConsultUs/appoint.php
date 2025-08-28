<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (empty($_SESSION['current_user_email'])) {
  header('location:../spacece_auth/login.php');
  exit();
}

$main_logo = "../img/logo/SpacECELogo.jpg";
$module_logo = "../img/logo/ConsultUs.jpeg";
$module_name = "ConsultUs";
include_once '../common/header_module.php';
include '../Db_Connection/constants.php';

$email = '';

if (isset($_SESSION['current_user_email'])) {
  $email = $_SESSION['current_user_email'];

?>
  <?php
  // Get URL parameters safely
  $c_id = isset($_GET['cid']) ? $_GET['cid'] : '';
  $b_id = isset($_GET['b_id']) ? $_GET['b_id'] : '';
  $con_name = isset($_GET['con_name']) ? $_GET['con_name'] : '';
  $cat_name = isset($_GET['cat_name']) ? $_GET['cat_name'] : '';

  // Optional: handle session or logged-in user info

  $u_name = isset($_SESSION['u_name']) ? $_SESSION['u_name'] : '';
  $u_email = isset($_SESSION['u_email']) ? $_SESSION['u_email'] : '';
  $u_mob = isset($_SESSION['u_mob']) ? $_SESSION['u_mob'] : '';

  // Initialize $c_from_time, $c_to_time, $c_aval_days if not already set
  $c_from_time = $c_from_time ?? '';
  $c_to_time = $c_to_time ?? '';
  $c_aval_days = $c_aval_days ?? '';
  ?>


  <?php
  define('DB_USER_DATABASE', 'spacece');

  $conn1 = new mysqli('localhost', 'root', '', 'spacece');

  $u_name = '';
  $u_mob = '';
  $u_email = '';
  $c_from_time = '';
  $c_to_time = '';
  $sql = "SELECT * FROM users WHERE u_email='$email'";
  $res = mysqli_query($conn1, $sql);

  if ($res) {
    $count = mysqli_num_rows($res);
    $sno = 1;
    if ($count > 0) {
      while ($row = mysqli_fetch_assoc($res)) {
        $u_name = $row['u_name'];
        $u_mob = $row['u_mob'];
        $u_email = $row['u_email'];
        $u_id = $row['u_id'];
      }
    }
  }

  $c_id = $_GET['cid'];
  $sql1 = "SELECT consultant.c_from_time,consultant.c_to_time,consultant.c_aval_days FROM users JOIN consultant ON users.u_id=consultant.u_id WHERE users.u_id='$c_id'";
  $res1 = mysqli_query($conn1, $sql1);

  if ($res1) {
    $count = mysqli_num_rows($res1);
    if ($count > 0) {
      while ($row = mysqli_fetch_assoc($res1)) {
        $c_from_time = $row['c_from_time'];
        $c_to_time = $row['c_to_time'];
        $c_aval_days = $row['c_aval_days'];
      }
    }
  }

  include('../Db_Connection/db_consultus_app.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $c_id = $_POST['cid'];
    $b_id = $_POST['b_id'];
    $con_name = $_POST['con_name'];
    $cat_name = $_POST['cat_name'];
    $appointment_date = $_POST['adate'];
    $appointment_time = $_POST['atime'];
    $child_name = $_POST['child_id'];
    $u_name = $_POST['fullname'];
    $u_email = $_POST['email'];
    $u_mob = $_POST['mobile'];

    $sql = "INSERT INTO appointment 
        (cid, category, username, cname, bid, com_mob, date_appointment, time_appointment, child_name, email)
        VALUES 
        ('$c_id', '$cat_name', '$u_name', '$con_name', '$b_id', '$u_mob', '$appointment_date', '$appointment_time', '$child_name', '$u_email')";

    $res = mysqli_query($conn, $sql);

    if ($res) {
      header('location:showmyappointment.php');
      //echo "<h3 style='color:green;'>✔ Appointment booked successfully!</h3>";
      exit();
    } else {
      echo "<h3 style='color:red;'>❌ Error: " . mysqli_error($conn) . "</h3>";
    }
  }

  function getNext7AvailableDays($c_aval_days)
  {
    $currentDay = date('Y-m-d');
    $availableDays = explode(',', $c_aval_days);
    $next7Days = [];

    for ($i = 0; $i < 30; $i++) { // Look ahead 30 days to find the next 7 available days
      $dayOfWeek = date('l', strtotime("+$i days"));
      if (in_array($dayOfWeek, $availableDays)) {
        $next7Days[] = date('Y-m-d', strtotime("+$i days"));
        if (count($next7Days) == 7) {
          break;
        }
      }
    }

    return $next7Days;
  }

  $next7Days = getNext7AvailableDays($c_aval_days);
  ?>

  <html>

  <head>
    <title>appointment-HOME PAGE</title>
    <!-- <link rel="stylesheet" href="css/admin.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <style>
      body {
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
      }

      .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 30px;
      }

      h1 {
        color: #343a40;
      }

      label {
        display: block;
        margin: 10px 0 5px;
      }

      input[type="text"],
      input[type="time"],
      select {
        width: 100%;
        padding: 10px;
        margin: 5px 0 20px;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
      }

      .registerbtn {
        background-color: #04AA6D;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
      }

      .registerbtn:hover {
        opacity: 1;
      }

      .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
      }

      .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
      }

      .signin {
        text-align: center;
        padding: 20px;
        background-color: #ffbb33;
        border-radius: 8px;
        margin-top: 20px;
      }

      .signin p {
        margin: 0;
      }

      .form-control {
        width: 100%;
        padding: 10px;
        margin: 5px 0 20px;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
      }
    </style>

  </head>

  <body>
    <div class="container" style="width:80%;margin-top:120px; margin-bottom:100px; background-color:#e0dcdc;">
      <h3 style="display: inline-block;">BOOK APPOINTMENT</h3>

      <p></p>
      <h7>Available Time (From): <?php echo $c_from_time; ?></h7><br>
      <h7>Available Time (To): <?php echo $c_to_time; ?></h7>
      <br>
      <h7>Available Days: <?php echo $c_aval_days; ?></h7>
      <div class="d-flex justify-content-start mb-3 ">
        <a href="./index.php" class="btn btn-sm me-2 text-white" style="margin-left: 10px; background-color:orange;"> &#8592; Back</a>
        <a class="btn btn-sm me-2 text-white" style="background-color: orange;" href="showmyappointment.php">Show My Appointments</a>
        <a href="./cdetails.php?category=all" class="btn btn-sm ml-2 text-white" style="margin-left: 10px; background-color:#5cc4eb;">View All consultants</a>
      </div>
      <hr>
      <form method="POST">
        <!-- Hidden fields to preserve GET values -->
        <input type="hidden" name="cid" value="<?php echo $c_id; ?>">
        <input type="hidden" name="b_id" value="<?php echo $b_id; ?>">
        <input type="hidden" name="con_name" value="<?php echo $con_name; ?>">
        <input type="hidden" name="cat_name" value="<?php echo $cat_name; ?>">

        <label for="userid"><b>Booking Id</b></label>
        <input type="text" value="<?php echo $b_id ?>" name="userid" id="userid" required readonly>
        <label for="adate"><b>Select Date of Appointment:</b></label>
        <select id="adate" name="adate" required>
          <?php foreach ($next7Days as $day) { ?>
            <option value="<?php echo $day; ?>"><?php echo $day; ?></option>
          <?php } ?>
        </select>
        <br><br>

        <label for="atime"><b>Select A Time:</b></label>
        <input type="time" id="atime" name="atime" required>
        <br><br>
        <label for="fullname"><b>Fullname</b></label>
        <input type="text" value="<?php echo $u_name ?>" onkeypress="return /[a-z]/i.test(event.key)" name="fullname" id="fullname" required>
        <label for="cname"><b>Consultant Name</b></label>
        <input type="text" value="<?php echo $con_name ?>" onkeypress="return /[a-z]/i.test(event.key)" name="cname" id="cname" required readonly>
        <label for="cname"><b>Children name</b></label>
        <select id="child_id" name="child_id" class="form-control">
          <?php
          $sql3 = "SELECT childName FROM cits1.tblchildren WHERE cits1.tblchildren.parentEmail='$email'";
          $res = mysqli_query($conn, $sql3);
          $count2 = mysqli_num_rows($res);
          if ($count2) {
            while ($row3 = mysqli_fetch_assoc($res)) {
          ?>
              <option value="<?php echo $row3['childName']; ?>"><?php echo $row3['childName']; ?></option>
          <?php
            }
          }
          ?>
        </select>
        <br>
        <label for="email"><b>Email</b></label>
        <input type="text" value="<?php echo $u_email ?>" name="email" id="email" required>
        <label for="mobile"><b>Mobile Number:</b></label>
        <input type="text" value="<?php echo $u_mob ?>" minlength="10" maxlength="10" pattern="[0-9]{10}" name="mobile" id="mobile" required><br>
        <hr>
        <!-- <input type="submit" name="submit" id="submit" class="registerbtn"> -->

        <button type="submit" name="submit" id="submit" class="registerbtn" style="background-color:orange;width: 100px;">Submit</button>
      </form>

    </div>

    <!-- <div class="container signin" style="background-color:orange">
      <p>You can check your appointment details, by pressing show appointment button</p>
    </div> -->
    </form>

    <?php include_once '../common/footer_module.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </body>

  <script>
    $(document).ready(function() {
      $('#appoint').on('submit', function(e) {
        var c_from_time = "<?php echo $c_from_time; ?>";
        var c_to_time = "<?php echo $c_to_time; ?>";
        var atime = $('#atime').val();

        var timePattern = /^([0-9]{2}):([0-9]{2})$/;
        var fromTimeMatch = c_from_time.match(timePattern);
        var toTimeMatch = c_to_time.match(timePattern);
        var aTimeMatch = atime.match(timePattern);

        var fromTimeDate = new Date();
        fromTimeDate.setHours(parseInt(fromTimeMatch[1]), parseInt(fromTimeMatch[2]));

        var toTimeDate = new Date();
        toTimeDate.setHours(parseInt(toTimeMatch[1]), parseInt(toTimeMatch[2]));

        var aTimeDate = new Date();
        aTimeDate.setHours(parseInt(aTimeMatch[1]), parseInt(aTimeMatch[2]));

        if (aTimeDate < fromTimeDate || aTimeDate > toTimeDate) {
          swal("Error", "Selected time is outside of available hours.", "error");
          e.preventDefault();
          return false;
        }
      });
    });
  </script>

  </html>

<?php } else {
  header("Location: ../spacece_auth/login.php");
}
ob_end_flush(); ?>





