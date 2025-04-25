<!DOCTYPE html>
<header>
</header>
<body>

<?php 
$amount = $_GET['amount'];
echo $_GET['amount'];
echo "Hello";?><br>
<?php
$email = $_POST['buyer'];
echo $_POST['buyer'];?><br>
<?php
$name = $_POST["buyer_name"];
echo $_POST['buyer_name'];?><br>
<?php
$phone = $_POST["buyer_phone"];
echo $_POST['buyer_phone'];?><br>
<?php
$currency = $_POST['currency'];
echo $_POST['currency'];?><br>
<?php
$fees = $_POST['fees'];
echo $_POST['fees'];?><br>
<?php
$longurl = $_POST['longurl'];
echo $_POST['longurl'];?><br>
<?php
$mac = $_POST['mac'];
echo $_POST['mac'];?><br>
<?php
$payment_id = $_POST['payment_id'];
echo $_POST['payment_id'];?><br>
<?php
$payment_request_id = $_POST['payment_request_id'];
echo $_POST['payment_request_id'];?><br>
<?php
$purpose = $_POST["purpose"];
echo $_POST['purpose'];?><br>
<?php
$shorturl = $_POST['shorturl'];
echo $_POST['shorturl'];?><br>
<?php
$status = $_POST['status'];
echo $_POST['status'];?><br>

<!-- https://sms2.sminfomedia.in/api/mt/SendSMS?user=space&password=space&senderid=MSGSMS&channel=Trans&DCS=0&flashsms=0&
number=919372744039&text=%27Hi%20this%20is%20sachin%27 -->
<?php
    $message = "Thankyou so much {$name}. We have recieved your payment.";
    echo $message;?><br>
    <?php
    sleep(10);
    // echo "https://sms2.sminfomedia.in/api/mt/SendSMS?user=space&password=space&senderid=MSGSMS&channel=Trans&DCS=0&flashsms=0&number=8800312995&text=%27Hi%20this%20is%20sachin%27"
    // header("Location: https://sms2.sminfomedia.in/api/mt/SendSMS?user=space&password=space&senderid=MSGSMS&channel=Trans&DCS=0&flashsms=0&number={$phone}&text=%27Hi%20this%20is%20{$name}%27");
?>
</body>
</html>