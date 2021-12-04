<?php
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");


//site url
define("SITEURL", 'http://3.109.14.4/spac/');
$servername = "3.109.14.4";
$username = "ostechnix";
$password = "Password123#@!";
$dbname = "api_learnonapp";
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

if (isset($uid)) {
	$sql = "SELECT * FROM learnon_courses
			WHERE id IN 
				(
					SELECT cid FROM learnon_users_courses
						 WHERE uid IN 
						 (
							 SELECT id FROM learnon_users
							 WHERE id = " . $uid . "
						 )
				);";

	$res = mysqli_query($conn, $sql);
	header('Content-Type:application/json');
} elseif (isset($cid)) {
	$sql = "SELECT * FROM learnon_users
			WHERE id IN 
				(
					SELECT uid FROM learnon_users_courses
						 WHERE cid IN 
						 (
							 SELECT id FROM learnon_courses
							 WHERE id = " . $cid . "
						 )
				);";

	$res = mysqli_query($conn, $sql);
	header('Content-Type:application/json');
} else {
	echo json_encode(['status' => 'failure', 'result' => 'wrong api']);
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
		echo json_encode(['status' => 'failure', 'result' => 'not found']);
	}
}

?>