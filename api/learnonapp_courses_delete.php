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

error_reporting();

if (isset($_POST['action']) && $_POST['action'] = 'delete') {
    $sql = "DELETE FROM learnonapp_courses
    WHERE id=" . $_POST['id'];
    // echo json_encode(['status' => 'failure', 'result' => $sql]);
    // die();
    $result = $conn->query($sql);
    if ($result) {
        $sql = "SELECT * FROM `learnonapp_courses`";
        $res = mysqli_query($conn, $sql);
        header('Content-Type:application/json');
    } else {
        echo json_encode(['status' => 'failure', 'result' => 'not found']);
        die();
    }
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