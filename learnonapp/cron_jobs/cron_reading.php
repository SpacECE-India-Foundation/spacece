<?php
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

$servername = "localhost";
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

$sql = "SELECT * FROM learnon_messages WHERE header='Reading Material'";
$res = mysqli_query($conn, $sql);

if ($res) {
    // count that data is there or not in database
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            // print_r($row['no_of_day']);
            $sql2 = "SELECT * FROM learnon_users WHERE days = " . $row['no_of_day'];
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