<?php
session_start();

//include('connect.php');
include('../../Db_Connection/db_spacece.php');

$data = $_POST;
$mac_provided = $data['mac'];  // Get the MAC from the POST data
unset($data['mac']);  // Remove the MAC key from the data.

$ver = explode('.', phpversion());
$major = (int) $ver[0];
$minor = (int) $ver[1];

if ($major >= 5 and $minor >= 4) {
    ksort($data, SORT_STRING | SORT_FLAG_CASE);
} else {
    uksort($data, 'strcasecmp');
}

// You can get the 'salt' from Instamojo's developers page(make sure to log in first): https://www.instamojo.com/developers
// Pass the 'salt' without the <>.
$mac_calculated = hash_hmac("sha1", implode("|", $data), "c3d16aeb9f674ff9a80db603eb15d88b");

if ($mac_provided == $mac_calculated) {
    echo "MAC is fine";
    // Do something here
    if ($data['status'] == "Credit") {
        $status = $data['status'];
        $email = $data['buyer'];
        $phone = $data['buyer_phone'];
        $purpose = $data['purpose'];
        $name = $data['buyer_name'];
        $amt = $data['amount'];
    } else {
        $query1 = "SELECT * FROM users WHERE u_email='$email'";

        $result = mysqli_query($conn, $query1);

        if (!$result) {
            $query2 = "INSERT INTO users(u_fname, u_email, u_mob, space_active) VALUES ('$name','$email', '$phone', 'active')";
            mysqli_query($conn, $query2);
        }

        $sql = "INSERT INTO webhook( imojo_id, payment_id, u_email, p_name, date_of_activation, date_of_expire, amount) 
VALUES ('$payment_id','$payment_id','$email','$purpose','$date_purchase','$end_date','$amt')";

        $res = mysqli_query($conn, $sql);
    }
} else {
    echo "Invalid MAC passed";
}
