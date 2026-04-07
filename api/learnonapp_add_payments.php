<?php
session_start();

echo json_encode(array('status' => 'success', 'message' => "Working", 'GET' => $_GET, 'SESSION' => $_SESSION));
exit();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

include '../Db_Connection/db_spacece.php';
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