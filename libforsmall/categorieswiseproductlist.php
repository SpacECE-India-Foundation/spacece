<?php
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

include '../Db_Connection/db_libforsmall.php';


?>
<?php
	$cid = isset($_GET["cat_id"])? $_GET['cat_id'] : Null;

error_reporting();

if (isset($cid)) {
    $sql = "SELECT * FROM `categories` WHERE cat_id=" . $cid;
    $res = mysqli_query($conn,$sql);
    header('Content-Type:application/json');
}
else {
    $sql = "SELECT * FROM `categories` LIMIT 35";
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