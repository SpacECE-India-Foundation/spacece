<?php

//start session on web page
session_start();
//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('1075515760283-ud4uc2iiehc85a4lgjfc0l3hd3ta252b.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('Pnc6ACO94VYuuhfI-Ff-I_Vy');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/consult/c_signup.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?>