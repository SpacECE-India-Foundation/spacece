<?php
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");


include '../Db_Connection/db_spacece_active.php';
?>
<?php
$a_no = $_GET['ano'];
error_reporting();

$sql = "SELECT * FROM `spaceactive_activities` where activity_no = '$a_no'";
$res = mysqli_query($mysqli1, $sql);
header('Content-Type:application/json');


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