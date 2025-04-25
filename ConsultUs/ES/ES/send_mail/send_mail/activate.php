<?php
	include('conn.php');
	session_start();
	if(isset($_GET['code'])){
	$user=$_GET['uid'];
	$code=$_GET['code'];

	$query=mysqli_query($conn,"select * from user where userid='$user'");
	$row=mysqli_fetch_array($query);

	if($row['code']==$code){
		//activate account
		mysqli_query($conn,"update user set verify='1' where userid='$user'");
		?>
		<p>Account Verified!</p>
		<p><a href="index.php">Login Now</a></p>
		<?php
	}
	else{
		$_SESSION['sign_msg'] = "Something went wrong. Please sign up again.";
  		header('location:signup.php');
	}
	}
	else{
		header('location:index.php');
	}
?>