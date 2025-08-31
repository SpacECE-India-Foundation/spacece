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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
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
      padding: 80px;
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
          <td>Completed</td>
          <td><input type="radio" name="option"> Pending <input type="radio" name="option"></td>
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
          <td>Completed</td>
          <td><input type="radio" name="option1"> Pending <input type="radio" name="option1"></td>
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
          <td>Completed</td>
          <td><input type="radio" name="option2"> Pending <input type="radio" name="option2"></td>
          <td><button>Book Pediatrician</button></td>
        </tr>
      </tbody>
    </table>
  </div>

<footer class="bg-white border-top pb-5">
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
    
    <p class="mb-3" style="font-size: 15px !important; margin-right: 120px !important;">
      <i class="fa-solid fa-phone text-warning me-2"></i> +91 90963 05648
    </p>
    
    <p class="mb-3" style="font-size: 15px !important; margin-right: 95px !important;">
      <i class="fas fa-envelope text-warning me-2"></i> events@spaceece.co
    </p>
    
    <p class="mb-3" style="font-size: 15px !important; margin-right: 120px !important;">
      <i class="fas fa-map-marker-alt text-warning me-2"></i> SPACE-ECE
    </p>
    
    <p class="mb-3" style="font-size: 15px !important; margin-right: 80px !important;">
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
                <input type="email" id="email" class='form-control' placeholder="Email here" required />
                <button type="submit" class='btn btn-warning' >Submit</button>
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
            url: "../common/function.php",
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


</body>
</html>
