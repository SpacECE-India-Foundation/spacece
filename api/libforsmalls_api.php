<?php
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

include '../Db_Connection/db_libforsmall.php';
?>

<?php
// [ {"bookName": "hello"},
//  {"bookOwner" : "Sohel"}
//  ,{"status":"available"},
//   {"price": "133"},
//    {"location","Delhi"}]

//BookOwnerApi
$bookname = "hello";
$bookowner = "sohel";
$status = "available";
$price = "133";
$location = "delhi";

error_reporting();

if (isset($_GET['action']) && $_GET['action'] == "fetch_products") {

    $sql = "SELECT * FROM `products` LIMIT 9";
    $res = $conn->query($sql);
    header('Content-Type:application/json');

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
}





?>