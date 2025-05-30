<?php
include('../../Db_Connection/db_spacece.php');

// Get the consultant ID and user from the URL parameters
$id = $_GET['id'];
$user = $_GET['user'];

// Query to fetch consultant details based on ID
$sql = "SELECT consultant.*, users.u_name  
        FROM consultant 
        JOIN users ON consultant.u_id = users.u_id  
        WHERE consultant.u_id = $id";
$res = mysqli_query($conn, $sql);

if ($res) {
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        // Fetch consultant details
        $row = mysqli_fetch_assoc($res);
        // echo '<pre>';
        // var_dump($row);
        // echo '</pre>';
        $full_name = $row['u_name'];
        $fees = $row['c_fee'];
        $category = $row['c_category'];

        // Calculate total fee including additional charge (50% of fee)
        $additional_charge = 0.5 * $fees; // Assuming 50% additional charge
        $total_fee = $fees + $additional_charge;
    }
}

// Query to fetch user details based on username
$sql2 = "SELECT * FROM `users` WHERE `u_name`='$user'";
$res2 = mysqli_query($conn, $sql2);

if ($res2) {
    $count2 = mysqli_num_rows($res2);
    if ($count2 == 1) {
        // Fetch user details
        $row2 = mysqli_fetch_assoc($res2);
        // echo '<pre>';
        // var_dump($row2);
        // echo '</pre>';

        $buyer_name = $row2['u_name'];
        $email = $row2['u_email'];
        $phone = $row2['u_mob'];
    }
}

// Payment request to Instamojo
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "X-Api-Key:e4f2b4dc4a9538131479fd94c84eb10e",
    "X-Auth-Token:c317f9c3980dfde368345eace142711d"
));
$payload = array(
    'purpose' => 'ConsulUs-Fee',
    'amount' => $total_fee,
    'phone' => $phone,
    'buyer_name' => $buyer_name,
    'redirect_url' => "https://spaceforece.com/consult/instamojo_payment/success.php?email=$email",
    'send_email' => true,
    'webhook' => 'https://spaceforece.com/consult/instamojo_payment/webhook2.php',
    'send_sms' => true,
    'email' => $email,
    'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch);

$json_decode = json_decode($response, true);
$long_url = $json_decode['payment_request']['longurl'];
header('location:' . $long_url);
