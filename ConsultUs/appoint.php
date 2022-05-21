<?php 
session_start();
if(empty($_SESSION['current_user_email'])){
  header('location:../spacece_auth/login.php');
  exit();
}
$main_logo = "../img/logo/SpacECELogo.jpg";
$module_logo = "../img/logo/ConsultUs.jpeg";
$module_name = "ConsultUs";
include_once '../common/header_module.php';
include '../Db_Connection/constants.php';

$email='';

if(isset($_SESSION['current_user_email'])){
$email=$_SESSION['current_user_email'];

 ?>

<?php
//$email=$_SESSION['current_user_email'];
define('DB_USER_DATABASE', 'spacece');

$conn1 = new mysqli(DB_HOST_NAME, DB_USER_NAME, DB_USER_PASSWORD, DB_USER_DATABASE);
$u_name='';
$u_mob='';
$u_email='';
$c_from_time='';
$c_to_time='';
$sql="SELECT * FROM users WHERE u_email='$email'";
$res = mysqli_query($conn1, $sql);



if ($res) {
   
    $count = mysqli_num_rows($res);
    $sno = 1;
    if ($count > 0) {
      
        while ($row = mysqli_fetch_assoc($res)) {
          $u_name=$row['u_name'];
            $u_mob=$row['u_mob'];
            $u_email=$row['u_email'];
            $u_id=$row['u_id'];
       
        }
    }
}else{
 

}
$c_id=$_GET['cid'];
$sql1="SELECT consultant.c_from_time,consultant.c_to_time,consultant.c_aval_days FROM users join consultant WHERE users.u_id=consultant.u_id AND users.u_id='$c_id'"; $res1 = mysqli_query($conn1, $sql1);



 if ($res1) {
   
    $count = mysqli_num_rows($res1);
  
    if ($count > 0) {
      
        while ($row = mysqli_fetch_assoc($res1)) {
        
        $c_from_time=$row['c_from_time'];
        $c_to_time=$row['c_to_time'];
        $c_aval_days=$row['c_aval_days'];
        }
    }
 }else{
   echo "No  data Found";
 }
//  echo $cid = $_GET['id'];
//  echo $category = $_GET['category'];
//  echo $name = $_GET['name'];
//   echo $uid =$_GET['uid'];
include('../Db_Connection/db_consultus_app.php');

$c_id=$_GET['cid'];
$b_id=$_GET['b_id'];
$con_name=$_GET['con_name'];
 $cat_name=$_GET['cat_name'];
  $sql="INSERT INTO `appointment`( `cid`, `category`,`username`, `cname`,`bid`,`com_mob`) VALUES ('$c_id','$cat_name','$u_name','$con_name','$b_id','$u_mob')";

  
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

        <!-- <div class="menu text-center" style="background-color:orange;">
<img src="img/space.jpg" alt="" style="width:6%; ">
            <div class="wrapper" >
                <ul>
                    <li><a href="index.html">HOME</a></li>
                    <li><a href="alldoc.php?user=<?php //echo $user_name?>">CONSULTANT</a></li>
                </ul>
            </div>
        </div> -->

<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

<style>
/* body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: black;
} */

/* * {
  box-sizing: border-box;
} */

/* Add padding to containers */
/* .container {
  padding: 16px;
  background-color: white;
} */

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
      //if(isset($_POST["submit"]))
      //{ //1.getting data into variable
        
      //     $full_name = $user_name;
      //     $email = $user_email;
      //     $mob = $user_mob;
      //     // $bookid = $uid;
      //      $atime = $_POST["atime"];
      //      $adate = $_POST["adate"];
      //    $status ="inactive";
      //    // encrypt pass 
      //    $time= date("H:i", strtotime($atime));
      //    $time1=strtotime($time);
      //    if(strtotime($c_from_time) > $time1 || strtotime($c_to_time) < $time1){
          
          
      //      $_SESSION['add']= "Consultant Un available";
      //    }else{

         
      //    //2.inserting into database
      //   $sql= " UPDATE `appointment` SET  `status`='$status',`time_appointment`='$atime',`date_appointment`='$adate' WHERE `bid`='$b_id'";
       
      //   $res= mysqli_query($conn,$sql);
      //    echo "<h3 style = 'color:white;'>$full_name<h3>";
      //    echo "<h3 style = 'color:white;'>$email<h3>";
      //    echo "<h3 style = 'color:white;'>$mob<h3>";
      //    echo "<h3 style = 'color:white;'>$userid<h3>";
       
      //    //3. checking data is inserted or not
      //    if($res){
      //        $_SESSION['add']= "<div style='color:green;'> appointment booked successfully</div>";         //creating session variable
      //        // redirecting page
      //        header("location:./alldoc.php");
      //        //echo "<h3 style = 'color:white;'>database updated<h3>";
      //    }
      // else{
      //     $_SESSION['add']= "failed to book appointment successfully";         //creating session variable
      //     // redirecting page
      //     header("location:./alldoc.php");
      // //echo "<h3 style = 'color:white;'>database not updated<h3>";
      // }
      
      //     echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" style:"backgeound-color:orange">
      //     <strong style="color:white;">sucess!</strong> <h3 style="color:white;">Your form is submitted sucessfully.</h3>
      //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      //   </div>';
      // }
  
    // }
  
      
  
  ?>
<a href="./cdetails.php?category=all" class="btn btn-secondary">View All consultants</a>
<form   name="appoint" id="appoint" class="  justify-content-center">
  <div class="container " style="width:80%">
    <h1>BOOK APPOINTMENT</h1>
    <p>
    </p>
    <h5>Available Time(From):<?php echo $c_from_time; ?></h5>
    <h5>Available Time(To):<?php echo $c_to_time; ?></h5>
    <br>
    <h5>Available Days: <?php echo $c_aval_days; ?></h5>
    <hr>
    <label for="userid"><b>Booking Id</b></label>
    <input type="text" value="<?php echo $b_id ?>" name="userid" id="userid" required readonly>
    <label for="adate"><b>Date Of Appointment:</b></label>
        <!-- bug id=0000014 -->
   <input type="date" id="adate" name="adate"  min="<?php echo date('Y-m-d') ?>" required><br><br>
    <!-- bug id-0000045 -->
 <label for="atime"><b>Select A Time:</b></label>
  <input type="time" id="atime" name="atime" required  >
<br><br>
    <label for="fullname"><b>Fullname</b></label>

    <input type="text" value="<?php echo $u_name ?>"   onkeypress="return /[a-z]/i.test(event.key)"  name="fullname" id="fullname" required >
<label for="cname"><b>Consultant Name</b></label>
    <input type="text" value="<?php echo $con_name ?>"  onkeypress="return /[a-z]/i.test(event.key)"  name="cname" id="cname" required  readonly>

    <!-- <input type="text" value="<?php //echo $u_name ?>" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"  name="fullname" id="fullname" required readonly>
<label for="cname"><b>Consultant Name</b></label>
    <input type="text" value="<?php //echo $con_name ?>" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" name="cname" id="cname" required>
 -->
 <label for="cname"><b>Children name</b></label>
 <select id="child_id" name="child_id" class="form-control">
 <?php 
$sql3="SELECT ID,childName from cits1.tblchildren where cits1.tblchildren.parentEmail='$email'";
$res= mysqli_query($conn,$sql3);
$count2=mysqli_num_rows($res);
  if($count2){
    while($row3=mysqli_fetch_assoc($res)){
     ?>
      <option value="<?php echo $row3['ID'];  ?>" ><?php echo $row3['childName'];  ?></Select>
     <?php
    }
  }else{
    ?>
 <option value="" >No Data Found</Select>
    <?php
  }

 ?>
 </Select></option></select>
 <br>

    <label for="email"><b>Email</b></label>
    <input type="text" value="<?php echo $u_email ?>" name="email" id="email" required>
    <label for="mobile"><b>Mobile Number:</b></label>
    <input type="text" value="<?php echo $u_mob ?>"   minlength="10" maxlength="10" pattern="[0-9]{10}" name="mobile" id="mobile" required><br>
    
    <hr>
  <input type="submit" name="submit" id="submit" class="registerbtn">
  </div>
  
  <div class="container signin" style="background-color:orange">
    <p>you can check your appointment details ,by pressing show appointment button </p>
  </div>
</form>



</body>
</html>


         <!-- <div class="footer text-centre" style="background-color:orange;">
            <div class="wrapper">
                 <p class="text-center" ><a href="#"></a></p>
            </div>
         </div> -->
       <?php

include_once '../common/footer_module.php';
}else{
  header('location:../spacece_auth/login.php');
}

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

