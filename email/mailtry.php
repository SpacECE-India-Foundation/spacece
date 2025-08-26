<?php
require '../vendor/autoload.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//use 'PHPMailer/PHPMailer/PHPMailer';
require_once('PHPMailer.php');

$mail=new PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
 $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS
$mail->Port = 25;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "geetagem@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "Pidapa51&";

//Set who the message is to be sent from
$mail->setFrom('vsramak@gmail.com', 'First Last');

//Set an alternative reply-to address
$mail->addReplyTo('geetagem@gmail.com', 'First Last');

//Set who the message is to be sent to
$mail->addAddress('geetagem@gmail.com', 'John Doe');
//set body
 $mail->Body = 'testing...';
echo "sending";
$bool=$mail->send();
if($bool) {echo 'sent';} else {
    echo 'not sent';
    
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
?>