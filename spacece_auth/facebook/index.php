<?php


include 'config.php';

$facebook_output='';
$facebook_helper=$facebook->getRedirectLoginHelper();
if(isset($_GET['code'])){
	if(isset($_SESSION['sccess_token'])){

		$access_token=$_SESSION['sccess_token'];

	}else{

		$access_token=$facebook_helper->getAccessToken();
		$_SESSION['sccess_token']=$access_token;
		$facebook->serDefaultAccessToken($_SESSION['sccess_token']);

	}
	$graph_response=$facebook->get("/me?fields=name,email",$access_token);
	$facebook_user_info=$graph_response->getGraphUser();
	if(!empty($facebook_user_info['name'])){
		$_SESSION['user_name']=$facebook_user_info['name'];
	}
	if(!empty($facebook_user_info['email'])){
		$_SESSION['user_email_address']=$facebook_user_info['email'];
	}
}else{
	$facebook_permissions=['email'];
	$facebook_login_url=$facebook_helper->getLoginUrl('https://spacefoundation.in/test/SpacECE-2917/',$facebook_permissions);
	$facebook_login_url='<a href="'.$facebook_login_url.'"></a>';
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title></title>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container d-flex justify-content-center" >
	<div class="col-6"><?php
	if(isset($facebook_login_url)){
		echo '<div class="row justify-content-center">
                                        <div class="col-sm-9 mt-5"><button type="button" class="btn btn-icon btn-block text-left "><span><img src="https://img.icons8.com/color/48/000000/google-logo.png" class="img-fluid mr-1" width="25"></span> Sign up with Google</button></div>
                                        <div class="col-sm-9 mt-2"><button type="button" class="btn btn-icon btn-block text-left "><span><img src="https://i.imgur.com/URmkevm.png" class="img-fluid mr-1" width="25"></span> Sign up with Facebook</button> </div>
                                        <div class="col-sm-9 mt-2"><button type="button" class="btn btn-icon btn-block text-left "><span><img src="https://img.icons8.com/color/48/000000/twitter.png" class="img-fluid mr-1" width="25"></span> Sign up with Twitter</button> </div>
                                    </div>';
	}
	else{
		echo '<div class="pannel">
		Welcome</div>';

	}
	?>
                                   
                                   
                                   
                    </div>
</div>
                </div>
            
</body>
</html>

