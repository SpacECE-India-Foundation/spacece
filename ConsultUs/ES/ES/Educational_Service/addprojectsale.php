<?php
    include('db_consultus_app.php');
    session_start();
    $loc=$city=$desc=$am=$ar=$i=$i1=$i2=$i3=$rate='';$cost=0;
    $locErr=$cityErr=$descErr=$amErr=$arErr=$iErr=$costErr=$rateErr='';
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$b=true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["loc"])) {
        $locErr = "*Location is required";
        $b=false;
      } else {
        $loc = test_input($_POST["loc"]);
         if (!preg_match("/^[a-zA-Z_ ]*$/",$loc) || $loc=='') {
          $locErr = "*Only letters allowed";
          $b=false; 
        }
      }
      if (empty($_POST["city"])) {
        $cityErr = "*City is required";
        $b=false;
      } else {
        $city = test_input($_POST["city"]);
         if (!preg_match("/^[a-zA-Z]*$/",$city) || $city=='') {
          $cityErr = "*Only letters allowed";
          $b=false; 
        }
      }
      if (empty($_POST["desc"])) {
        $descErr = "*Description is required";
        $b=false;
      } else {
        $desc = test_input($_POST["desc"]);
      }
      if (empty($_POST["amen"])) {
        $amErr = "*Amenities is required";
        $b=false;
      } else {
        $am = test_input($_POST["amen"]);
      }
      if (empty($_POST["img1"])) {
        $iErr = "*Image is required";
        $b=false;
      } else {
        $i = test_input($_POST["img1"]);
        $i1= test_input($_POST["img2"]);
        $i2= test_input($_POST["img3"]);
        $i3= test_input($_POST["img4"]);
      }
  if (empty($_POST["area"])) {
    $arErr = "*Area is required";
    $b=false;
  } else {
    $ar = test_input($_POST["area"]);
    if(!preg_match("/^[0-9]{1,10}$/",$ar) || $ar==''){
    	$arErr = "*Enter only Numbers";
    	$b=false;
    }
  }
  if (empty($_POST["rate"])) {
		$rateErr = "*Rate is required";
    $b=false;
  } else {
		$rate = test_input($_POST["rate"]);
		if(!preg_match("/^[0-9]{1,10}$/",$rate) || $rate==''){
    	$rateErr = "*Enter only Numbers";
    	$b=false;
    }
	}
}
if($b==true && isset($_POST['submit']))
{
		$id='';
		if($_SESSION['type']=='normal')
		{
			$id='uid';
		}
		else
		{
			$id='bid';
		}
    $q1="insert into flat(location,".$id.",city,description,amenities,area,image,image1,image2,image3) values('$loc',".$_SESSION['id'].",'$city','$desc','$am',$ar,'$i','$i1','$i2','$i3')";
		$result1 = $conn->query($q1);
		echo $q1;
    echo "Insert in flat done";
    $q3="select flat_id from flat where location='$loc' and city='$city' and area=$ar and amenities='$am'";
    $r3=$conn->query($q3);
    $x=mysqli_fetch_array($r3, MYSQLI_ASSOC);
    $test=$x['flat_id'];
    echo "flat id fetched is ".$test;
    $cost=$rate*$ar;
		$q2="insert into sale(flat_id,totalcost,rate) values($test,$cost,$rate)";
		echo $q2;
    $result2 = $conn->query($q2);
    echo "Sale inserted";
    if($_SESSION['type']=='normal')
		{
			header('Location: normalHomeSale.php');
		}

		else
		{
			header('Location: builderHome.php');
		}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>HOUSING-CO</title>
	<meta charset="UTF-8">
	<meta name="description" content="HOUSING-CO">
	<meta name="keywords" content="HOUSING-CO, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->   
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/animate.css"/>
	<link rel="stylesheet" href="css/owl.carousel.css"/>
	<link rel="stylesheet" href="css/style.css"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>
	
	<!-- Header section -->
	<header class="header-section" style="color:orange;font-weight:bold;font-size: 20px;">
		<div class="header-top">
			<div class="container">
				
                    <div class="col-10" >
                        
                    </div>
					<div class="col-2" style="margin-left:600px;">
						
					<?php echo $_SESSION['username']."  ";?><a href="logout.php" style="color:orange;"><i class="fa fa-user-circle-o"></i>Logout</a>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">

				<div class="col-12">
					
				
			</div>






		</div>
	</header>

	<!-- Header section end -->
	<section class="hero-section set-bg" data-setbg="">
		<div class="container hero-text text-white">
			<h2></h2>
		</div>
	</section>
	<br><br><br>
    <!-- Properties section end -->
    <style type="text/css">
body{
background-repeat:no-repeat;
background-image:url("img/service-bg1.jpg");
background-size:cover;
background-attachment:fixed;
color:white;
}
input[type=text],input[type=date],input[type=password] {
    border: none;
    border-bottom: 1px solid #fff;
    width: 100%;
    padding: 30px 40px;
    background: transparent;
    outline: none;
    height: 40px;
    color: #fff;
    font-size:16px ;
}

 input[type=submit], input[type=reset] {
   border: none;
   outline: none;
   height: 30px;
   width: 100px;
   background-color: #fb2525;
   color: #fff;
   font-size: 20px;
   border-radius: 20px;
   align-items: center;
}



input[type=radio] {
    height: 15px;
    width: 15px;
    
}





select {
	 background-color: #e0e0d1;
    border: none;
    color: black;
    padding: 4px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
    font-weight:bold;
    border-radius: 20px;

}
textarea {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    background-color:#e0e0d1;
    color:black;
}
table{
	margin-top: -700px;
 background-color:black;
  border-collapse: collapse; 
  border: 2px solid navy;
  
  height: 900px;
  width: 700px;


}
form{
opacity:0.7;
}
td{
font-weight:bold;
}
span
{
   color:red;
}

</style>
</head>




<form id="form" method="post" action="addprojectsale.php" >

<table cellpadding="7" width="50%" border="0" align="center"cellspacing="2" color="white">

    <!-- I want another button here, center to the tile-->



<tr>
<td colspan=2>
<center><img src="img/reg_icon.png" style="width: 150px; height:150px;border-radius: 50%; position:absolute;
top: 60px; left:calc(49% - 50px);"></img></center>
</td>
</tr>
<tr>
<td colspan=2>
<center><font size=7><b>ADD MORE DETAILS</b></font></center>
</td>
</tr>

<tr>
<td><font size=5><b>Location<span style="color:red;font-weight:bold">*</span></b></font></td>
<td><input type="text" name="loc" size="30" placeholder="Loaction">
<span class="error"><?php echo $locErr; ?></span>
<br><br>
</td>
</tr>




<tr>
<td><font size=5><b>City<span style="color:red;font-weight:bold">*</span></b></font></td>
<td><input type="text" name="city" size="30" placeholder="City">
<span class="error"><?php echo $cityErr; ?></span>
  <br><br>
</td>
</tr>


<tr>
<td><font size=5><b>Description<span style="color:red;font-weight:bold">*</span></b></font></td>
<td><input type="text" name="desc" size="30" placeholder="Description">
<span class="error"><?php echo $descErr; ?></span>
  <br><br>
</td>
</tr>


<tr>
<td><font size=5><b>Amenities<span style="color:red;font-weight:bold">*</span></b></font></td>
<td><input type="text" name="amen" size="30" placeholder="Amenities">
<span class="error"><?php echo $amErr; ?></span>
  <br><br>
</td>
</tr>


<tr>
<td><font size=5><b>Consultant Fees per hour(Rs)<span style="color:red;font-weight:bold">*</span></b></font></td>
<td><input type="text" name="area" size="30" placeholder="Area">
<span class="error"><?php echo $arErr; ?></span>
  <br><br>
</td>
</tr>






<tr>
<td><font size=5><b>Image1 URL<span style="color:red;font-weight:bold">*</span></b></font></td>
<td><input type="text" name="img1" size="30" placeholder="Image1">
<span class="error"><?php echo $iErr; ?></span>
  <br><br>
</td>
</tr>
<tr>
<td><font size=5><b>Gender<span style="color:red;font-weight:bold">*</span></b><font></td>
<td><input type="text" name="img2" size="30" placeholder="Male/Female">
<span class="error"></span>
  <br><br>
</td>
</tr>
<tr>
<td><font size=5><b>D.O.B<span style="color:red;font-weight:bold">*</span></b></font></td>
<td><input type="text" name="img3" size="30" placeholder="DD/MM/YYYY">
<span class="error"></span>
  <br><br>
</td>
</tr>
<tr>
<td><font size=5><b>Experience<span style="color:red;font-weight:bold">*</span></b></font></td>
<td><input type="text" name="img4" size="30" placeholder="Days/Months/Years">
<span class="error"></span>
  <br><br>
</td>
</tr>
<tr>
<td><font size=5><b>Age<span style="color:red;font-weight:bold">*</span></b></font></td>
<td><input type="text" name="rate" size="30" placeholder="Age">
<span class="error"><?php echo $rateErr;?></span>
  <br><br>
</td>
</tr>
<tr>
<td><input type="reset" value="Reset"></td>
<td><input type="submit" value="Submit" name="submit">

<div style = "font-size:20px; color:#cc0000; margin-top:10px"></div>
</td>
</tr>
</table>
<br><br><br><br><br><br><br><br><br><br>
</form>
	<!-- Clients section -->
	<!--<div class="clients-section">
		<div class="container">
			<div class="clients-slider owl-carousel">
				<a href="#">
					<img src="img/partner/1.png" alt="">
				</a>
				<a href="#">
					<img src="img/partner/2.png" alt="">
				</a>
				<a href="#">
					<img src="img/partner/3.png" alt="">
				</a>
				<a href="#">
					<img src="img/partner/4.png" alt="">
				</a>
				<a href="#">
					<img src="img/partner/5.png" alt="">
				</a>
			</div>
		</div>
	</div>-->
	<!-- Clients section end -->



	

	<!-- Footer section end -->
                                        
	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/masonry.pkgd.min.js"></script>
	<script src="js/magnific-popup.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>