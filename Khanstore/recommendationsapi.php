<?php
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

include '../Db_Connection/db_khanstore.php';


?>
<?php
	$userId = isset($_GET["userId"])? $_GET['userId'] : Null;

error_reporting();

if (isset($userId)) {
    $sql = "SELECT * FROM `recommendations` WHERE userId=" . $userId;
    $res = mysqli_query($conn,$sql);
    header('Content-Type:application/json');
}
else {
    $sql = "SELECT * FROM `recommendations` LIMIT 35";
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