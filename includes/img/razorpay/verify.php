<?php
include("db.php");

require('config.php');

session_start();

require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    $razorpay_order_id = $_SESSION['razorpay_order_id'];
    $razorpay_payment_id = $_POST['razorpay_payment_id'];
    $email = $_SESSION['email'];
    $mob =$_SESSION['mob'] ;
    $status = "active";
    $amt =  $_SESSION['amount'];
    $sql="UPDATE `subcriber` SET `id`='$razorpay_order_id',`razorpay_payment_id`='$razorpay_payment_id',`email`='$email',`status`='$status',`mobile`='$mob',`amount`='$amt' WHERE `mobile`='$mob'";
    $res2= mysqli_query($conn,$sql);
    //3. checking data is inserted or not
    $html = "<p>Your payment was successful</p>
    <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
    $html2 = "<p>email: {$_SESSION['email']}</p>";
    $html3 = "<p>mobile: {$_SESSION['mob']}</p>";

    
    if($res2){
       /* $_SESSION['update']= "<div style='color:green;'> status updateded successfully</div>";         //creating session variable
        // redirecting page
        header("location:".SITEURL.'index.php');*/
        echo "<h3 style = 'color:white;'>database updated<h3>";
    }
   
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
             $razorpay_order_id = $_SESSION['razorpay_order_id'];
             $razorpay_payment_id = $_POST['razorpay_payment_id'];
             $email = $_SESSION['email'];
             $mob =$_SESSION['mob'] ;
             $status = "inactive";
             $amt =  $_SESSION['amount'];
             $sql="UPDATE `subcriber` SET `id`='$razorpay_order_id',`razorpay_payment_id`='$razorpay_payment_id',`email`='$email',`status`='$status',`mobile`='$mob',`amount`='$amt' WHERE `mobile`='$mob'";
             $res2= mysqli_query($conn,$sql);
             //3. checking data is inserted or not
             $html = "<p>Your payment was not successful</p>
             <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
             if($res2){
                /* $_SESSION['update']= "<div style='color:green;'> status updateded to inactive</div>";         //creating session variable
                 // redirecting page
                 header("location:".SITEURL.'index.php');*/
                 echo "<h3 style = 'color:white;'>database not updated<h3>";
             }
}

echo $html;
echo $html2;
echo $html3;

