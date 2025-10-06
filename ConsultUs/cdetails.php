<?php
echo "details 16";
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include_once './header_local.php';
include_once '../common/header_module.php';
// include_once '../common/banner.php';
include('../Db_Connection/constants.php');
include('../Db_Connection/db_consultus_app.php');
include("./php/src/RtcTokenBuilder.php");
include("./php/src/RtmTokenBuilder.php");


//user is not used so commented
//$ref = $_GET['user'];
$cat = $_GET['category'];

// Pagination setup
$limit = 5; // Number of entries per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $limit;


date_default_timezone_set("Asia/Calcutta");

// Create connection
define('DB_USER_DATABASE', 'spacece');

$conn1 = new mysqli('localhost', 'root', '', 'spacece');

$sql_total = "SELECT COUNT(DISTINCT users.u_id) AS total 
    FROM consultant
    JOIN consultant_category ON consultant.c_category = consultant_category.cat_id
    JOIN users ON users.u_id = consultant.u_id
    WHERE users.u_type='consultant'";

$res_total = mysqli_query($conn1, $sql_total);
$row_total = mysqli_fetch_assoc($res_total);
$total_records = $row_total['total'];
$total_pages = ceil($total_records / $limit);

?>

<title>Consultant Detail</title>
<link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css" integrity="sha256-SMGbWcp5wJOVXYlZJyAXqoVWaE/vgFA5xfrH3i/jVw0=" crossorigin="anonymous" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
<style>
  body {
    background: #e0dcdc;
  }

  th,
  td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
  }

  th {
    background-color: #f2f2f2;
    font-weight: bold;
  }

  .category-menu {
    display: flex;
    border-bottom: 2px solid #ccc;
    background-color: #f1f1f1;
    padding: 0;
    margin-top: 0;
  }

  .category-link {
    margin-top: 30px;
    margin-bottom: 15px;
    padding: 10px 20px;
    border: 1px solid #ccc;
    border-bottom: none;
    /* Remove bottom border for tab look */
    border-radius: 10px 10px 0 0;
    background-color: white;
    color: #555;
    text-decoration: none;
    margin-right: 5px;
    display: inline-block;
    transition: background-color 0.3s ease, font-weight 0.3s ease;
  }

  .category-link.active {
    background-color: #ffffff;
    color: #000;
    font-weight: bold;
    box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.05);
    /* subtle shadow to lift */
    position: relative;
    z-index: 1;
  }
</style>
<div class="category-menu" style="margin-top: 85px;">
  <?php
  $check = "SELECT * FROM consultant_category";
  $run = mysqli_query($conn, $check);

  $activeCategory = isset($_GET['category']) ? $_GET['category'] : 'Paediatrician'; // Default to Paediatrician

  if (mysqli_num_rows($run) > 0) {
    while ($row = mysqli_fetch_assoc($run)) {
      $category = urlencode($row['cat_name']);
      $isActive = ($row['cat_name'] === $activeCategory) ? ' active' : '';

      echo '<a href="cdetails.php?category=' . $category . '" class="category-link' . $isActive . '">';
      echo htmlspecialchars($row['cat_name']);
      echo '</a>';
    }
  }
  ?>
</div>