<script>
  $(document).ready(function(){


 $('#appoint').on('submit', function(e) {
      

var c_from_time="<?php echo $c_from_time; ?>";
var c_to_time="<?php echo $c_to_time; ?>";
var c_id=<?php  echo $c_id; ?>;
var b_id=$('#userid').val();
var adate=$('#adate').val();
var atime=$('#atime').val();
var child_id=$('#child_id').val();
var fullname=$('#fullname').val();
var cname=$('#cname').val();
var mobile=$('#mobile').val();
var email=$('#email').val();
e.preventDefault();
$.ajax({
  method:'POST',
  data:{
    b_id:b_id,
    adate:adate,
    atime:atime,
    cname:cname,
    mobile:mobile,
    fullname:fullname,
    child_id:child_id,
    c_id:c_id,
    email:email,
    c_from_time:c_from_time,
    c_to_time:c_to_time
  },url:'./c_booking_ajax.php',
  success:function(data){
  // alert(data);
  // console.log(data);
    if(data==="Unavailable"){
      swal("Error","Consultant Un available","error");
    }
    if(data.length > 15){
    var data1=JSON.parse(data);

    swal("Good job!", "Booking Id :"+data1.bid+"\n Consultant name :"+data1.cname
  + "\n  user name:"+data1.username +"\n Email : "+data1.email	+"\n Date of appointment:"+data1.date_appoint+" \n Time of appoint :"+data1.time_appointment
    +"\n mobile:"+data1.mobile+"", "success") ;
window.location.href="./cdetails.php?category=all";
//swal("Good job!", data, "success");
  } else{
    swal("Error","Consultant Not Available in the selected Time-slot","error");
  }
}
})

  })
})
  </script>
</html>

