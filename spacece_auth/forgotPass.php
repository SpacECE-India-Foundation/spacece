<?php
ob_start(); // Start output buffering

include_once './header_local.php';
include_once '../common/header_module.php';
include_once '../Db_Connection/db_spacece.php'; // Adjust path as per your file structure

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'], $_POST['type'])) {
        $email = $_POST['email'];
        $type = $_POST['type'];

        // Validate email and type (to be implemented according to your validation rules)

        // Check if email exists in database for the selected type
        $query = "SELECT * FROM users WHERE u_email = ? AND u_type = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $email, $type);
        $stmt->execute();
        $result = $stmt->get_result();

        $user = $result->fetch_assoc();

        if ($user) {
            // Email exists for the selected type, show password reset form
            $showResetForm = true;
        } else {
            // Email does not exist for the selected type
            echo '<div class="container"><h2>Forgot Password</h2><div class="alert alert-danger">No user found with the provided email and type.</div></div>';
        }
    }
}

// Handle password reset form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_password'])) {
    $email = $_POST['email'];
    $type = $_POST['type'];
    $new_password = $_POST['password'];

    // Hash the password using md5 (not recommended for security reasons)
    $hashed_password = md5($new_password);

    // Update password in the database
    $update_query = "UPDATE users SET u_password = ? WHERE u_email = ? AND u_type = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param('sss', $hashed_password, $email, $type);

    if ($update_stmt->execute()) {
        echo '<div class="container"><h2>Password Reset</h2><div class="alert alert-success">Password updated successfully.</div></div>';
        $showResetForm = false; // Hide the form after successful password update
        sleep(3); // Wait for 3 seconds
        header('Location: login.php');
        exit(); // Ensure no further code is executed after redirection
    } else {
        echo '<div class="container"><h2>Password Reset</h2><div class="alert alert-danger">Failed to update password. Please try again.</div></div>';
        $showResetForm = true; // Show the form if update fails
    }
}

ob_end_flush(); // Flush (send) the output buffer and turn off output buffering
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body, html {
            height: 100%;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        .form-container {
            width: 100%;
            max-width: 500px;
            background: #fff;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }
        .btn-custom {
            background-color: #FFA500;
            border: none;
        }
        .btn-custom:hover {
            background-color: #e59400;
        }
        /* footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            line-height: 60px;
            background-color: #f1f1f1;
        } */
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center">Forgot Password</h2>
            <?php if (!isset($showResetForm)): ?>
            <!-- Initial form to enter email and user type -->
            <form method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="type">User Type</label>
                    <select class="form-control" id="type" name="type" required>
                        <option value="customer">customer</option>
                        <option value="consultant">consultant</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-custom btn-block">Submit</button>
            </form>
            <?php else: ?>
            <!-- Form to reset password -->
            <form method="post">
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <input type="hidden" name="type" value="<?php echo htmlspecialchars($type); ?>">
                <button type="submit" name="reset_password" class="btn btn-custom btn-block">Reset Password</button>
            </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (if needed) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <footer>
        <?php include_once '../common/footer_module.php'; ?>
    </footer>
</body>
</html>
