
<?php // include('indexDB.php');
?>
<?php error_reporting(0); 

define('DB_HOST_NAME', 'localhost');
define('DB_USER_NAME', 'root');
define('DB_USER_PASSWORD', '');
define('DB_USER_DATABASE', 'spaceece');
$conn1 = new mysqli(DB_HOST_NAME, DB_USER_NAME, DB_USER_PASSWORD, DB_USER_DATABASE);

if ($conn1) {
    
    
} else {
    die("Connection failed: " . $conn->connect_error);
}
$ref='';
$_SESSION['current_user_email']='krishnathorat007@gmail.com';
$_SESSION['current_user_name']='Krishna Thorat';
if(isset($_SESSION['current_user_email'])){
    $email = $_SESSION['current_user_email'];
    $ref= $_SESSION['current_user_name'];

    
    // $sql="INSERT INTO agora_call(user_id,consult_id,channel_name,token) VALUES ('$user_id','$consult_id','$channel_name','$token')";
    // $result = mysqli_query($conn, $sql);
    
}else{
    header('location:../spacece_auth/login.php');
    exit();
}


//session_start();
 ?>
<html>
    <head>
        <title>appointment-HOME PAGE</title>
        <link rel="stylesheet"  href="css/admin.css">
    </head>
    <body>

        <! ... menu section starts...>
        <div class="menu text-center" style="background-color:orange;">
<!-- <img src="img/space.jpg" alt="" style="width:6%; "> -->
            <div class="wrapper" >
                <ul>
                    <li><a href="index2.php">HOME</a></li>
                    <li><a href="alldoc.php">CONSULTANT PAGE</a></li>
                    <li><a href="showmyappointment.php">SHOW MY APPOINTMENT</a></li>
                </ul>
            </div>
        </div>
        <!... menu section ends....>

        
        <! ... main section starts...>
        <div class="main-content text-centre" style="background: linear-gradient(to bottom right, #ffcc99 10%, #ffffff 100%);">
            <div class="wrapper ">
                <b><center><h2 > CONSULTANT DETAIL</h2></center></b>
                <br>
                <?php
                if(isset($_SESSION['add'])){
                    echo  $_SESSION['add']; // displaying session add
                    unset($_SESSION['add']); // removing session  add
                }
                ?>
                 <?php
                if(isset($_SESSION['delete'])){
                    echo  $_SESSION['delete']; // displaying session delete
                    unset($_SESSION['delete']); // removing session  delete
                }

                ?>
                <?php
                if(isset($_SESSION['appointment'])){
                    echo  $_SESSION['appointment']; // displaying session update
                    unset($_SESSION['appointment']); // removing session  update
                }
                
                echo "<br>";
                echo "<br>";

                ?>


                 <!.... BUTTON TO ADD consultant...>
                <a href="./chatbot/room.php?roomname=global1" class="btn-primary" style="color:black;background-color:orange;float:right;">CHAT GLOBAL</a><br>
                 <br>
                 <br>
                 
                <table class="tb-full">
                    <tr>
                        <th>S.NO.:</th>
                        <th>IMAGE:</th>
                        <th>FULL NAME:</th>
                        <th>CATEGORY:</th>
                        <th>OFFICE:</th>
                        <th>LANGUAGE:</th>
                        <th>TIME(from):</th>
                        <th>TIME(to):</th>
                        <th> Consultant Fee:</th>
                        <th>From(Day):</th>
                        <th>To(Day):</th>
                        <th>ACTION:</th>
                        
                    </tr>
                    <?php
       // $sql1= "SELECT DISTINCT users.u_id,users.u_email,users.u_image,consultant.c_office,consultant.c_from_time,consultant.c_to_time,consultant.c_language,consultant.c_fee,consultant.c_available_from,consultant.c_available_to,consultant.c_qualification,consultant_category.cat_name FROM `consultant_category` JOIN `consultant` JOIN users WHERE users.u_id = consultant.u_id AND users.u_type='consultant' and consultant.c_category=consultant_category.cat_id";
                   // $user_id; 
                    // schanges
