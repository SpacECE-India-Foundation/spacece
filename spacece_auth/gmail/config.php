<?php

require_once 'vendor/autoload.php';

$google_client=new Google_client();
$google_client->setClientId('705362367676-tnd53a57sb9qve952d5po7u6sv79jsft.apps.googleusercontent.com');
$google_client->setClientSecret('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');
$google_client->setRedirectUri('http://localhost/asignment/form.php');

//$google_client->setAccessType('offline');
$google_client->addScope('email');
$google_client->addScope('profile');

 //session_start();