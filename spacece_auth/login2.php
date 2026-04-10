<?php
include_once './header_local.php';
include_once '../common/header_module.php';

if (!isset($_SESSION['redirect_url'])) {
  $_SESSION['redirect_url'] = $_SERVER['HTTP_REFERER'];
}

$redirectUrl = $_SESSION['redirect_url'];

if (isset($_SESSION['current_user_id'])) {
  header("Location: " . $redirectUrl);
  exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Spaces Web Portal - Login</title>

  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #ddd;
    }

    header {
      background-color: white;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 40px 60px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .logo-container {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .logo-container img {
      width: 90px;
      height: auto;
    }

    .logo-container span {
      font-size: 28px;
      font-weight: bold;
    }

    .icons {
      display: flex;
      gap: 30px;
      align-items: center;
    }

    .icons img {
      width: 30px;
      cursor: pointer;
      
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: calc(100vh - 140px);
      margin-top: 110px;
    }

    .login-box {
      background-color: #eee;
      padding: 40px;
      width: 90%;
      max-width: 500px;
      text-align: center;
      box-sizing: border-box;
    }

    .login-box h2 {
      margin-bottom: 30px;
    }

    .login-box label {
      display: block;
      text-align: left;
      margin-bottom: 5px;
      font-size: 14px;
    }

    .login-box input[type="text"],
    .login-box input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 2px;
      font-size: 14px;
      box-sizing: border-box;
    }

    .login-box button {
      background-color: #f5a400;
      color: white;
      border: none;
      padding: 12px 0;
      width: 150px;
      font-size: 16px;
      cursor: pointer;
      border-radius: 2px;
      margin-bottom: 20px;
    }

    .login-box a {
      display: block;
      color: #00aaff;
      margin: 5px 0;
      text-decoration: none;
    }

    .login-box a:last-child {
      color: black;
    }

    .login-box a:last-child span {
      color: #00aaff;
      margin-left: 5px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="login-box">
      <h2>Login</h2>
      <form method="post" class="login-form">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="Enter Email">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter Password">

        <label for="type">User Type</label>
        <select style="padding:5px;" name="type" id="user_type" class="form-control" required>
          <option value="customer">Customer</option>
          <option value="consultant">Consultant</option>
          <option value="admin">Admin</option>
          <option value="book_owner">Book Owner</option>
          <option value="delivery_boy">Delivery Boy</option>
        </select>

        <button type="submit" name="login" class="btn btn-primary">Login</button>

        <a href="forgotPass.php">Forgot Password</a>
        <a href="register.php">Not Registered ? <span>Create an Account</span></a>
      </form>
    </div>
  </div>
</body>

<div>
  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- SweetAlert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <style>


.container, .footer {
    padding-top: 0 !important;
    padding-bottom: 0 !important;
    margin-top: 0 !important;
    margin-bottom: 0 !important;
}
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


    <footer class="bg-white border-top pb-5">
      <div class="container py-0" style="padding-top: 30px;
      margin-top: 30px;">

        <div class="row g-5">


          <!-- Logo Section -->
          <div class="col-md-3 mb-3 mt-5">
            <a href="http://www.spacece.in">
              <img src="<?= isset($main_logo) ? $main_logo : '../img/logo/SpacECELogo.jpg' ?>" class="img img-fluid img-thumbnail img-circle" alt="Logo" style="width: 240px; height:240px; border:none; margin-left:-80px !important; margin-top:20px !important;" />
            </a>
          </div>

          <!-- Contact Section -->
         <div class="col-md-3 mb-3 mt-5 text-start">
  <div class="contact-widget" style="color: black; margin-left:-40px !important; margin-top:20px !important;">
    <h5 style="font-size: 20px !important;">Contact Us</h5>
    
    <p class="mb-3" style="font-size: 15px !important; margin-right: 90px !important;">
      <i class="fa-solid fa-phone text-warning me-2"></i> +91 90963 05648
    </p>
    
    <p class="mb-3" style="font-size: 15px !important; margin-right: 50px !important;">
      <i class="fas fa-envelope text-warning me-2"></i> events@spaceece.co
    </p>
    
    <p class="mb-3" style="font-size: 15px !important; margin-right: 120px !important;">
      <i class="fas fa-map-marker-alt text-warning me-2"></i> SPACE-ECE
    </p>
    
    <p class="mb-3" style="font-size: 15px !important; margin-right: 50px !important;">
      <i class="fas fa-clock text-warning me-2"></i> Mon - Sat 8 AM - 6 PM
    </p>
  </div>
</div>

          <!-- Health Message + Social Media -->
           
          <div class="col-md-3 mb-3 mt-5 text-start">
            <h5 class="text-warning" style="font-size:20px;  margin-left:-10px !important; margin-top:12px !important;">Still delaying treatment for your child's health concerns?</h5>
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
            <div style="margin-left: 20px;">
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
      </div>

    </footer>

    <?= isset($extra_scripts) ? $extra_scripts : null ?>

    <script>
      $(document).ready(function() {
        $('#sub').on('submit', function(e) {
          e.preventDefault();
          var email = $('#email').val();

            // ✅ Custom regex for stricter email validation
            // Previously, the form relied only on HTML5 type="email", which allowed invalid emails like 'test@mailcom'
            // Now, we use regex /^[^\s@]+@[^\s@]+\.[^\s@]+$/ to ensure:
            //   1. Email contains '@' symbol
            //   2. Email contains a dot '.' after domain (like .com, .in)
            //   3. Prevents invalid formats like 'test@mailcom' or 'test@.com'
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailPattern.test(email)) {
                swal("Error!", "Please enter a valid email address!", "error");
                return;
            }

          $.ajax({
            method: "POST",
            // ✅ Changed URL path
            // Previously: './common/function.php'
            // Now: '../common/function.php' to correctly point to the PHP handler from current page directory
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