//                     $sql = "SELECT * FROM `login` WHERE `username`= '$ref'";
//                     $res2 = mysqli_query($conn,$sql);

//                     //checking whether query is excuted or not
//                     if($res2){
                       
//                         // count that data is there or not in database
//                         $count= mysqli_num_rows($res2);
//                         $sno2 =1;
//                         if($count>0){
//                             // we have data in database
//                             while($row2 = mysqli_fetch_assoc($res2))
//                             {
//                                 // extracting values from dATABASE
// //var_dump($row2);
//                                 $_SESSION['user_id']=$row2['UID'];
//                                 $user_id=$row2['UID'];
//                                 $user_name=$row2['username'];
//                                 $user_email=$row2['email'];
//                                 $user_mob=$row2['phone'];          

//                             }}}
                                // changes
                        ?>
                    <?php
                  $sql1="SELECT DISTINCT users.u_id AS u_id,users.u_name AS u_name,users.u_email as u_email,
                  users.u_image AS u_image ,users.u_mob As mobile,
              consultant.c_office AS c_office,consultant.c_from_time As c_from_time, consultant.c_to_time As c_to_time , 
              consultant.c_language AS c_language, consultant.c_fee AS c_fee ,consultant.c_available_from As c_available_from,
              consultant.c_available_to AS c_available_to ,consultant.c_qualification AS c_qualification ,
              consultant_category.cat_name AS cat_name FROM consultant_category JOIN consultant JOIN users
              WHERE users.u_id = consultant.u_id 
              AND consultant.c_category=consultant_category.cat_id AND users.u_type='consultant'";
              
                //$sql = "SELECT * FROM `consultant` ";
                  $res = mysqli_query($conn1,$sql1);
             // var_dump( $resuser);
                    if($res){
                       // var_dump($sql);
                        // count that data is there or not in database
                        $count= mysqli_num_rows($res);
                        $sno =1;
                        if($count>0){
                            // we have data in database
                            while($row = mysqli_fetch_assoc($res))
                            { //var_dump($row);
                                // extracting values from dA
                                
                                $id=$row['u_id'];
                                $full_name=$row['u_name'];
                                $category=$row['cat_name'];
                                $office_location=$row['c_office'];
                                $stime=$row['c_from_time'];
                                $ctime=$row['c_to_time'];
                                $lang=$row['c_language'];
                                $conmob=$row['mobile'];
                                $img = $row['u_image'];
                                $u_email=$row['u_email'];
                                $fee=$row['c_fee'];
                                $row["c_available_from"];
                                $avail = $row['c_available_to'];
                                $quali=$row['c_qualification'];?>
                                <tr>
                                <td><?php echo $sno++; ?></td>
                               <td><img src="<?php echo $img ?>" width="100" height="100"></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $category; ?></td>
                                <td><?php echo $office_location; ?></td>
                                <td><?php echo $lang; ?></td>
                                <td><?php echo $ctime; ?></td>
                                <td><?php echo $stime; ?></td>
                                <td><?php echo $u_email; ?></td>
                                <td><?php echo $fee; ?></td>
                                <td><?php echo $avail; ?></td>
                                <td><?php echo $quali; ?></td>
        
                                <td>
                                    <a href="<?php echo SITEURL;?>appoint.php?id=<?php echo $id;?>&ctime=<?php echo $ctime;?>&stime=<?php echo $stime;?>&name=<?php echo $full_name;?>&category=<?php echo $category;?>&conmob=<?php echo $conmob;?>&uid=<?php echo $uid;?>&user_name=<?php echo $user_name;?>&user_email=<?php echo $user_email;?>&user_mob=<?php echo $user_mob;?>" class="btn-second" style="color:black;background-color:lightgreen">Book Appointment </a>
                                    <br><br>
                       <?php 
                            }       
                        ?>
                     
                       

 <a href="<?php echo SITEURL;?>instamojo_payment/index.php?id=<?php echo $id;?>&user=<?php echo $user_name;?>" class="btn-second" style="color:black;background-color:pink"> Confirm Appointment </a><br><br>
  <?php  $sql = "SELECT * FROM `webhook` WHERE purpose='Consultant App' AND email='".$_SESSION['current_user_email']."' ";

                   $res2  = mysqli_query($conn,$sql);
                   $row=mysqli_fetch_assoc($res2);
                   $count=mysqli_num_rows($res2);
                  
                   if($count >0){
//echo $_SESSION['user_id'];
                   //    echo $id;
                    ?>
                    <a id="link" data-id="<?php echo $id;?>" onclick="redirectTo('<?php echo $id;?>','<?php echo $_SESSION['user_id'];?>');" class="btn-second" style="color:black;background-color:yellow"> Call Counsultants</a>
                    <br><br>
                    <a id="link" data-id="<?php echo $id;?>"  class="btn-second" onclick="createall()" style="color:black;background-color:yellow"> Schedule call</a>
                    <?php
                   }
  ?>
                            <br><br><br>

                        </td>
                    </tr>
                   
                    <?php
                    /*<a href="<?php echo SITEURL;?>chatbot/room.php?roomname=uid<?php echo $uid;?>" class="btn-primary">CHAT</a>*/
                     }
                    }
                   
                   // echo $sql;
                    ?>

                </table>     
            </div>

            
