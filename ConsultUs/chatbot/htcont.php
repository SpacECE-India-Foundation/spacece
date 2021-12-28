<?php
$room = $_POST['room'];
 session_start();
  define("SITEURL",'http://3.109.14.4//consult/');  
  $servername = "3.109.14.4";
$username = "ostechnix";
$password = "Password123#@!";
// $servername = "localhost";
// $username = "root";
// $password = "";
    $dbname = "consultant_app";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
$sql= "SELECT * FROM `msg` WHERE `room`='$room' ORDER BY rtime DESC ";
// $sql="select * from msg where LIKE '%$getMesg%' ";
$res= "";
$result =mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0)
{
    while($row= mysqli_fetch_assoc($result))
    {
           echo $res = "<div class='wrapper' id='msg'>";
           if(isset($_POST['current_user_name'])){
            echo  $res = $_POST['current_user_name'];
           }else{
            echo  $res = $row['ip'];  
           }
         
           echo $res = " says <p>".$row['msg'];
          echo  $res = "</p> <span class='time-right'>".$row['rtime']."</span></div>";
    }
 
}
else{
    $res = $res."sorry";
}

?>