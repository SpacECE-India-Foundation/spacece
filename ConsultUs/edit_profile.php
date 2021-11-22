<?php include_once './includes/header1.php';
 include("indexDB.php");?>
<div class="main-content">
    <div class="wrapper">
        <center><h2>UPDATE PEOFILE</h2></center>
    </div>
</div>
<?php

  //1. get the id of user
   $id = $_GET['id'];
   $user= $_GET['name'];

   //2.sql query
   $sql ="SELECT * FROM `consultant` WHERE `c_id`=$id";
   //3.executing it
   $res = mysqli_query($conn,$sql);
if($res){
    $count = mysqli_num_rows($res);
    if($count ==1)
    {
        //get details 
        $row = mysqli_fetch_assoc($res);

        $full_name = $row['name'];
        $ctime = $row['ctime'];
        $stime = $row['stime'];
        $office = $row['office'];
        $email = $row['email'];
        $phone = $row['mobile'];
        $pass = $row['pass'];



    }
    else{
        $_SESSION['add']= "<div  style='color: #43ec19;'> failed to update time</div>";         //creating session variable
        // redirecting page
        header("location:".SITEURL.'appoint_consultant.php'."?user=$user");
        //echo "<h3 style = 'color:white;'>database not updated<h3>";
       }
    }
   
   ?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-image: linear-gradient(90deg,  orange,orange,white);
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: transparent;
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
<form action="" method="POST">
  <div class="container">
    <center><h1>UPDATE CONSULTATION TIME</h1></center>
    <p>Please fill in this form to update an account.</p>
    <hr>

    <label for="fullname"><b>Fullname</b></label>
    <input type="text" placeholder="<?php echo $full_name ?>" name="fullname" id="fullname" required><br><br>
        <label for="office"><b>Address</b></label>
    <input type="text" placeholder="<?php echo $office ?>" name="office" id="office" required><br><br>
   <label for="email"><b>Email</b></label>
    <input type="text" placeholder="<?php echo $email ?>" name="email" id="email" required><br><br>
<label for="mobile"><b>Phone</b></label>
    <input type="text" placeholder="<?php echo $phone ?>" name="mobile" id="mobile" required><br><br>
  <label for="ctime"><b>CONSULTATION Time (from):</b></label>
    <input type="time" placeholder="<?php echo $ctime ?>"  name="ctime" id="ctime" required><br><br>
    <label for="stime"><b>CONSULTATION Time (to):</b></label>
    <input type="time" placeholder="<?php echo $stime ?>"  name="stime" id="stime" required><br><br>
<label for="pass"><b>Password</b></label>
    <input type="text" placeholder="<?php echo $pass ?>" name="pass" id="pass" required><br><br>

    <hr>
    <input type="hidden" name="id" value="<?php echo $id ?>">
     <input type="submit" name="submit" class="registerbtn" value="update">
  </div>
  
</form>

<?php
  
// process the value  from the form  and save it to database
// check whether form is submitted or not
    if(isset($_POST["submit"]))
    { //1.getting data into variable
     echo   $full_name = $_POST['fullname'];
       echo $ctime = $_POST['ctime'];
       echo $stime = $_POST['stime'];
       echo $office = $_POST['office'];
       echo $email = $_POST['email'];
       echo $pass = $_POST['pass'];
       echo $mob = $_POST['mobile'];  
       $id = $_POST['id'];
       // encrypt pass 

       //2.inserting into database

      $sql= "UPDATE `consultant` SET `name`='$full_name',`office`='$office',`mobile`='$mob',`ctime`='$ctime',`pass`='$pass',`stime`='$stime',`email`='$email' WHERE `c_id`='$id'";
              $res2= mysqli_query($conn,$sql);
       /*echo "<h3 style = 'color:white;'>$password<h3>";
       echo "<h3 style = 'color:white;'>$full_name<h3>";
       echo "<h3 style = 'color:white;'>$username<h3>";*/
     
       //3. checking data is inserted or not
       if($res2){
           $_SESSION['update']= "<div style='color:green;'> Data updateded successfully</div>";         //creating session variable
           // redirecting page
           header("location:".SITEURL.'myinfo.php'."?user=$user");
           //echo "<h3 style = 'color:white;'>database updated<h3>";
       }
    else{
        $_SESSION['update']= "Failed to update data";         //creating session variable
        // redirecting page
        header("location:".SITEURL.'myinfo.php'."?user=$user");
        //echo "<h3 style = 'color:white;'>database not updated<h3>";
    }
    
}

    

?>
<?php
include_once './includes/footer1.php';
?>
</body>
</html>



