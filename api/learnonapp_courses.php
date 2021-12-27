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
$uid = $_GET['uid'];
$cid = $_GET['cid'];

error_reporting();

if (isset($cid)) {
    $sql = "SELECT * FROM `learnonapp_courses` WHERE `id`=" . $cid;
    $res = mysqli_query($conn, $sql);
    header('Content-Type:application/json');
} else if (isset($uid)) {
    $sql = "SELECT
                c.*
            FROM
                users u,
                learnonapp_courses c,
                learnonapp_users_courses uc
            WHERE
                uc.uid = u.u_id AND uc.cid = c.id AND u.u_id = " . $uid;
    $res = mysqli_query($conn, $sql);
    header('Content-Type:application/json');
} else {
    $sql = "SELECT * FROM `learnonapp_courses` LIMIT 9";
    $res = mysqli_query($conn, $sql);
    header('Content-Type:application/json');
}

//checking whether query is excuted or not
if ($res) {
    // count that data is there or not in database
    $count = mysqli_num_rows($res);
    $sno = 1;
    if ($count > 0) {
        // we have data in database
        while ($row = mysqli_fetch_assoc($res)) {

            $arr[] = $row;   // making array of data

        }
        echo json_encode(['status' => 'success', 'data' => $arr, 'result' => 'found']);
        //echo json_encode(['status'=>'success','result'=>'found']);


    } else {
        echo json_encode(['status' => 'failure', 'result' => 'not found']);
    }
}

?>