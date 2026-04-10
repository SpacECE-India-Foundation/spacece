<?php
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");


//site url
include '../Db_Connection/db_spacece.php';
?>
<?php
$uid = $_GET['uid'];
$cid = $_GET['cid'];

error_reporting();

if (isset($uid)) {
	$sql = "SELECT
				uc.*
			FROM
				users u,
				learnonapp_courses c,
				learnonapp_users_courses uc
			WHERE
				uc.uid = u.u_id AND uc.cid = c.id AND u.u_id = " . $uid;

	$res = mysqli_query($conn, $sql);
	header('Content-Type:application/json');
} elseif (isset($cid)) {
	$sql = "SELECT
				uc.*
			FROM
				users u,
				learnonapp_courses c,
				learnonapp_users_courses uc
			WHERE
				uc.uid = u.u_id AND uc.cid = c.id AND c.id = " . $cid;

	$res = mysqli_query($conn, $sql);
	header('Content-Type:application/json');
} else {
	echo json_encode(['status' => 'error', 'result' => 'wrong api']);
	die();
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
		echo json_encode(['status' => 'error', 'result' => 'not found']);
	}
}

?>