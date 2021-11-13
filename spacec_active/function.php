<?php 

include('includes/db.php');
include('db.php');
session_start();

if(isset($_POST['login'])){

	$email=$_POST['email'];
	$password=$_POST['password'];

	//print_r($_POST);
	//die();


$query=mysqli_query($mysqli,"Select * from users where u_email='$email' and u_password='$password'") or die('Sql Query1 Error'. mysqli_error($mysqli));

if(mysqli_num_rows($query)>0){
	$row=mysqli_fetch_assoc($query);

	$_SESSION['u_id']=$row['u_id'];
	//var_dump($row);
	echo"Success";

}else{
	echo"Login Failed";
}


}

if(isset($_GET['geid'])){
	var_dump($_SESSION);

if(function_exists('date_default_timezone_set')) {
    date_default_timezone_set("Asia/Kolkata");
}

// then use the date functions, not the other way around
$date1 = date('Y-m-d');

$sql=mysqli_query($mysqli,"SELECT * from users Where u_id='".$_SESSION['u_id']."'") or die('Sql Query1 Error'. mysqli_error($mysqli));
    if(mysqli_num_rows($sql)>0){
       $data=mysqli_fetch_assoc($sql);
       $listDate=$data['u_createdAt'];
$query1=mysqli_query($mysqli1,"Select activity_no,activity_name,activity_date from spaceactive_activities where activity_date between '".$listDate."' and '$date1'") or die('Sql Query2 Error');
while ($row=mysqli_fetch_assoc($query1)) {
   // var_dump($row);
	echo '<tr><td>'.$row['activity_no'].'</td><td>'.$row['activity_name'].'</td><td>'.$row['activity_date'].'</td><tr>';
   
}
}
}


// Notifications

