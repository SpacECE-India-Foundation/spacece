<?php
include("../Db_Connection/db_consultus_app.php");

date_default_timezone_set("Asia/Kolkata");

$u_id = $_POST['u_id'];
$c_id = $_POST['c_id'];
$end_time = $_POST['end_time'];
$b_date = date($_POST['b_date']);
$booking_time = $_POST['time'];
$time = strtotime(date($_POST['time']));
$to_time1 = date("H:i:s", strtotime('+' . $end_time . 'minutes', strtotime($_POST['time'])));
$avl = date('l', strtotime($b_date));

$sql ="SELECT spacece.consultant.c_from_time,spacece.consultant.c_to_time,spacece.consultant.c_aval_days As c_aval_days from spacece.consultant join spacece.users where  spacece.users.u_id=spacece.consultant.u_id AND spacece.users.u_id='$c_id' ";
$res = mysqli_query($conn, $sql);

if ($res) {
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $from_time = strtotime($row['c_from_time']);
            $to_time = strtotime($row['c_to_time']);
            $DaysArray = explode(",", $row['c_aval_days']);

            if (in_array($avl, $DaysArray)) {
                if ($time >= $from_time && $time <= $to_time) {
                    if (strtotime(date("Y-m-d")) > strtotime($b_date)) {
                        echo json_encode(['status' => 'fail', 'msg' => "INVALID SELECTED DATE"]);
                    } else {
                        $sql1 = "SELECT * FROM new_apointment WHERE b_date='$b_date' AND c_id='$c_id' AND booking_time BETWEEN '$booking_time' AND '$to_time1'";
                        $res1 = mysqli_query($conn, $sql1);
                        $sql2 = "SELECT * FROM new_apointment WHERE b_date='$b_date' AND c_id='$c_id' AND end_time BETWEEN '$booking_time' AND '$to_time1'";
                        $res2 = mysqli_query($conn, $sql2);

                        if ($res1 && $res2) {
                            if (mysqli_num_rows($res1) > 0 || mysqli_num_rows($res2) > 0) {
                                echo json_encode(['status' => 'fail', 'msg' => "CONSULTANT UNAVAILABLE AT SELECTED TIME"]);
                            } else {
                                $booking_id = rand(9999999, 0000000);
                                $sql3 = "INSERT INTO new_apointment (booking_id, u_id, c_id, end_time, b_date, booking_time) VALUES ('$booking_id', '$u_id', '$c_id', '$to_time1', '$b_date', '$booking_time')";
                                $res3 = mysqli_query($conn, $sql3);
                                
                                if ($res3) {
                                    echo json_encode(['status' => 'success', 'msg' => 'Appointment booked successfully', 'booking_id' => $booking_id]);
                                } else {
                                    echo json_encode(['status' => 'fail', 'msg' => "Failed to book appointment"]);
                                }
                            }
                        } else {
                            echo json_encode(['status' => 'fail', 'msg' => 'Error querying appointment data']);
                        }
                    }
                } else {
                    echo json_encode(['status' => 'fail', 'msg' => "Booking time is outside the consultant's working hours"]);
                }
            } else {
                echo json_encode(['status' => 'fail', 'msg' => "Consultant is not available on selected day"]);
            }
        }
    } else {
        echo json_encode(['status' => 'fail', 'msg' => "No consultant found with ID $c_id"]);
    }
} else {
    echo json_encode(['status' => 'fail', 'msg' => 'Error retrieving consultant availability: ' . mysqli_error($conn)]);
}
?>

