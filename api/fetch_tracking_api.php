<?php
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

include '../Db_Connection/db_libforsmall.php';
?>

<?php
$user_id = $_POST['user_id'];

error_reporting();

if (isset($_POST['user_id'])) {
    $sql = "SELECT * FROM tracking WHERE user_id = '$user_id'";
    $result = $conn->query($sql);

    if ($result) {
        // count that data is there or not in database
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $arr[] = $row;   // making array of data
            }
            echo json_encode(['success' => true, 'data' => $arr]);
            die();
        } else {
            echo json_encode(['success' => false, 'message' => 'User not found']);
            die();
        }
    }
}

echo json_encode(['success' => false, 'message' => 'Something went wrong']);
die();

?>