<?php
session_start();

if (!isset($_SESSION['current_user_id'])) {
    header('Location: ../spacece_auth/login.php');
    exit();
} else {
    $name = $_SESSION['current_user_name'];
    $email = $_SESSION['current_user_email'];
    $mobile = $_SESSION['current_user_mob'];
    $total = 100;

    if ($total < 10) {
        echo json_encode(array('success' => false, 'message' => 'Minimum order amount is Rs. 10'));
        exit();
    }

    paymentInit($name, $email, $mobile, $total);
}

function paymentInit($name, $email, $mobile, $total)
{
    $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
    curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            // "X-Api-Key:e4f2b4dc4a9538131479fd94c84eb10e",
            // "X-Auth-Token:c317f9c3980dfde368345eace142711d"
            "X-Api-Key:test_d93c3d591e0abb22ab505118e62",
            "X-Auth-Token:test_76954866b66d6b27022e3086fd6"
        )
    );
    $payload = array(
        'purpose' => 'LearnOnApp',
        'amount' => $total,
        'currency' => 'INR',
        'phone' => '+91' . $mobile,
        'buyer_name' => $name,
        'redirect_url' => 'https://spacefoundation.in/test/SpacECE-PHP/Khanstore/payment_confirm.php',
        'send_email' => true,
        'webhook' => 'https://spacefoundation.in/test/SpacECE-PHP/instamojo_api/webhook.php',
        'send_sms' => true,
        'email' => $email,
        'allow_repeated_payments' => false
    );
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
    $response = curl_exec($ch);
    curl_close($ch);
    // $response = "result:". $response;
    // $response = json_encode($response);
    print_r($response);

    // echo $response;

    // header('location:' . $response->payment_request->longurl);
    exit();
}
