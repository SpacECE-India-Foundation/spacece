<?php
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
include '../Db_Connection/db_libforsmall.php';

?>

<?php
$user_id = $_POST['user_id'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

error_reporting();

if (isset($_POST['user_id']) && isset($_POST['latitude']) && isset($_POST['longitude'])) {
    $sql = "SELECT * FROM tracking WHERE user_id = '$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $sql = "UPDATE tracking SET latitude = '$latitude', longitude = '$longitude' WHERE user_id = '$user_id'";
        $result = $conn->query($sql);

        echo json_encode(['success' => true, 'message' => 'Data Updated']);
        die();
    } else {
        $sql = "INSERT INTO tracking (user_id, latitude, longitude) VALUES ('$user_id', '$latitude', '$longitude')";
        $result = $conn->query($sql);

        echo json_encode(['success' => true, 'message' => 'Data Inserted']);
        die();
    }
}

echo json_encode(['success' => false, 'message' => 'Please send user_id, latitude and longitude']);
die();

?>