<div class="container" id="record-container" style=" margin-top: 40px; margin-bottom:50px">
  <div class="text-center">
    <?php
    $cat = isset($_GET['category']) ? $_GET['category'] : 'all';
    $categoryLabel = ($cat === 'all' || empty($cat)) ? 'All Categories' : ucwords(str_replace('_', ' ', $cat));
    ?>
    <h2 class="mb-8 text-start">Consultant Details - <?php echo $categoryLabel; ?></h2>
    <?php if (isset($_SESSION['current_user_email'])) { ?>
      <div class="d-flex justify-content-start mb-3 text-white">
        <a class="btn btn-sm me-2" style="background-color: orange;" href="add_child.php">Register Childrens</a>
        <a class="btn btn-sm me-2" style="background-color: orange;" href="myChildrens.php">My Childrens</a>
        <a class="btn btn-sm me-2" style="background-color: orange;" href="showmyappointment.php?category=<?php echo urlencode($cat); ?>">Show My Appointments</a>
        <a class="btn btn-sm me-8" style="background-color:rgb(51, 154, 251);" href="./chatbot/room.php?roomname=global1">Chat Global</a>
      </div>
    <?php } ?>
    <table class="table-bordered table-hover table-responsive table-light">
      <thead style="background-color:#f0f0f0;">
        <tr>
          <th>S.no.</th>
          <th>Image</th>
          <th>Full Name</th>
          <th>Category</th>
          <th>Office</th>
          <th>Language</th>
          <th>Available from(Time)</th>
          <th>Available to(Time)</th>
          <th>Consultant fee</th>
          <th>Available days</th>
          <th>Qualification</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // showing admin added from database
        if ($cat == "all") {
          $sql = "SELECT DISTINCT users.u_id AS u_id,users.u_name AS u_name,users.u_image AS u_image ,users.u_mob AS u_mob,
                        consultant.c_office AS c_office,consultant.c_from_time As c_from_time, consultant.c_to_time As c_to_time , 
                        consultant.c_language AS c_language, consultant.c_fee AS c_fee ,consultant.c_aval_days As c_aval_days,consultant.c_qualification AS c_qualification ,
                        consultant_category.cat_name AS cat_name FROM consultant_category JOIN consultant JOIN users
                        WHERE users.u_id = consultant.u_id 
                        AND consultant.c_category=consultant_category.cat_id AND users.u_type='consultant' ORDER BY users.u_name  LIMIT $start_from, $limit ";
          $res = mysqli_query($conn1, $sql);

          //checking whether query is executed or not
          $count = mysqli_num_rows($res);
          $sno = 1;
          if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
              $app_id = rand(0000000, 9999999);
        ?>
              <tr>
                <td><?php echo $sno++; ?></td>
                <td><img src="<?php echo "../img/users/" . $row['u_image']; ?>" width="100" height="100"></td>
                <td><?php echo $row['u_name']; ?></td>
                <td><?php echo $row['cat_name']; ?></td>
                <td><?php echo $row['c_office']; ?></td>
                <td><?php echo $row['c_language']; ?></td>
                <td><?php echo $row['c_from_time']; ?></td>
                <td><?php echo $row['c_to_time']; ?></td>
                <td><?php echo $row['c_fee']; ?></td>
                <td>
                  <?php
                  $available_days = explode(',', $row["c_aval_days"]);
                  foreach ($available_days as $day) {
                    echo $day . "<br>";
                  }
                  ?>
                </td>
                <td><?php echo $row['c_qualification']; ?></td>
                <td>
                  <a class="btn btn-sm me-8" style="background-color:rgb(51, 154, 251);" href="./appoint.php?cid=<?php echo $row['u_id']; ?>&b_id=<?php echo $app_id; ?>&cat_name=<?php echo $row['cat_name']; ?>&con_name=<?php echo $row['u_name']; ?>">Book Appointment</a>
                  <?php
                  if (isset($_SESSION['current_user_id'])) {
                    $email = $_SESSION['current_user_email'];
                    $sql = "SELECT * FROM `webhook` WHERE email='$email'";
                    $user_id = $_SESSION['current_user_id'];
                    $res2 = mysqli_query($conn, $sql);
                    $row2 = mysqli_fetch_assoc($res2);
                    $count = mysqli_num_rows($res2);

                    if ($count > 0) {
                      $user_name = substr($_SESSION['current_user_name'], 0, 4);
                      $con_name = substr($row['u_name'], 0, 4);
                      $consult_id = $row['u_id'];
                      $user_id = $_SESSION['current_user_id'];
                      $channel_name = $user_id . $con_name;
                      $appID = "8a0176984cea4e4e8a96c984d149d52f";
                      $appCertificate = "0bfb49c03978438a8f6723c29f9ccdee";
                      $channelName = $user_name . $con_name;
                      $time = date('Y-m-d H:i:s');
                  ?>
                      <a id="link" class="btn btn-secondary btn-sm" data-id="<?php echo $consult_id; ?>" onclick="redirectTo('<?php echo $consult_id; ?>','<?php echo $user_id; ?>','<?php echo $user_name; ?>','<?php echo $con_name; ?>')">JOIN NOW</a>
                  <?php
                    }
                  }
                  ?>
                </td>
              </tr>
            <?php
            }
          } else {
            echo "<tr><td colspan='12'>No records found</td></tr>";
          }
        } else {
          // Your query for specific category
          $sql = "SELECT DISTINCT users.u_id AS u_id,users.u_name AS u_name,users.u_image AS u_image ,users.u_mob AS u_mob,
                        consultant.c_office AS c_office,consultant.c_from_time As c_from_time, consultant.c_to_time As c_to_time , 
                        consultant.c_language AS c_language, consultant.c_fee AS c_fee ,consultant.c_aval_days As c_aval_days,consultant.c_qualification AS c_qualification ,
                        consultant_category.cat_name AS cat_name FROM consultant_category JOIN consultant JOIN users
                        WHERE users.u_id = consultant.u_id 
                        AND consultant.c_category=consultant_category.cat_id AND users.u_type='consultant' AND consultant_category.cat_name='$cat' ORDER BY users.u_name
    LIMIT $start_from, $limit";
          $res = mysqli_query($conn1, $sql);

          //checking whether query is executed or not
          $count = mysqli_num_rows($res);
          $sno = 1;
          if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
              $app_id = rand(0000000, 9999999);
            ?>
              <tr>
                <td><?php echo $sno++; ?></td>
                <td><img src="<?php echo "../img/users/" . $row['u_image']; ?>" width="100" height="100"></td>
                <td><?php echo $row['u_name']; ?></td>
                <td><?php echo $row['cat_name']; ?></td>
                <td><?php echo $row['c_office']; ?></td>
                <td><?php echo $row['c_language']; ?></td>
                <td><?php echo $row['c_from_time']; ?></td>
                <td><?php echo $row['c_to_time']; ?></td>
                <td><?php echo $row['c_fee']; ?></td>
                <td>
                  <?php
                  $available_days = explode(',', $row["c_aval_days"]);
                  foreach ($available_days as $day) {
                    echo $day . "<br>";
                  }
                  ?>
                </td>
                <td><?php echo $row['c_qualification']; ?></td>
                <td>
                  <a class="btn btn-sm me-8" style="background-color:rgb(51, 154, 251); color:white;" href="./appoint.php?cid=<?php echo $row['u_id']; ?>&b_id=<?php echo $app_id; ?>&cat_name=<?php echo $row['cat_name']; ?>&con_name=<?php echo $row['u_name']; ?>">Book Appointment</a>
                  <?php
                  if (isset($_SESSION['current_user_id'])) {
                    $email = $_SESSION['current_user_email'];
                    $sql = "SELECT * FROM `webhook` WHERE email='$email'";
                    $user_id = $_SESSION['current_user_id'];
                    $res2 = mysqli_query($conn, $sql);
                    $row2 = mysqli_fetch_assoc($res2);
                    $count = mysqli_num_rows($res2);

                    if ($count > 0) {
                      $user_name = substr($_SESSION['current_user_name'], 0, 4);
                      $con_name = substr($row['u_name'], 0, 4);
                      $consult_id = $row['u_id'];
                      $user_id = $_SESSION['current_user_id'];
                      $channel_name = $user_id . $con_name;
                      $appID = "8a0176984cea4e4e8a96c984d149d52f";
                      $appCertificate = "0bfb49c03978438a8f6723c29f9ccdee";
                      $channelName = $user_name . $con_name;
                      $time = date('Y-m-d H:i:s');
                  ?>
                      <a id="link" class="btn btn-secondary btn-sm" data-id="<?php echo $consult_id; ?>" onclick="redirectTo('<?php echo $consult_id; ?>','<?php echo $user_id; ?>','<?php echo $user_name; ?>','<?php echo $con_name; ?>')">JOIN NOW</a>
                  <?php
                    }
                  }
                  ?>
                </td>
              </tr>
        <?php
            }
          } else {
            echo "<tr><td colspan='12'>No records found</td></tr>";
          }
        }
        ?>
      </tbody>
    </table>
    <?php if ($total_pages > 1) {
      echo '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';
      for ($i = 1; $i <= $total_pages; $i++) {
        echo "<li class='page-item" . ($i == $page ? " active" : "") . "'>
                 <a class='page-link' href='cdetails.php?category=$cat&page=$i'>$i</a>
              </li>";
      }
      echo '</ul></nav>';
    }
    ?>

  </div>
