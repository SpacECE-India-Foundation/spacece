<?php
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");


//site url
include '../Db_Connection/db_spacece.php';
?>
<?php
$day_no = $_GET['day_no'];
$header = $_GET['header'];

error_reporting();

if (isset($day_no)) {
    $sql = "SELECT * FROM `learnonapp_messages` WHERE `no_of_day`=" . $day_no;
    $res = mysqli_query($conn, $sql);
    header('Content-Type:application/json');
} elseif (isset($header)) {
    $sql = "SELECT * FROM `learnonapp_messages` WHERE `header`='" . $header . "'";
    $res = mysqli_query($conn, $sql);
    header('Content-Type:application/json');
} else {
    $sql = "SELECT * FROM `learnonapp_messages`";
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