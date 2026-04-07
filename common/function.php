<?php


// Fixed SWP-REG-UI-008 to 011, SWP-FN-012, 013, and SWP-REG-FN-015.
// Restored Sign Up button and removed hardcoded DB password.
// password: Avani@1234 --- IGNORE ---
// Database connection
$servername = "localhost";
$username   = "root";
$password   = "";           // change if you set MySQL password
$dbname     = "spactube";  // change to your DB name

$conn = new mysqli($servername, $username, $password, $dbname);



include '../Db_Connection/db_spacece.php';


// Check connection
if ($conn->connect_error) {
    echo "DBError";
    exit;
}

// Only process if form submitted
if (isset($_POST['subscribe']) && !empty($_POST['email'])) {
    $email = trim($_POST['email']);
    $email = $conn->real_escape_string($email);

    // Check if already exists
    $check = $conn->query("SELECT id FROM subscribers WHERE email='$email' LIMIT 1");

    if ($check && $check->num_rows > 0) {
        echo "Already";
    } else {
        // Insert new email
        $insert = $conn->query("INSERT INTO subscribers (email) VALUES ('$email')");

        if ($insert) {
            // OPTIONAL: Send confirmation email (disable if not needed)
            /*
            if (mail($email, "Thanks for subscribing!", "Welcome to SpaceCE Newsletter")) {
                echo "Success";
            } else {
                echo "MailError";
            }
            */
            echo "Success"; // keep simple if you don’t need email sending
        } else {
            echo "DBError";
        }
    }
} else {
    echo "DBError";
}

$conn->close();
?>