</div>


<div class="modal fade" id="SheduleleModal" tabindex="-1" aria-labelledby="SheduleleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="SheduleleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" id="schedule" name="schedule">

          <div class="container">
            <div class="row">
              <div class='col-sm-6'>
                <div class="input-group">
                  <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" id="date1" name="date1">
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                  </div>

                </div>

              </div>
            </div>
          </div>

          <input type="submit" id="submit">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>


<div>
  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- SweetAlert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <style>
    .fa {
      display: inline-flex;
      justify-content: center;
      align-items: center;
      padding: 10px;
      font-size: 20px;
      width: 40px;
      height: 40px;
      margin: 5px;
      text-align: center;
      text-decoration: none;
      border-radius: 50%;
      transition: transform 0.2s ease;
    }

    .fa:hover {
      transform: scale(1.1);
      opacity: 0.8;
    }

    .fa-facebook-f {
      background: #3B5998;
      color: white;
    }

    .fa-twitter {
      background: #55ACEE;
      color: white;
    }

    .fa-linkedin {
      background: #007bb5;
      color: white;
    }

    .fa-instagram {
      color: white;
      background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
      box-shadow: 0px 3px 10px rgba(0, 0, 0, .25);
    }

    @media only screen and (max-width: 600px) {
      .on-desktop {
        display: none;
      }

      .on-mobile {
        display: block;
      }
    }

    @media (min-width: 1025px) and (max-width: 1280px) {
      .on-desktop {
        display: block;
      }

      .on-mobile {
        display: none;
      }
    }

    .footer-widget {
      padding-left: 5px !important;
      padding-right: 5px !important;
    }

    .email-container {
      max-width: 600px;
      margin: 0 auto;
    }

    .email-label {
      display: block;
      margin-bottom: 10px;
      font-size: 18px;
      color: #333;
    }

    .email-form {
      display: flex;
      border: 1px solid #ccc;
      border-radius: 16px;
      padding: 6px;
      background: white;
    }

    .email-form input[type="email"] {
      flex: 1;
      min-width: 100px;
      padding: 16px;
      border: none;
      outline: none;
      font-size: 16px;
    }

    .email-form button {
      padding: 12px 20px;
      background-color: #fff;
      font-weight: bold;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 12px;
      cursor: pointer;
      transition: background 0.2s ease;
    }

    .email-form button:hover {
      background-color: rgb(215, 211, 211);
    }
  </style>
  </head>

  <body>


    <footer class="bg-white border-top mb-5">
      <div class="container" style="padding-top: 30px;">

        <div class="row g-5">


          <!-- Logo Section -->
          <div class="col-md-3 mb-3 mt-5">
            <a href="http://www.spacece.in">
              <img src="<?= isset($main_logo) ? $main_logo : '#' ?>" class="img img-fluid img-thumbnail img-circle" alt="Logo" style="width: 240px; height:240px; border:none;" />
            </a>
          </div>

          <!-- Contact Section -->
          <div class="col-md-3 mb-3 mt-5 text-start">
            <div class="contact-widget" style="color: black;">
              <h5 style="font-size: 20px !important;">Contact Us</h5>

              <p class="mb-3" style="font-size: 15px !important; margin-right: 150px !important;">
                <i class="fa-solid fa-phone text-warning me-2"></i> +91 90963 05648
              </p>

              <p class="mb-3" style="font-size: 15px !important; margin-right: 125px !important;">
                <i class="fas fa-envelope text-warning me-2"></i> events@spaceece.co
              </p>

              <p class="mb-3" style="font-size: 15px !important; margin-right: 190px !important;">
                <i class="fas fa-map-marker-alt text-warning me-2"></i> SPACE-ECE
              </p>

              <p class="mb-3" style="font-size: 15px !important; margin-right: 120px !important;">
                <i class="fas fa-clock text-warning me-2"></i> Mon - Sat 8 AM - 6 PM
              </p>
            </div>
          </div>

          <!-- Health Message + Social Media -->
          <div class="col-md-3 mb-3 mt-5 text-start">
            <h5 class="text-warning" style="font-size:20px;">Still delaying treatment for your child's health concerns?</h5>
            <p class="mb-3 fs-6" style="text-align: left; font-size:15px !important;">Connect with India’s top doctors online, today!</p>
            <h5 style="font-size:20px">Our Socials</h6>
              <div>
                <a href="https://www.facebook.com/SpacECEIn" target="_blank" class="text-dark me-3"><i class="fa-brands fa-facebook "></i></a>
                <a href="https://twitter.com/" target="_blank" class="text-dark me-3"><i class="fa-brands fa-twitter "></i></a>
                <a href="https://www.linkedin.com/company/spacece-co/" target="_blank" class="text-dark me-3"><i class="fa-brands fa-linkedin "></i></a>
                <a href="https://www.instagram.com/spacece.in/" target="_blank" class="text-dark"><i class="fa-brands fa-instagram "></i></a>
              </div>

          </div>

          <!-- Newsletter Section -->
          <div class="col-md-3 mb-3 mt-5 text-start">
            <h5 style="font-size:20px !important;">Subscribe To Our Newsletter</h5>
            <p class="mb-3 fs-6" style="text-align: left; font-size:15px !important;">Subscribe to our newsletter to get updates, offers and discounts.</p>

            <div class="email-container">
              <label class="email-label fs-6" style="text-align: left; font-size:15px !important;" for="email">Enter your email -</label>
              <form id="sub" class="email-form">
                <input type="email" id="email" placeholder="Email here" required />
                <button type="submit">Submit</button>
              </form>
            </div>

          </div>

        </div>
      </div>

    </footer>

    <?= isset($extra_scripts) ? $extra_scripts : null ?>

    <script>
      $(document).ready(function() {
        $('#sub').on('submit', function(e) {
          e.preventDefault();
          var email = $('#email').val();

          $.ajax({
            method: "POST",
            url: "./common/function.php",
            data: {
              subscribe: 1,
              email: email
            },
            success: function(data) {
              console.log("Server response:", data);
              handleSubscriptionResponse(data);
            },
            error: function(xhr, status, error) {
              swal("Error!", "Something went wrong. Please try again later.", "error");
            }
          });
        });

        function handleSubscriptionResponse(data) {
          switch (data.trim()) {
            case 'Error':
              swal("Error!", "You have already subscribed to this site!", "error");
              break;
            case 'Success':
              swal("Good job!", "You have subscribed!", "success");
              break;
            case 'Invalid':
              swal("Error!", "Please enter a valid email!", "error");
              break;
            default:
              swal("Error!", "Unexpected response from the server.", "error");
          }
        }
      });
    </script>

  </body>

  </html>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/agora-rtc-sdk@3.5.1/AgoraRTCSDK.min.js"></script>
