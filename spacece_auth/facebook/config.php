<?php

require_once 'vendor/autoload.php';
if(!session_id()){
	session_start();
}
$facebook=new \Facebook\Facebook([
	'app_id' =>'1081214425985077',
	'app_secret' => '07ed8371b2e719cca209cb5ee28f621f',
	'default_graph_version'=>'v2.10'
]);