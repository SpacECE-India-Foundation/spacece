<?php
    
	include('conn.php');
	
	session_start();

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

	function check_input($data){
		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}

	$email=check_input($_POST['email']);
	$password=md5(check_input($_POST['password']));

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  		$_SESSION['sign_msg'] = "Invalid email format";
  		header('location:signup.php');
	}

	else{

		$query=mysqli_query($conn,"select * from user where email='$email'");
		if(mysqli_num_rows($query)>0){
			$_SESSION['sign_msg'] = "Email already taken";
  			header('location:signup.php');
		}
		else{
		//depends on how you set your verification code
		$set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';   
		$code=substr(str_shuffle($set), 0, 12);

		mysqli_query($conn,"insert into user (email, password, code) values ('$email', '$password', '$code')");
		$uid=mysqli_insert_id($conn);
		//default value for our verify is 0, means it is unverified
         
		//sending email verification
		$to = $email;
			$subject = "Sign Up Verification Code";
			$message = "
				<html>
				<head>
				<title>Verification Code</title>
				</head>
				<body>
				<h2>Thank you for Registering.</h2>
				<p>Your Account:</p>
				<p>Email: ".$email."</p>
				<p>Password: ".$_POST['password']."</p>
				<p>Please click the link below to activate your account.</p>
				<h4><a href='http://localhost/Educational_service/ES/ES/send_mail/send_mail/activate.php?uid=$uid&code=$code'>Activate My Account</h4>
				</body>
				</html>
				";
			//dont forget to include content-type on header if your sending html
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= "From: sangeetamalviya08@gmail.com". "\r\n" .
						"CC: sangeetamalviya08@gmail.com";

		if( function_exists( 'mail' ) ) 
	{ 
		echo 'mail() is available'; 
	} 
	else 
		{ 
			echo 'mail() has been disabled'; 
		}
            

// send email
	$headers = array("From: sangeetamalviya08@gmail.com", "Reply-To: sangeetamalviya08@gmail.com", "X-Mailer: PHP/" . PHP_VERSION );
	 $headers = implode("\r\n", $headers);


		$_SESSION['sign_msg'] = "Verification code sent to your email.";
  		header('location:signup.php');

  		}
	}
	}
?>