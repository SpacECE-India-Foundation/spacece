<?php
// FRONTEND-ONLY PROXY — backend को छुए बिना काम करेगा

$backendURL = "https://hustle-7c68d043.mileswebhosting.com/spacece/api/AddNewChild_MilesStone.php";

// cURL setup
$ch = curl_init($backendURL);

curl_setopt($ch, CURLOPT_POST, true);

// Merge POST + FILES
$postData = array_merge($_POST, $_FILES);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>
