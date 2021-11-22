<?php 
include_once './includes/header1.php';
include('indexDB.php'); ?>
<?php
 echo $cid = $_GET['id'];
 echo $category = $_GET['category'];
 echo $name = $_GET['name'];
  echo $uid =$_GET['uid'];
$ctime =$_GET['ctime'];
$stime = $_GET['stime'];
      $con_mob = $_GET['conmob'];
   $user_name =$_GET['user_name'];
  $user_email =$_GET['user_email'];
  $user_mob =$_GET['user_mob'];
  $sql="INSERT INTO `appointment`( `cid`, `category`, `cname`,`bid`,`com_mob`) VALUES ('$cid','$category','$name','$uid','$con_mob')";
  $res= mysqli_query($conn,$sql);
  if(!$res){echo "<h3 style = 'color:white;'><center>sorry,unable to connect</center></h3>";}
  //echo "<h3 style = 'color:white;'>this is your booking id = $uid , please fill it in form</h3>";

  ?>
<html>
    <head>
        <title>appointment-HOME PAGE</title>
        <link rel="stylesheet"  href="css/admin.css">
    </head>
    <body>
        <! ... menu section starts...>

        <div class="menu text-center" style="background-color:orange;">
<img src="img/space.jpg" alt="" style="width:6%; ">
            <div class="wrapper" >
                <ul>
                    <li><a href="index.html">HOME</a></li>
                    <li><a href="alldoc.php?user=<?php echo $user_name?>">CONSULTANT</a></li>
                </ul>
            </div>
        </div>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: black;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
</head>
<body>
<?php
                if(isset($_SESSION['add'])){
                    echo  $_SESSION['add']; // displaying session
                    unset($_SESSION['add']); // removing session
                }
                echo "<br>";
                echo "<br>";

                ?>
                <?php
  
  // process the value  from the form  and save it to database
  // check whether form is submitted or not
      if(isset($_POST["submit"]))
      { //1.getting data into variable
        
          $full_name = $user_name;
          $email = $user_email;
          $mob = $user_mob;
           $bookid = $uid;
           $atime = $_POST["atime"];
           $adate = $_POST["adate"];
         echo $status ="inactive";
         // encrypt pass 
  
         //2.inserting into database
        $sql= " UPDATE `appointment` SET `username`= '$full_name' , `status`='$status',`email`='$email', `mobile`='$mob',`time_appointment`='$atime',`date_appointment`='$adate' WHERE `bid`='$bookid'";
        $res= mysqli_query($conn,$sql);
         echo "<h3 style = 'color:white;'>$full_name<h3>";
         echo "<h3 style = 'color:white;'>$email<h3>";
         echo "<h3 style = 'color:white;'>$mob<h3>";
         echo "<h3 style = 'color:white;'>$userid<h3>";
       
         //3. checking data is inserted or not
         if($res){
             $_SESSION['add']= "<div style='color:green;'> appointment booked successfully</div>";         //creating session variable
             // redirecting page
             header("location:".SITEURL.'alldoc.php'."?user=$full_name");
             //echo "<h3 style = 'color:white;'>database updated<h3>";
         }
      else{
          $_SESSION['add']= "failed to book appointment successfully";         //creating session variable
          // redirecting page
          header("location:".SITEURL.'alldoc.php'."?user=$full_name");
      //echo "<h3 style = 'color:white;'>database not updated<h3>";
      }
      
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" style:"color:white;">
          <strong style="color:white;">sucess!</strong> <h3 style="color:white;">Your form is submitted sucessfully.</h3>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      }
  
      else{
                }
  
      
  
  ?>

<form action="" method="POST">
  <div class="container">
    <h1>BOOK APPOINTMENT</h1>
    <p>
    </p>
    <hr>
    <label for="userid"><b>Booking Id</b></label>
    <input type="text" value="<?php echo $uid?>" name="userid" id="userid" required>
    <label for="adate"><b>Date Of Appointment:</b></label>
        <!-- bug id=0000014 -->
   <input type="date" id="adate" name="adate"  min="<?php echo date('Y-m-d') ?>"><br><br>
    <!-- bug id-0000045 -->
 <label for="atime"><b>Select A Time:</b></label>
  <input type="time" id="atime" name="atime" min="16:00" max="22:00" >
<br><br>
    <label for="fullname"><b>Fullname</b></label>
    <input type="text" value="<?php echo $user_name ?>" name="fullname" id="fullname" required>
<label for="cname"><b>Consultant Name</b></label>
    <input type="text" value="<?php echo $name ?>" name="cname" id="cname" required>

    <label for="email"><b>Email</b></label>
    <input type="text" value="<?php echo $user_email ?>" name="email" id="email" required>
    <label for="mobile"><b>Mobile Number:</b></label>
    <input type="text" value="<?php echo $user_mob ?>" name="mobile" id="mobile" required><br>
    
    <hr>
  <input type="submit" name="submit" class="registerbtn" value="submit">
  </div>
  
  <div class="container signin" style="background-color:orange">
    <p>you can check your appointment details ,by pressing show appointment button </p>
  </div>
</form>



</body>
</html>

<! ... end section starts...>
         <div class="footer text-centre" style="background-color:orange;">
            <div class="wrapper">
                 <p class="text-center" ><a href="#"></a></p>
            </div>
         </div>
       <?php
include_once './includes/footer1.php';


?>
    </body>


</html>

