<?php
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

$servername = "3.109.14.4";
$username = "ostechnix";
$password = "Password123#@!";
$dbname = "khanstore";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
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