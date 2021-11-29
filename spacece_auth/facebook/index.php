<?php


include 'config.php';
include '../db.php';
$facebook_output='';
$facebook_helper=$facebook->getRedirectLoginHelper();
if(isset($_GET['code'])){
	if(isset($_SESSION['sccess_token'])){

		$access_token=$_SESSION['sccess_token'];

	}else{

		$access_token=$facebook_helper->getAccessToken();
		$_SESSION['sccess_token']=$access_token;
		$facebook->setDefaultAccessToken($_SESSION['sccess_token']);

	}
	$graph_response=$facebook->get("/me?fields=name,email",$access_token);
	$facebook_user_info=$graph_response->getGraphUser();
	$sql="Insert into social_login (email,name) VALUES('".$facebook_user_info['name']."','" .$facebook_user_info['email']."')";
	// if(!empty($facebook_user_info['name'])){
	// 	$_SESSION['user_name']=$facebook_user_info['name'];
	// }
	// if(!empty($facebook_user_info['email'])){
	// 	$_SESSION['user_email_address']=$facebook_user_info['email'];
	// }
}else{
	$facebook_permissions=['email'];
	$facebook_login_url=$facebook_helper->getLoginUrl('https://spacefoundation.in/test/SpacECE-2917/',$facebook_permissions);
	//$facebook_login_url='<a href="'.$facebook_login_url.'"></a>';


	echo ' <a id="facebook-button" href="'.$facebook_login_url.'" class="btn btn-block btn-social btn-facebook">
	<i class="fa fa-facebook"></i> Sign in with Facebook
  </a>';
}
?>

