<?php
ob_start(); // Start output buffering

include_once './header_local.php';
include_once '../common/header_module.php';
include_once '../Db_Connection/db_spacece.php';

// Check if form is submitted
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//   if (isset($_POST['email'], $_POST['type'])) {
//     $email = $_POST['email'];
//     // $type = $_POST['type'];

//     // Validate email and type (to be implemented according to your validation rules)

//     // Check if email exists in database for the selected type
//     $query = "SELECT * FROM users WHERE u_email = ?";
//     $stmt = $conn->prepare($query);
//     $stmt->bind_param('ss', $email, $type);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     $user = $result->fetch_assoc();

//     if ($user) {
//       // Generate token
//       $token = bin2hex(random_bytes(50));

//       // Set expiry date (24 hours from now)
//       $expiry_date = date('Y-m-d H:i:s', strtotime('+24 hours'));

//       // Update user record with token and expiry
//       $update_query = "UPDATE users SET reset_link_token = ?, token_expire = ? WHERE u_email = ?";
//       $update_stmt = $conn->prepare($update_query);
//       $update_stmt->bind_param('ssss', $token, $expiry_date, $email, $type);
//       $update_stmt->execute();
//       // Email exists - now send the reset link
//       $subject = "Reset Your Password - Spaces Web Portal";
//       $message = "Hi " . $user['u_name'] . ",\n\n";
//       $message .= "Click the link below to reset your password:\n";
//       $message .= "https://yourdomain.com/reset-password.php?email=" . urlencode($email) . "\n\n";
//       $message .= "If you didn’t request this, just ignore it.\n\nThanks,\nSpaces Team";

//       $headers = "From: no-reply@yourdomain.com";

//       if (mail($email, $subject, $message, $headers)) {
//         echo '<div class="container"><h2>Forgot Password</h2><div class="alert alert-success">Reset link has been sent to your email address.</div></div>';
//       } else {
//         echo '<div class="container"><h2>Forgot Password</h2><div class="alert alert-danger">Failed to send email. Please try again later.</div></div>';
//       }

//       $showResetForm = false; // Don't show the reset form until link is clicked
//     } else {
//       // Email does not exist for the selected type
//       echo '<div class="container"><h2>Forgot Password</h2><div class="alert alert-danger">No user found with the provided email and type.</div></div>';
//     }
//   }
// }

// Handle password reset form submission
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_password'])) {
//   $email = $_POST['email'];
//   $type = $_POST['type'];
//   $new_password = $_POST['password'];

//   // Hash the password using md5 (not recommended for security reasons)
//   $hashed_password = md5($new_password);

//   // Update password in the database
//   $update_query = "UPDATE users SET u_password = ? WHERE u_email = ? AND u_type = ?";
//   $update_stmt = $conn->prepare($update_query);
//   $update_stmt->bind_param('sss', $hashed_password, $email, $type);

//   if ($update_stmt->execute()) {
//     echo '<div class="container"><h2>Password Reset</h2><div class="alert alert-success">Password updated successfully.</div></div>';
//     $showResetForm = false; // Hide the form after successful password update
//     sleep(3); // Wait for 3 seconds
//     header('Location: login.php');
//     exit(); // Ensure no further code is executed after redirection
//   } else {
//     echo '<div class="container"><h2>Password Reset</h2><div class="alert alert-danger">Failed to update password. Please try again.</div></div>';
//     $showResetForm = true; // Show the form if update fails
//   }
// }

// ob_end_flush(); // Flush (send) the output buffer and turn off output buffering
// 
?>

<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forgot Password</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #e3e3e3;
    }

    .navbar {
      background-color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 40px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .logo-section {
      display: flex;
      align-items: center;
    }

    .logo {
      height: 40px;
      margin-right: 10px;
    }

    .portal-title {
      font-size: 20px;
      font-weight: bold;
    }

    .nav-icons i {
      font-size: 20px;
      margin-left: 25px;
      cursor: pointer;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 60px 0;
    }

    .card {
      background-color: #f5f5f5;
      padding: 50px;
      border-radius: 8px;
      width: 600px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .card h2 {
      font-size: 36px;
      font-weight: 600;
      margin-bottom: 40px;
    }

    form {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    label {
      align-self: flex-start;
      margin-bottom: 8px;
      font-size: 14px;
      font-weight: 500;
    }

    input[type="email"] {
      width: 100%;
      padding: 15px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-bottom: 30px;
    }

    button {
      background-color: #f5a623;
      color: white;
      padding: 14px 0;
      width: 160px;
      font-weight: bold;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background-color: #e59500;
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<div class="container">
  <div class="card">
    <h2>Forgot Password</h2>
    <form action="password-reset-token.php" method="POST">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Enter Email" required>
      <button type="submit">Submit</button>
    </form>
  </div>
</div>
<footer>
  <?php include_once '../common/footer_module.php'; ?>
</footer>
</body>

</html>