<script type="text/javascript">
  $(function() {
    $('#datetimepicker1').datetimepicker({
      format: "YYYY-MM-DD HH:mm:ss ",
      minDate: moment()
    });
  });
</script>
<script>

</script>



<script type="text/javascript">
  function scheduleredirectTo(id, user_id, channel_name, user_name, channelName) {
    var c_id = id;

    var url = window.location.href;
    var regex = new RegExp('/[^/]*$');
    var linkfull = url.replace(regex, '/');

    $.ajax({
      url: 'video.php',
      method: 'POST',
      data: {
        generateToken: 1,
        c_id: c_id,
        user_id: user_id,
        user_name: user_name


      },
      success: function(data) {
        var data1 = JSON.parse(data);
        var appId = data1['appID'];
        var token = data1['token'];
        var url = window.location.href;
        var regex = new RegExp('/[^/]*$');
        var linkfull = url.replace(regex, '/');
        var link = linkfull + "Agora_Web_SDK_FULL/index.html?id=" + token + "&appId=" + appId + "&channel=" + user_name + "&c_id=" + c_id + "&user_id=" + user_id;
        $('#schedule').on('submit', function(e) {
          var time = $('#date1').val();


          e.preventDefault();



          $.ajax({
            url: "video.php",
            method: "POST",
            data: {
              link: link,
              c_id: c_id,
              video: 1,
              channel_name: channel_name,
              time: time,
              token: token,
              user_id: user_id,
            },
            success: function(data) {
              console.log(data);
              //  alert(data);
            }
          })

        });
      }
    });
  }

  function redirectTo(id, user_id, channel_name, user_name, channelName) {

    var c_id = id;

    var url = window.location.href;
    var regex = new RegExp('/[^/]*$');
    var linkfull = url.replace(regex, '/');
    var date = new Date();
    var time =
      date.getFullYear() + "-" +
      ("00" + (date.getMonth() + 1)).slice(-2) + "-" +
      ("00" + date.getDate()).slice(-2) + " " +
      ("00" + date.getHours()).slice(-2) + ":" +
      ("00" + date.getMinutes()).slice(-2) + ":" +
      ("00" + date.getSeconds()).slice(-2);
    console.log(time); //without params it defaults to "now"

    $.ajax({
      url: 'video.php',
      method: 'POST',
      data: {
        generateToken: 1,
        c_id: c_id,
        user_id: user_id,
        user_name: user_name


      },
      success: function(data) {
        // alert(data);
        var data1 = JSON.parse(data);
        var appId = data1['appID'];
        var token = data1['token'];
        var url = window.location.href;
        var regex = new RegExp('/[^/]*$');
        var linkfull = url.replace(regex, '/');

        var link = linkfull + "Agora_Web_SDK_FULL/index.html?id=" + token + "&appId=" + appId + "&channel=" + user_name + "&c_id=" + c_id + "&user_id=" + user_id;

        $.ajax({
          url: "video.php",
          method: "POST",
          data: {
            link: link,
            c_id: c_id,
            video: 1,
            time: time,
            channel_name: user_name,
            token: token,
            user_id: user_id,



          },
          success: function(data) {
            console.log(data);
            // alert(data);
            window.location.href = "Agora_Web_SDK_FULL/index.html?id=" + token + "&appId=" + appId + "&channel=" + user_name + "&c_id=" + c_id + "&user_id=" + user_id;
          }


        });
      }

    });



    window.location.href = "Agora_Web_SDK_FULL/index.html?id=" + token + "&appId=" + appId + "&channel=" + channel_name + "&id=" + id + "&user_id=" + user_id;
  }
</script>
