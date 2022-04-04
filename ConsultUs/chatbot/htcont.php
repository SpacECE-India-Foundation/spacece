<?php
$room = $_POST['room'];
 session_start();
   
  include("../../Db_Connection/indexDB.php");
$sql= "SELECT * FROM `msg` WHERE `room`='$room' ORDER BY rtime DESC ";
// $sql="select * from msg where LIKE '%$getMesg%' ";
$res= "";
$result =mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0)
{
    while($row= mysqli_fetch_assoc($result))
    {
           echo $res = "<div class='wrapper' id='msg'>";
        
             
           if(empty($row['u_name'])){
            echo  $res = $row['ip'];
           }else{
            echo  $res = $row['u_name'];
           }
         
           echo $res = " says <p>".$row['msg'];
          echo  $res = "</p> <span class='time-right'>".$row['rtime']."</span></div>";
    }
 
}
else{
    $res = $res."sorry";
}

?>