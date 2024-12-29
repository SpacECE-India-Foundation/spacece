<?php
include "../Db_Connection/db_spaceTube.php"; ?>
<?php $type = $_GET["type"]; ?>
<?php if ($type == "all") {
    if (isset($_GET["pagenum"])) {
        $pagenum = $_GET["pagenum"];
    } else {
        $pagenum = 1;
    }
    if (isset($_GET["pagelen"])) {
        $pagelen = $_GET["pagelen"];
    } else {
        $pagelen = 10; //default pagelenght is 10
    }
    $offset = $pagelen * ($pagenum - 1);
    $len = $offset + $pagelen; //echo 'pagelen<br> ' . htmlspecialchars($_GET["pagelen"]) . '!';
    // showing admin added from database
    $sql = "SELECT * 
	FROM `videos`
	WHERE `v_id`>'$offset' AND `v_id`<= '$len'
        ORDER BY `v_id`";
    $res = mysqli_query($conn, $sql);
    header("Content-Type:application/json"); // connecting to database
    //checking whether query is excuted or not
    if ($res) {
        // count that data is there or not in database
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            // we have data in database
            while ($row = mysqli_fetch_assoc($res)) {
                $arr[] = $row; // making array of data
            }
            $sql3 = "SELECT *
       FROM `videos`
       ORDER BY `views` DESC
       Limit 5";
            $res3 = mysqli_query($conn, $sql3);
            header("Content-Type:application/json"); // connecting to database
            header("Acess-Control-Allow-Origin: *");
            //checking whether query is excuted or not
            if ($res3) {
                // count that data is there or not in database
                $count3 = mysqli_num_rows($res3);
                if ($count3 > 0) {
                    // we have data in database
                    while ($row3 = mysqli_fetch_assoc($res3)) {
                        $arr3[] = $row3;

                        // making array of data
                    }
                }
            }

            $uid = $_GET["uid"];
            $today = date("Y-m-d"); // $sql2="SELECT * FROM `videos`, `tbl_recents` WHERE `tbl_recents`.`v_id`=`videos`.`v_id` and `tbl_recents`.`vr_date`='$today' AND `tbl_recents`.`u_no`='$uid' ORDER BY `videos`.`v_id`";;
            $sql2 = "SELECT * FROM `videos`, `tbl_recents` WHERE `tbl_recents`.`v_id`=`videos`.`v_id` and `tbl_recents`.`vr_date`='2021-08-16' AND `tbl_recents`.`u_no`='$uid' ORDER BY `videos`.`v_id`";
            $res2 = mysqli_query($conn, $sql2);
            header("Content-Type:application/json"); // connecting to database
            //checking whether query is excuted or not
            if ($res2) {
                // count that data is there or not in database
                $count2 = mysqli_num_rows($res2);
                if ($count2 > 0) {
                    // we have data in database
                    while ($row2 = mysqli_fetch_assoc($res2)) {
                        $arr2[] = $row2;
                        // making array of data
                    }
                }
            }
            echo json_encode([
                "status" => "true",
                "data" => $arr,
                "data_recent" => $arr2,
                "data_trending" => $arr3,
                "result" => "found",
            ]); // displaying data
        } else {
            echo json_encode(["status" => "true", "msg" => "NO DATA FOUND"]);
            // displaying data not found msg
        }
    } else {
        echo "no data";
    }
} ?>
<?php if ($type == "free") {
    $sql = 'SELECT * FROM `videos` WHERE `status`="free" ORDER BY `v_id`';
    $res = mysqli_query($conn, $sql);
    header("Content-Type:application/json"); // connecting to database
    header("Acess-Control-Allow-Origin: *"); //checking whether query is excuted or not
    if ($res) {
        // count that data is there or not in database
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            // we have data in database
            while ($row = mysqli_fetch_assoc($res)) {
                $arr[] = $row; // making array of data
            }
            echo json_encode([
                "status" => "true",
                "data" => $arr,
                "result" => "found",
            ]); // displaying data
        } else {
            echo json_encode(["status" => "true", "msg" => "NO DATA FOUND"]);

            // displaying data not found msg
        }
    } else {
        echo "no data";
    }
} ?>
<?php if ($type == "paid") {
    $sql = 'SELECT * FROM `videos` WHERE `status`="created" ORDER BY `v_id`';
    $res = mysqli_query(
        $conn,

        $sql
    );
    header("Content-Type:application/json"); // connecting to database
    header("Acess-Control-Allow-Origin: *"); //checking whether query is excuted or not
    if ($res) {
        // count that data is there or not in database
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            // we have data in database
            while ($row = mysqli_fetch_assoc($res)) {
                $arr[] = $row; // making array of data
            }
            echo json_encode([
                "status" => "true",
                "data" => $arr,
                "result" => "found",
            ]); // displaying data
        } else {
            echo json_encode(["status" => "true", "msg" => "NO DATA FOUND"]); // displaying data not found msg
        }
    } else {
        echo "no data";
    }
} ?>
<?php if ($type == "trending") {
    $sql = "SELECT *
       FROM `videos`
       ORDER BY `views` DESC
       Limit 5";
    $res = mysqli_query($conn, $sql);
    header("Content-Type:application/json"); // connecting to database
    header("Acess-Control-Allow-Origin: *"); //checking whether query is excuted or not
    if ($res) {
        // count that data is there or not in database
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            // we have data in database
            while ($row = mysqli_fetch_assoc($res)) {
                $arr[] = $row; // making array of data
            }
            $uid = $_GET["uid"];
            $today = date("Y-m-d"); // $sql2="SELECT * FROM `videos`, `tbl_recents` WHERE `tbl_recents`.`v_id`=`videos`.`v_id` and `tbl_recents`.`vr_date`='$today' AND `tbl_recents`.`u_no`='$uid' ORDER BY `videos`.`v_id`";;
            $sql2 = "SELECT * FROM `videos`, `tbl_recents` WHERE `tbl_recents`.`v_id`=`videos`.`v_id` and `tbl_recents`.`vr_date`='2021-08-11' AND `tbl_recents`.`u_no`='$uid' ORDER BY `videos`.`v_id`";
            $res2 = mysqli_query($conn, $sql2);
            header("Content-Type:application/json"); // connecting to database
            //checking whether query is excuted or not
            if ($res2) {
                // count that data is there or not in database
                $count2 = mysqli_num_rows($res2);
                if ($count2 > 0) {
                    // we have data in database
                    while ($row2 = mysqli_fetch_assoc($res2)) {
                        $arr2[] = $row2; // making array of data
                    }
                }
            }
            echo json_encode([
                "status" => "true",
                "data" => $arr,
                "data_recent" => $arr2,
                "result" => "found",
            ]);
            // displaying data
        } else {
            echo json_encode(["status" => "true", "msg" => "NO DATA FOUND"]); // displaying data not found msg
        }
    } else {
        echo "no data";
    }
} ?>
<?php
$uid = $_GET["uid"];
$today = date("Y-m-d");
if ($type == "recent") {
    $sql = "SELECT * FROM `videos`, `tbl_recents` WHERE `tbl_recents`.`v_id`=`videos`.`v_id` and `tbl_recents`.`vr_date`='$today' AND `tbl_recents`.`u_no`='$uid' ORDER BY `videos`.`v_id`";
    $res = mysqli_query($conn, $sql);
    header("Content-Type:application/json"); // connecting to database //checking whether query is excuted or not
    if ($res) {
        // count that data is there or not in database

        $count = mysqli_num_rows($res);
        if ($count > 0) {
            // we have data in database
            while ($row = mysqli_fetch_assoc($res)) {
                $arr[] = $row;
                // making array of data
            }
            echo json_encode([
                "status" => "true",
                "data" => $arr,
                "result" => "found",
            ]);
            // displaying data
        } else {
            echo json_encode(["status" => "true", "msg" => "NO DATA FOUND"]); // displaying data not found msg
        }
    } else {
        echo "no data";
    }
}
 ?>
