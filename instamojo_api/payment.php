<?php
$purpose = $_GET["purpose"];
$amount = $_GET["amount"];
$name = $_GET["name"];
$phone = $_GET["phone"];
$email = $_GET["email"];

$err = '{"success":false, "payment_request": {"id": null}}';

if (!isset($purpose) || !isset($amount) || !isset($name) || !isset($phone) || !isset($email)) {
  echo $err;
  exit();
}

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt(
  $ch,
  CURLOPT_HTTPHEADER,
  array(
    "X-Api-Key: test_d93c3d591e0abb22ab505118e62",
    "X-Auth-Token: test_76954866b66d6b27022e3086fd6"
  )
);
$payload = array(
  'purpose' => $purpose,
  'amount' => $amount,
  'phone' => $phone,
  'buyer_name' => $name,
  'redirect_url' => 'https://test.instamojo.com/integrations/android/redirect/',
  'send_email' => true,
  'webhook' => 'https://spacefoundation.in/webhook.php',
  'send_sms' => true,
  'email' => $email,
  'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response);


$payment_request_id = $result->payment_request->id;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/oauth2/token/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

$payload = array(
  'client_id' => 'test_kXS69PGPgLWe5rszP4kKsQCoqNOb83zKvt6',
  'client_secret' => 'test_1ChlUAbtOQd2JXDqQeGm02kGnee1KyHMQkpFECEOcDtVWqBehbbsLYeGOQLg3JIDeZmybfGyQWlVyy2vL7RRqU5iZHxqzkiM60n2IEhY2UxVZL4KYh1hZqQWDmd',
  'grant_type' => 'client_credentials',
);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response);

$access_token = $result->access_token;

if ($payment_request_id && $access_token) {

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/v2/gateway/orders/payment-request/');
  curl_setopt($ch, CURLOPT_HEADER, FALSE);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token));

  $payload = array(
    'id' => $payment_request_id
  );

  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
  $response = curl_exec($ch);
  curl_close($ch);

  echo $response;

  exit();
}

exit();
