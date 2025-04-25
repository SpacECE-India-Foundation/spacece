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
<ht lang="en">
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

    .icons {
      display: flex;
      gap: 30px;
      align-items: center;
    }

    .icons img {
      width: 24px;
      cursor: pointer;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 30px 0;
    }

    .login-box {
      background-color: #eee;
      padding: 40px;
      width: 500px;
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
    }

    .fa-android {
      background: #a4c639;
      color: white;
    }

    .fa-dribbble {
      background: #ea4c89;
      color: white;
    }

    .fa-vimeo {
      background: #45bbff;
      color: white;
    }

    .fa-tumblr {
      background: #2c4762;
      color: white;
    }

    .fa-vine {
      background: #00b489;
      color: white;
    }

    .fa-foursquare {
      background: #45bbff;
      color: white;
    }

    .fa-stumbleupon {
      background: #eb4924;
      color: white;
    }

    .fa-flickr {
      background: #f40083;
      color: white;
    }

    .fa-yahoo {
      background: #430297;
      color: white;
    }

    .fa-soundcloud {
      background: #ff5500;
      color: white;
    }

    .fa-reddit {
      background: #ff5700;
      color: white;
    }

    .fa-rss {
      background: #ff6600;
      color: white;
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
  </style>
</head>

<body>

  <div class="login-page">
    <h2>Login</h2>
    <form class="login-form" method="post" autocomplete="off">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" placeholder="Enter Email" name="email" required />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" placeholder="Enter Password" name="password" required />
      </div>
      <div class="form-group">
        <label for="type">User Type</label>
        <select style="padding:5px;" name="type" id="user_type" class="form-control" required>
          <option value="customer">Customer</option>
          <option value="consultant">Consultant</option>
          <option value="admin">Admin</option>
          <option value="book_owner">Book Owner</option>
          <option value="delivery_boy">Delivery Boy</option>
        </select>
      </div>
      <button type="submit" name="login" class="btn btn-primary">Login</button>
      <br>
      <p class="message"><a href="forgotPass.php">Forgot Password?</a></p>
      <p class="message">Not registered? <a href="register.php">Create an account</a></p>
    </form>
  </div>

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

    .fa-facebook-f { background: #3B5998; color: white; }
    .fa-twitter { background: #55ACEE; color: white; }
    .fa-linkedin { background: #007bb5; color: white; }
    .fa-instagram {
      color: white;
      background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
      box-shadow: 0px 3px 10px rgba(0, 0, 0, .25);
    }

    @media only screen and (max-width: 600px) {
      .on-desktop { display: none; }
      .on-mobile { display: block; }
    }

    @media (min-width: 1025px) and (max-width: 1280px) {
      .on-desktop { display: block; }
      .on-mobile { display: none; }
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

<div class="container-fluid" style="padding: 0;">
  <footer class="footer-section set-bg" style="background-color: white; opacity: 0.9; padding: 30px;">
    <div class="row">
      
      <!-- Logo Section -->
      <div class="col-lg-3 footer-widget">
        <a href="http://www.spacece.in">
          <img src="<?= isset($module_logo) ? $module_logo : '/spacece/img/logo/SpacECELogo.jpg' ?>" class="img img-fluid img-thumbnail img-circle" alt="Logo" style="width: 400px; height:300px; border: none; margin-top: -15px;" />
        </a>
      </div>

      <!-- Contact Section -->
      <div class="col-lg-2 footer-widget" style="text-align: justify;">
        <div class="contact-widget" style="color: black;">
          <h5 class="fw-title" style="color: black; font-size: 25px; text-transform: none; margin-top: 1px; font-weight: normal;">Contact Us</h5>
          <div style="display: flex; flex-direction: column; justify-content: space-around; margin-top: -15px;">
            
            <p style="margin: 5px 0; font-size: 14px;">
              <a href="tel:+919096305648" target="_blank" rel="noopener" style="display: flex; align-items: center; color: black; text-decoration: none; font-size: 20px;">
                <i class="fa-solid fa-phone" style="margin-right: 10px; font-size: 22px;color: black;"></i>
                +91 90963 05648
              </a>
            </p>
            
            <p style="margin: 5px 0; font-size: 14px;">
              <a href="mailto:events@spacece.co" target="_blank" rel="noopener" style="display: flex; align-items: center; color: black; text-decoration: none; font-size: 20px;">
              <i class="fa-regular fa-envelope" style="margin-right: 10px; font-size: 22px;color: black;"></i>
                events@spacece.co
              </a>
            </p>

            <p style="margin: 2px 0; font-size: 14px;">
            <a href="https://maps.app.goo.gl/YDb6ZAsN4vQ1KWZE8" style="display: flex; align-items: center; color: black; text-decoration: none; font-size: 20px; transform: translateX(-11px);">
              <i class="fa fa-map-marker" style="font-size: 24px; margin-right: 10px;"></i>
              <span style="margin-left: -5px;">SPACE-ECE</span>
            </a>
          </p>

            
            <p style="margin: 5px 0; font-size: 20px; color: black;">
              <i class="fa-regular fa-clock-o" style="margin-right: 10px; font-size: 22px;"></i>
              Mon - Sat, 8AM - 6PM
            </p>
          </div>
        </div>
      </div>

      <!-- Health Message + Social Media -->
      <div class="col-lg-4 footer-widget">
        <p style="color: black; transform: translateX(-30px); margin-left: 90px; font-size: 25px; margin-top: 5px;">Still delaying treatment for your child's health concerns?</p><br>
        <p style="color: black; font-size: 20px; transform: translateX(-30px); margin-left: 90px;">Connect with India's top doctors online, today!</p>

        <div class="social" style="margin-top: 20px;">
          <p style="color: black; font-size: 21px; transform: translateX(-30px); margin-left: 90px;">Our Socials</p>
          <div style="display: flex; justify-content: center; gap: 15px; margin-top: 10px;">
    
          <div style="transform: translateX(-70px); display: flex; gap: 2px;">
          <a href="https://www.facebook.com/SpacECEIn" target="_blank">
            <img src="/spacece/gallery/FACEBOOK.png" alt="Facebook" style="width: 30px; height: 30px;">
          </a>
          
          <a href="https://twitter.com/" target="_blank">
            <img src="/spacece/gallery/TWITTER.jpg" alt="Twitter" style="width: 30px; height: 30px;">
          </a>
          
          <a href="https://www.linkedin.com/company/spacece-co/" target="_blank">
            <img src="/spacece/gallery/LINKED_IN.jpg" alt="LinkedIn" style="width: 30px; height: 30px;">
          </a>
          
          <a href="https://www.instagram.com/spacece.in/" target="_blank">
            <img src="/spacece/gallery/INSTAGRAM.jpg" alt="Instagram" style="width: 30px; height: 30px;">
          </a>
        </div>

  </div>
        </div>
      </div>

      <!-- Newsletter Section -->
      <div class="col-lg-3 footer-widget">
        <div class="newslatter-widget">
          <h5 class="fw-title" style="color: black; text-transform: none; font-weight: normal;">Subscribe To Our Newsletter</h5>
          <p style="color: black; font-size: 18px;">Subscribe to our newsletter to get updates, offers and discounts.</p>

          <div class="email-container">
            <label class="email-label" for="email">Enter your email -</label>
            <form id="sub" class="email-form">
              <input type="email" id="email" placeholder="Email here" required />
              <button type="submit">Submit</button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </footer>
</div>

<p class="font_10" style="line-height: 1.8em; text-align: center; font-size: 20px;">
  <span style="font-size: 20px"><span class="color_15">&copy;2021 by spaceECE INDIA FOUNDATION</span></span>
</p>

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