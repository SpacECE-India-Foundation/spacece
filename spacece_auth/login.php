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

  <div class="container">
    <div class="login-box">
      <h2>Login</h2>
      <form>
        <label for="email">Email</label>
        <input type="text" id="email" placeholder="Enter Email">

        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Enter Password">

        <button type="submit">Login</button>

        <p><a href="forgotpass.php">Forgot Password</a></p>
        <a href="register.php">Not Registered ? <span>Create an Account</span></a>
      </form>
    </div>
  </div>

  <footer>
    <div class="container">
      <footer class="footer-section set-bg" style="
        background-color: orange;
        border-collapse: collapse;
        border: 2px solid navy;
        opacity: 0.9;
        padding: 30px 30px;
      ">

        <div class="row">
          <div class="col-lg-3 footer-widget ">
            <a href="http://www.spacece.in"><img src="<?= isset($module_logo) ? $module_logo : '../img/logo/SpacECELogo.jpg' ?>" class="img img-fluid img-thumbnail img-circle" alt="" style="width: 150px" /></a><a href="./index.php">

            </a>

            <div class="social">
              <a href="https://www.facebook.com/SpacECEIn"><i class="fa fa-facebook-f"></i></a>
              <a href="https://www.instagram.com/spacece.in/"><i class="fa fa-instagram"></i></a>
              <a href="https://t.me/joinchat/EtMJq_3BKL4zNGE1"><i class="fa fa-telegram" aria-hidden="true"></i></a>
              <a href="https://www.linkedin.com/company/spacece-co/"><i class="fa fa-linkedin"></i></a>
            </div>
          </div>

          <div class="col-lg-3  footer-widget">
            <p style="color: black">
              Still delaying your child's health concerns ?
            </p>
            <p style="color: black">Connect with India's top doctors online</p>
          </div>
          <div class="col-lg-3 footer-widget" style="text-align: justify;">
            <div class="contact-widget" style="color: black;">
              <h5 class="fw-title" style="color: black; font-size: 16px;">CONTACT US</h5>
              <div style="display: flex; flex-direction: column; justify-content: space-around;">
                <p style="margin: 2px 0; font-size: 14px;">
                  <!-- <a href="http://www.spacece.in/" style="display: flex; align-items: center; color: black; text-decoration: none; font-size: 18px;"> -->
                  <a href="https://maps.app.goo.gl/YDb6ZAsN4vQ1KWZE8" style="display: flex; align-items: center; color: black; text-decoration: none; font-size: 18px;">
                    <i class="fa fa-map-marker" style="margin-right: 10px; font-size: 18px;"></i>
                    SPACE-ECE
                  </a>
                </p>
                <p style="margin: 5px 0; font-size: 14px;">
                  <a href="tel:+919096305648" target="_blank" rel="noopener" style="display: flex; align-items: center; color: black; text-decoration: none; font-size: 18px;">
                    <i class="fa fa-phone" style="margin-right: 10px; font-size: 18px;color: black;"></i>
                    +91 90963 05648
                  </a>
                </p>
                <p style="margin: 5px 0; font-size: 14px;">
                  <a href="mailto:events@spacece.co" target="_blank" rel="noopener" style="display: flex; align-items: center; color: black; text-decoration: none; font-size: 18px;">
                    <i class="fa fa-envelope" style="margin-right: 10px; font-size: 18px;color: black;"></i>
                    events@spacece.co
                  </a>
                </p>
                <p style="margin: 5px 0; font-size: 18px; color: black;">
                  <i class="fa fa-clock-o" style="margin-right: 10px; font-size: 18px;"></i>
                  Mon - Sat, 8AM - 6PM
                </p>
              </div>
            </div>
          </div>




          <div class="col-lg-3  footer-widget">
            <div class="newslatter-widget">
              <h5 class="fw-title" style="color: black; text-align: center">
                NEWSLETTER
              </h5>
              <p style="color: black">
                Subscribe your email to get the latest news and new offer also
                discount
              </p>
              <form class="footer-newslatter-form" id="sub" name="sub" method="POST">
                <input type="email" name="email" id="email" placeholder="Email address" required />

                <button type="submit" style="cursor: pointer;margin-bottom:15px;">
                  <i style="font-size: 15px;" class="fa fa-send"></i>
                </button>
              </form>
            </div>
          </div>
        </div>

    </div>
  </footer>
  <p class="font_10" style="line-height: 1.8em; text-align: center; font-size: 20px">
    <span style="font-size: 20px"><span class="color_15">&copy;2021 by spaceECE INDIA FOUNDATION</span></span>
  </p>
  </footer>
  <?= isset($extra_scripts) ? $extra_scripts : null ?>

</body>
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
          console.log("Server response:", data); // Log the server response for debugging
          handleSubscriptionResponse(data);
        },
        error: function(xhr, status, error) {
          swal("Error!", "Something went wrong. Please try again later.", "error");
        }
      });
    });

    function handleSubscriptionResponse(data) {
      switch (data.trim()) { // Use trim() to remove any extra whitespace
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