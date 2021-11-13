<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');         //instamojo url here
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:test_c2746b8c9bc9a12d16f68a5b99b",         //enter your api key
                  "X-Auth-Token:test_93a9e7e554346ccbd99cc517e26"));   //enter auth code
$payload = Array(
    'purpose' => 'CONSULTATION FEE',                            // purpose of payment
    'amount' => '25',                                 // amount of payment
    'phone' => '7668711341',                          // ph.num
    'buyer_name' => 'yashasvi',                      // buyername
    'redirect_url' => 'http://3.109.14.4/instamojo_payment/success.php?email=parth@gmail.com',       // where to redirect user
    'send_email' => true,                              // sending mail
    'webhook' => 'http://3.109.14.4/consult/instamojo_payment/webhook2.php',  // ienter your webhook url
    'send_sms' => true,
    'email' => 'parth@gmail.com',                   // email address
    'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch); 

/*echo '<pre>';
  print_r($response);   // json object
  echo '</pre>';*/
  echo '<pre>';
  $json_decode = json_decode($response,true);
  print_r($json_decode);                            // displaying details of transaction

  $long_url = $json_decode['payment_request']['longurl'];
  header('location:'.$long_url);  //redirecting to payment page
  echo ' </pre>';

?>