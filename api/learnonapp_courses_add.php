<?php
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");


//site url

include '../Db_Connection/db_spacece.php';
?>
<?php

error_reporting();

if (isset($_POST['action']) && $_POST['action'] = 'add') {
    $sql = "INSERT INTO learnonapp_courses (title, description, type, mode, duration, price)
    VALUES ('" . $_POST['title-new'] . "', '" . $_POST['description-new'] . "', '" . $_POST['type-new'] . "', '" . $_POST['mode-new'] . "', '" . $_POST['duration-new'] . "', '" . $_POST['price-new'] . "')";

    $result = $conn->query($sql);

    $id = $conn->insert_id;

    if ($result) {
        $sqlarr = [];
        $resarr = [];
        for ($i = 1; $i <= $_POST; $i++) {
            if (isset($_POST['title_' . $i])) {
                $sql = "INSERT INTO learnonapp_subcourses (cid, day, title, description, author)
                VALUES ('" . $id . "', '" . $_POST['day_' . $i] . "', '" . $_POST['title_' . $i] . "', '" . $_POST['description_' . $i] . "', '" . $_POST['author_' . $i] . "')";

                $result = $conn->query($sql);
                array_push($sqlarr, $sql);
                array_push($resarr, $result);
            } else {
                break;
            }
        }

        echo json_encode(['status' => 'err', 'data' => $arr, 'sql' => $sqlarr, 'res' => $resarr]);
        die();

        if ($result) {
            $sql = "SELECT * FROM `learnonapp_courses`";
            $res = mysqli_query($conn, $sql);
            header('Content-Type:application/json');
        } else {
            echo json_encode(['status' => 'failure', 'result' => 'Error in adding subcourses']);
        }
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