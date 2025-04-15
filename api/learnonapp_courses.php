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
$subid = $_GET['subid'];

error_reporting();

if (isset($cid) && isset($subid)) {
    $sql = "
        SELECT
            sc.cid,
            c.title,
            c.description,
            c.logo,
            c.type,
            c.mode,
            c.duration,
            c.price,
            sc.id,
            sc.introduction,
            sc.topic,
            sc.quote,
            sc.question,
            sc.video_url,
            sc.author
        FROM
            learnonapp_courses c
        INNER JOIN learnonapp_subcourses sc ON
            c.id = sc.cid AND c.id = " . $cid;

    $res = mysqli_query($conn, $sql);
    header('Content-Type:application/json');
} else if (isset($cid) && isset($uid)) {
    $sql = "SELECT lc.*, luc.id AS luc_id, luc.payment_status
            FROM learnonapp_courses lc
            LEFT JOIN
            learnonapp_users_courses luc
            ON lc.id = luc.cid
            AND luc.uid = " . $uid . "
            WHERE lc.id = " . $cid;

    $res = mysqli_query($conn, $sql);
    header('Content-Type:application/json');
} else if (isset($cid)) {
    $sql = "SELECT * FROM `learnonapp_courses` WHERE `id`=" . $cid;
    $res = mysqli_query($conn, $sql);
    header('Content-Type:application/json');
} else if (isset($uid)) {
    $sql = "SELECT
                c.*
            FROM
                users u,
                learnonapp_courses c,
                learnonapp_users_courses uc
            WHERE
                uc.uid = u.u_id AND uc.cid = c.id AND u.u_id = " . $uid;
    $res = mysqli_query($conn, $sql);
    header('Content-Type:application/json');
} else {
    $sql = "SELECT * FROM `learnonapp_courses`";
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