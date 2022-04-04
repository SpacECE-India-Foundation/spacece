<?php
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

include './Db_Connection/db_spacece.php';
?>
<?php

$sql = "SELECT * FROM learnonapp_messages WHERE header='Reading Material'";
$res = mysqli_query($conn, $sql);

if ($res) {
    // count that data is there or not in database
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            // print_r($row['no_of_day']);
            $sql2 = "SELECT * FROM users WHERE days = " . $row['no_of_day'];
            $res2 = mysqli_query($conn, $sql2);

            if ($res2) {
                // count that data is there or not in database
                $count2 = mysqli_num_rows($res2);

                if ($count2 > 0) {
                    while ($row2 = mysqli_fetch_assoc($res2)) {
                        echo $row2 . " ----- " . $row['header'] . "<br>";
                    }
                }
            }
        }
        die();
    } else {
        echo "No data found!";
        die();
    }
}

?>