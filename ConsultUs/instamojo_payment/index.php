<?php
   include('../../Db_Connection/db_consultus_app.php');
  //1. get the id of user
   $id = $_GET['id'];
   $user = $_GET['user'];

   //2.sql query
   $sql ="SELECT * FROM `consultant` WHERE `c_id`=$id";
   //3.executing it
   $res = mysqli_query($conn,$sql);
if($res){
    $count = mysqli_num_rows($res);
    if($count ==1)
    {
        //get details 
        $row = mysqli_fetch_assoc($res);

        $full_name = $row['name'];
        $fees = $row['fee'];
        $category = $row['category'];
    }
    }
  //3.sql query
   $sql2 ="SELECT * FROM `login` WHERE `username`='$user'";
   //3.executing it
   $res2 = mysqli_query($conn,$sql2);
if($res2){
    $count2 = mysqli_num_rows($res2);
    if($count2 ==1)
    {
        //get details 
        $row2 = mysqli_fetch_assoc($res2);

        $buyer_name = $row['name'];
        $email = $row2['email'];
        $phone = $row2['phone'];
    }
    }
   
   ?>


<?php
echo print_r($_POST,true);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');         //instamojo url here
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
          array("X-Api-Key:e4f2b4dc4a9538131479fd94c84eb10e",         //enter your api key
                  "X-Auth-Token:c317f9c3980dfde368345eace142711d"));   //enter auth code
$payload = Array(
    'purpose' => 'ConsulUs-Fee',                            // purpose of payment
    'amount' => $fees,                                 // amount of payment
    'phone' => $phone,                          // ph.num
    'buyer_name' => $buyer_name,                      // buyername
    'redirect_url' => 'https://spaceforece.com/consult/instamojo_payment/success.php?email=$email',       // where to redirect user
    'send_email' => true,                              // sending mail
    'webhook' => 'https://spaceforece.com/consult/instamojo_payment/webhook2.php',  // ienter your webhook url
    'send_sms' => true,
    'email' => $email,                   // email address
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
  $email= $payload['email'];
  $long_url = $json_decode['payment_request']['longurl'];
  header('location:'.$long_url);  //redirecting to payment page
  echo ' </pre>';

?>