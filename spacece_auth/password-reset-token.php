<?php

use PHPMailer\PHPMailer\PHPMailer;

include_once './header_local.php';
include_once '../common/header_module.php';
include_once '../includes/constants.php';
include_once '../Db_Connection/db_spacece.php';
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
    $protocol = "https";
} else {
    $protocol = "http"; // Force http if HTTPS is not active
}
$baseUrl = $protocol . "://" . $_SERVER['HTTP_HOST']; // Remote uses protocol based on server

//Now handle localhost vs remote
// if ($_SERVER['HTTP_HOST'] === 'localhost') {
//     $baseUrl = "http://localhost/spacece2/spacece"; // Always HTTP and project path for local
// } else {
//     $baseUrl = $protocol . "://" . $_SERVER['HTTP_HOST']; // Remote uses protocol based on server
// }

// Now you can use $baseUrl
//var_dump($baseUrl);
//Check if form is submitted

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // var_dump($_POST);
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        // $type = $_POST['type'];

        // Validate email and type (to be implemented according to your validation rules)

        // Check if email exists in database for the selected type
        $query = "SELECT * FROM users WHERE u_email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        $user = $result->fetch_assoc();
        //var_dump($user);
        if ($user) {

            // Generate token
            $token = bin2hex(random_bytes(50));

            // Set expiry date (24 hours from now)
            $expiry_date = date('Y-m-d H:i:s', strtotime('+24 hours'));

            // Update user record with token and expiry
            $update_query = "UPDATE users SET reset_link_token = ?, token_expire = ? WHERE u_email = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param('sss', $token, $expiry_date, $email);
            $update_stmt->execute();
            // require_once 'vendor/autoload.php';
            require_once __DIR__ . '/../vendor/autoload.php';


            $mail = new PHPMailer();
            $mail->CharSet =  "utf-8";
            $mail->SMTPDebug = 0;
            $mail->IsSMTP();
            // enable SMTP authentication
            $mail->SMTPAuth = true;
            $mail->AuthType = 'LOGIN';
            $mail->Host = MAIL_HOST;
            $mail->Port = MAIL_PORT;
            $mail->Username = MAIL_USERNAME;
            $mail->Password = MAIL_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Or use ENCRYPTION_STARTTLS if you're using port 587
            $mail->From = MAIL_FROM_ADDRESS;
            $mail->FromName = MAIL_FROM_NAME;
            $mail->AddAddress($email); // need to add receiver

            //$mail->Subject  =  'Reset Password';
            $mail->IsHTML(true);
            // Email exists - now send the reset link
            $mail->Subject = "Reset Your Password - Spaces Web Portal.";
            $mail->Body  = "Hi " . htmlspecialchars($user['u_name']) . ",<br><br>";
            $mail->Body .= "Click the link below to reset your password:<br><br>";
            $mail->Body .= "<a href='" . $baseUrl . "/spacece_auth/reset-password.php?email=" . urlencode($email) . "&token=" . urlencode($token) . "'>Reset your password</a><br><br>";
            $mail->Body .= "If you didn’t request this, just ignore it.<br><br>";
            $mail->Body .= "Thanks,<br>Spaces Team";


            //$headers = "From: no-reply@yourdomain.com";

            if ($mail->Send()) {
                echo '<div class="container" style="margin-top: 120px; padding-top: 20px;"><h2>Forgot Password</h2><div class="alert alert-success">Reset link has been sent to your email address.</div></div>';
            } else {
                echo '<div class="container" style="margin-top: 120px; padding-top: 20px;"><h2>Forgot Password</h2><div class="alert alert-danger">Failed to send email. Please try again later.</div></div>';
            }

            $showResetForm = false; // Don't show the reset form until link is clicked
        } else {
            // Email does not exist for the selected type
            echo '<div class="container"><h2>Forgot Password</h2><div class="alert alert-danger">No user found with the provided email and type.</div></div>';
        }
    }
}
?>
<footer>
    <?php include_once '../common/footer_module.php'; ?>
</footer>