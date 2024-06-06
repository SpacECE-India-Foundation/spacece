<?php  // this is serverside page === api key 
?>

<?php 
// include("../Db_Connection/db_consultus_app.php");
include('../Db_Connection/db_spacece.php');
?>
<?php
$cat_name = '';
if (isset($_GET['cat'])) {
    $cat_name = $_GET['cat'];
}

//echo $cat_name;
if (empty($cat_name)) {
    // showing admin added from database
    $sql = "SELECT DISTINCT users.u_id AS u_id,users.u_name AS u_name,
        users.u_image AS u_image ,
    consultant.c_office AS c_office,consultant.c_from_time As c_from_time, consultant.c_to_time As c_to_time , 
    consultant.c_aval_days As c_aval_days, 
    consultant.c_language AS c_language, consultant.c_fee AS c_fee ,consultant.c_available_from As c_available_from,
    consultant.c_available_to AS c_available_to ,consultant.c_qualification AS c_qualification ,
    consultant_category.cat_name AS cat_name FROM consultant_category JOIN consultant JOIN users
    WHERE users.u_id = consultant.u_id 
    AND consultant.c_category=consultant_category.cat_id AND users.u_type='consultant'";
    $res = mysqli_query($conn, $sql);
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
            echo json_encode(['status' => 'fail', 'msg' => "NO DATA FOUND"]);
        }
    }
}
// displaying value in table
?>

<?php

if ($cat_name) {
    // showing admin added from database
    $sql = "SELECT DISTINCT users.u_id AS u_id,users.u_name AS u_name,
        users.u_image as image, consultant.c_office AS c_office,consultant.c_from_time As 
        c_from_time, consultant.c_to_time As c_to_time , consultant.c_language AS c_language, 
        consultant.c_fee AS c_fee ,consultant.c_available_from As c_available_from ,consultant.c_aval_days As c_aval_days, consultant.c_available_to AS 
        c_available_to ,consultant.c_qualification AS c_qualification , consultant_category.cat_name AS cat_name 
        FROM consultant_category JOIN consultant JOIN users WHERE users.u_id = consultant.u_id AND
         consultant.c_category=consultant_category.cat_id
         AND users.u_type='consultant' AND consultant_category.cat_name='$cat_name'";
    $res = mysqli_query($conn, $sql);
    header('Content-Type:application/json');


    //checking whether query is excuted or not
    if ($res) {
        // count that data is there or not in database
        $count = mysqli_num_rows($res);
        $sno = 1;
        if ($count > 0) {
            // we have data in database
            while ($row = mysqli_fetch_assoc($res)) {
                // extracting values from dATABASE

                /* $id=$row['v_id'];
                    $url=$row['v_url'];
                    $name=$row['title'];
                    $vedio_length=$row['length'];*/  // no need 

                $arr[] = $row;   // making array of data

            }
            echo json_encode(['status' => 'success', 'data' => $arr, 'result' => 'found']);
            //echo json_encode(['status'=>'success','result'=>'found']);


        } else {
            echo json_encode(['status' => 'fail', 'msg' => "NO DATA FOUND"]);
        }
    }
}
// displaying value in table
?>
