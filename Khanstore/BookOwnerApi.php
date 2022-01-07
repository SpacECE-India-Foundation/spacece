<?php
//session_start();

//header('Access-Control-Allow-Origin: *');
///header("Access-Control-Allow-Methods: GET, OPTIONS");


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
	$bookId = isset($_GET["bookId"])? $_GET['bookId'] : Null;
    echo "inside";
//error_reporting();
$res="";
if (isset($bookId)) {
    $sql = "SELECT * FROM `bookowner` WHERE bookId=" . $bookId;
    $res = mysqli_query($conn,$sql);
    header('Content-Type:application/json');
}
else {
    $sql = "SELECT * FROM `bookowner` LIMIT 35";
    $res = mysqli_query($conn, $sql);
    header('Content-Type:application/json');
}

//checking whether query is excuted or not
if ($res) {
    // count that data is there or not in database
    
    $count = mysqli_num_rows($res);
    $sno = 1;
    if ($count > 0) {
        echo "inside";
        // we have data in database
        while ($row = mysqli_fetch_assoc($res)) {

            $arr[] = $row;   // making array of data

        }
        echo "inside";
        echo json_encode(['status' => 'success', 'data' => $arr, 'result' => 'found']);
        //echo json_encode(['status'=>'success','result'=>'found']);


    } 
    else {
        echo json_encode(['status' => 'failure', 'result' => 'not found']);
    }
}
else {
    echo json_encode(['status' => 'failure', 'result' => 'not found']);
}
?>