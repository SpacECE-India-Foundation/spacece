<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="./w3.css">
<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
<div class="w3-bar w3-border w3-black">
  <a href="dashboard.php" class="w3-bar-item w3-button">Admin Dashboard</a>
  <a style="float:right;" href="logout.php" class="w3-bar-item w3-button w3-hover-none w3-text-red w3-hover-text-white"><i class="fa fa-power-off"></i> Log Out</a>
 <a style="float:right;" href="change-password.php" class="w3-bar-item w3-button w3-hover-none w3-text-white w3-hover-text-white"><i class="fa fa-key"></i> Change Password</a>
  <a style="float:right;" href="#" class="w3-bar-item w3-button w3-hover-none w3-text-white w3-hover-text-white"><i class="fa fa-user"></i> <?php $query=mysqli_query($con,"select username from admin where id='".$_SESSION['id']."'");
while($row=mysqli_fetch_array($query))
{
	echo $row['username'];
   
}
									?></a>
    
</div>

</div>
</body>
</html>