<?php
// $consult_id=$_POST['consult_id'];
// $user_id=$_POST['user_id'];
// $channel_name=$user_id.$consult_id;
// $appID = "464ff3e49fb3409494c0956edcec52e7";
// $appCertificate = "21f542eedcde43a38f6c292abaa8c4c2";
// $channelName =$user_id.$consult_id;
// $uid = 0;
// $uidStr = $user_id;
// $role = RtcTokenBuilder::RoleAttendee;
// $expireTimeInSeconds = 3600;
// $currentTimestamp = (new DateTime("now", new DateTimeZone('UTC')))->getTimestamp();
// $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

// $token = RtcTokenBuilder::buildTokenWithUid($appID, $appCertificate, $channelName, $uid, $role, $privilegeExpiredTs);

?>
            
        </div>
        <!... main section ends....>
        <! ... end section starts...>
         <div class="footer text-centre" style="background-color:orange">
            <div class="wrapper" >
                 <p class="text-center" >DEVELOPED BY:<a href="#">yashasvi pundeer</a></p>
            </div>
         </div>
        <!... end section ends....>
    </body>
        <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/agora-rtc-sdk@3.5.1/AgoraRTCSDK.min.js"></script>
    <script src="Agora_Web_SDK_FULL/index.js"></script> 
<script type="text/javascript">
 
    
function redirectTo(id,user_id){
var id1=generateToken();
  //  alert(encodeURIComponent(uriComponent);(id));
   appid=agoraAppId;
 channel ="testing";
 //token="0060485c1232ca7491e9ada47ae96da3160IAAw2qjO8uvCZCP9l4Qpz22rUHon7W13zhOb7OnlZc3ww/tD/hgAAAAAEACkCrtyPxSKYQEAAQA+FIph";
//alert(user_id);
var c_id=$('#link').data('id');

//var id='<?php /// echo $_SESSION['user_id'];  ?>';
var url = window.location.href;
var regex = new RegExp('/[^/]*$');
var linkfull=url.replace(regex, '/');
var d = new Date(); //without params it defaults to "now"

var time=+d;

 var link=linkfull+"Agora_Web_SDK_Full/index.html?id="+encodeURIComponent(id1)+"&appId="+appid+"&channel="+channel+"&id="+id+"&user_id="+user_id;
 $.ajax({
    url:"video.php",method:"POST",
    data:{
        link:link,
        c_id:c_id,
        video:1,
        time:time 
    },
    success:function(data){
        console.log(data);
        alert(data);
    }
 })

 window.location.href="Agora_Web_SDK_Full/index.html?id="+encodeURIComponent(id1)+"&appId="+appid+"&channel="+channel+"&id="+id+"&user_id="+user_id;  
} 
function createall(){
    alert("hello");
}  

</script>

</html>