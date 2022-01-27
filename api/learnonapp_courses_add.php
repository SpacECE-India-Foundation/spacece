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

if (isset($_POST['action']) && $_POST['action'] = 'add') {
    $sql = "INSERT INTO learnonapp_courses (title, description, type, mode, duration, price)
    VALUES ('" . $_POST['title'] . "', '" . $_POST['description'] . "', '" . $_POST['type'] . "', '" . $_POST['mode'] . "', '" . $_POST['duration'] . "', '" . $_POST['price'] . "')";

    $result = $conn->query($sql);

    $id = $conn->insert_id;

    if ($result) {
        for ($i = 1; $i <= $_POST; $i++) {
            if (isset($_POST['title_' . $i])) {
                $sql = "INSERT INTO learnonapp_subcourses (cid, day, title, description, author)
                VALUES ('" . $id . "', '" . $_POST['day_' . $i] . "', '" . $_POST['title_' . $i] . "', '" . $_POST['description_' . $i] . "', '" . $_POST['author_' . $i] . "')";
            } else {
                break;
            }
        }

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