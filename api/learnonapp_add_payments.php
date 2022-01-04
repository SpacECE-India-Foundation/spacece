<?php
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");


//site url
define("SITEURL", 'http://3.109.14.4/spac/');
$servername = "3.109.14.4";
$username = "ostechnix";
$password = "Password123#@!";
$dbname = "spaceece";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
$uid = $_SESSION['current_user_id'];
$cid = $_SESSION['course_id'];
$payment_status = $_GET['payment_status'];
$payment_id = $_GET['payment_id'];

if (isset($uid) && isset($cid) && isset($payment_status) && isset($payment_id)) {
    $sql = "INSERT INTO `learnonapp_users_courses` (`payment_details`, `user_id`, `course_id`, `payment_status`) VALUES ('$payment_id', '$uid', '$cid', '$payment_status')";

    if ($conn->query($sql) === true) {
        echo json_encode(array('status' => 'success', 'message' => "Payment Successful"));
        exit();
    } else {
        echo json_encode(array('status' => 'error', 'message' => "Payment Failed"));
        exit();
    }
}

?>