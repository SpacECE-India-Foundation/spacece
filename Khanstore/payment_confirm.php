<?php
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

include '../Db_Connection/db_khanstore.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
$order_id = $_GET['order_id'];
$payment_id = $_GET['payment_id'];
$payment_request_id = $_GET['payment_request_id'];
$payment_status = $_GET['payment_status'];

error_reporting();

if (isset($payment_status) && $payment_status == "Credit") {
    $sql = "UPDATE `orders` SET `trx_id`='$payment_id', `p_status`='$payment_status' WHERE `order_id`='$order_id'";
    $result = $conn->query($sql);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Data Updated']);
        die();
    }
}

echo json_encode(['success' => false, 'message' => 'Something went wrong']);
die();

// if (isset($_POST['user_id']) && isset($_POST['latitude']) && isset($_POST['longitude'])) {
//     $sql = "SELECT * FROM tracking WHERE user_id = '$user_id'";
//     $result = $conn->query($sql);

//     if ($result->num_rows > 0) {
//         $sql = "UPDATE tracking SET latitude = '$latitude', longitude = '$longitude' WHERE user_id = '$user_id'";
//         $result = $conn->query($sql);

//         echo json_encode(['success' => true, 'message' => 'Data Updated']);
//         die();
//     } else {
//         $sql = "INSERT INTO tracking (user_id, latitude, longitude) VALUES ('$user_id', '$latitude', '$longitude')";
//         $result = $conn->query($sql);

//         echo json_encode(['success' => true, 'message' => 'Data Inserted']);
//         die();
//     }
// }

// echo json_encode(['success' => false, 'message' => 'Please send user_id, latitude and longitude']);
// die();

?>