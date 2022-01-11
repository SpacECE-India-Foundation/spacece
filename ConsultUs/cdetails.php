<?php
 session_start();
// if(empty($_SESSION['current_user_email'])){
//     header('location:../spacece_auth/login.php');
//     exit();
//   }
include_once './header_local.php';
include_once '../common/header_module.php';
// include_once '../common/banner.php';
include('indexDB.php');
include("./php/src/RtcTokenBuilder.php");
include("./php/src/RtmTokenBuilder.php");
error_reporting(0);
$ref = $_GET['user'];
$cat = $_GET['category'];
//echo $cat;
define('DB_HOST_NAME', '3.109.14.4');
define('DB_USER_NAME', 'ostechnix');
define('DB_USER_PASSWORD', 'Password123#@!');
define('DB_USER_DATABASE', 'spaceece');
date_default_timezone_set("Asia/Calcutta"); 
$conn1 = new mysqli(DB_HOST_NAME, DB_USER_NAME, DB_USER_PASSWORD, DB_USER_DATABASE);


// $sql="SELECT * FROM users WHERE u_email='$email'";
// $res = mysqli_query($conn1, $sql);



// if ($res) {
   
//     $count = mysqli_num_rows($res);
//     $sno = 1;
//     if ($count > 0) {
      
//         while ($row = mysqli_fetch_assoc($res)) {
//             $u_mob=$row['u_mob'];
//             $u_email=$row['u_email'];
       
//         }
//     }
// }


?>
 
  
  <link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css"  rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css" integrity="sha256-SMGbWcp5wJOVXYlZJyAXqoVWaE/vgFA5xfrH3i/jVw0=" crossorigin="anonymous" />

<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">

<div class="main-content text-centre" style="background: linear-gradient(to bottom right, #ffcc99 0%, #ffffff 100%);">
    <div class="wrapper ">
        <br><br><br><br><br>
        <h2>
            <center><u> CONSULTANT DETAIL</u></center>
        </h2>
        <br>
        <!.... BUTTON TO ADD consultant...>
        <a class="btn btn-sm" style="background-color: orange;" href="showmyappointment.php">SHOW MY APPOINTMENT</a>
            <a href="./chatbot/room.php?roomname=global1" class=" btn btn-sm" style="color:black;background-color:orange;float:right;">CHAT GLOBAL</a><br><br>
            <br>
            <br>
            <table class=" table table-striped table-hover  tb-full">
                <tr>
                    <th>S.NO.:</th>
                    <th>IMAGE:</th>
                    <th>FULL NAME:</th>
                    <th>CATEGORY:</th>
                    <th>OFFICE:</th>
                    <th>LANGUAGE:</th>
                    <th>Available from(Time):</th>
                    <th>Available to(Time):</th>
                    <th>Consultant fee:</tho>
                    <th>Available from(day):</th>
                    <th>Available To(day):</th>
                    <th>Qualification:</th>
                    <th>Action:</th>
                </tr>
                <?php
             
                // showing admin added from database
                if ($cat == "all") {
                    $sql="SELECT DISTINCT users.u_id AS u_id,users.u_name AS u_name,
                  users.u_image AS u_image ,users.u_mob AS u_mob,
              consultant.c_office AS c_office,consultant.c_from_time As c_from_time, consultant.c_to_time As c_to_time , 
              consultant.c_language AS c_language, consultant.c_fee AS c_fee ,consultant.c_available_from As c_available_from,
              consultant.c_available_to AS c_available_to ,consultant.c_qualification AS c_qualification ,
              consultant_category.cat_name AS cat_name FROM consultant_category JOIN consultant JOIN users
              WHERE users.u_id = consultant.u_id 
              AND consultant.c_category=consultant_category.cat_id AND users.u_type='consultant'";
                    $res = mysqli_query($conn1, $sql);


                    //checking whether query is excuted or not
                   
                        // count that data is there or not in database
                        $count = mysqli_num_rows($res);
                    
                        if ($count > 0) {
                            // we have data in database
                            while ($row = mysqli_fetch_assoc($res)) {
                                // extracting values from dATABASE
                               
                                $app_id=rand(0000000,9999999);
                        ?>
                        <tr>
                        <td><?php echo $sno++; ?></td>
                       <td><img src="<?php echo "../img/users/". $row['u_image']; ?>" width="100" height="100"></td>
                        <td><?php echo $row['u_name']; ?></td>
                        <td><?php echo $row['cat_name']; ?></td>
                        <td><?php echo $row['c_office']; ?></td>
                        <td><?php echo $row['c_language']; ?></td>
                        <td><?php echo $row['c_from_time']; ?></td>
                        <td><?php echo $row['c_to_time']; ?></td>
                        <td><?php echo $row['c_fee']; ?></td>
                        <td><?php echo $row["c_available_from"]; ?></td>

                        <td><?php echo $row['c_available_to']; ?></td>
                        
                       
                        <td><?php echo $row['c_qualification']; ?></td>

                        <td>
                        <a class="btn btn-secondary" href="./appoint.php?cid=<?php echo $row['u_id']; ?>&b_id=<?php echo $app_id; ?>&cat_name=<?php echo $row['cat_name']; ?>&con_name=<?php echo $row['u_name']; ?>" >Book Appointment </a>
                        <?php

                        if(isset($_SESSION['current_user_id'])){

                        
                        $email=$_SESSION['current_user_email'];
                        $sql="SELECT * FROM `webhook` WHERE email='$email'";
                        $user_id=$_SESSION['current_user_id'];
                        $res2  = mysqli_query($conn,$sql);
                        $row2=mysqli_fetch_assoc($res2);
                        $count=mysqli_num_rows($res2);
                       


                        if($count >0){
                             //India time (GMT+5:30)

                            $user_name=substr($_SESSION['current_user_name'],0,4);
                            $con_name=substr($row['u_name'],0,4);
                            $consult_id=$row['u_id'];
                        
                            $user_id=$_SESSION['current_user_id'];
                           
                            $channel_name=$user_id.$consult_id;
                           
                            $appID = "464ff3e49fb3409494c0956edcec52e7";
                            $appCertificate = "21f542eedcde43a38f6c292abaa8c4c2";
                            $channelName =$user_name.$consult_id;
                            $uid = 0;
                            $uidStr = $user_id;
                            $role = RtcTokenBuilder::RoleAttendee;
                            $expireTimeInSeconds = 3600;
                            $currentTimestamp = (new DateTime("now", new DateTimeZone('UTC')))->getTimestamp();
                            $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;
                            
                           $time= date('Y-m-d H:i:s');

                            // $sql="SELECT * from agora_call where user_id='$user_id' and consult_id='$consult_id' ORDER BY id DESC";
                            // $result = mysqli_query($conn, $sql);
                            // $row1=mysqli_fetch_assoc($result);
                            // $token=$row1['token'];
                            // $channelname=$row1['channel_name'];
                            $token = RtcTokenBuilder::buildTokenWithUid($appID, $appCertificate, $channelName, $uid, $role, $privilegeExpiredTs);
                                ?>
                        <a id="link" class=" btn btn-secondary btn-sm" data-id="<?php echo $consult_id;?>" onclick="redirectTo('<?php echo $consult_id;?>','<?php echo $user_id;?>','<?php echo $token;?>','<?php echo $appID;?>','<?php echo $channelName;?>','<?php echo $time; ?>');" class="btn-second" style="color:black;background-color:yellow"> Call Counsultants</a>
                       
                        <a id="link1" class=" btn btn-secondary btn-sm" data-id="<?php echo $consult_id;?>" onclick="scheduleredirectTo('<?php echo $consult_id;?>','<?php echo $user_id;?>','<?php echo $token;?>','<?php echo $appID;?>','<?php echo $channelName;?>');" class="btn-second" data-bs-toggle="modal" data-bs-target="#SheduleleModal" style="color:black;background-color:yellow">Schedule call</a>  
                           
                           <?php 
                        }
                       
                                /*<a href="<?php echo SITEURL;?>chatbot/room.php?roomname=uid<?php echo $uid;?>" class="btn-primary">CHAT</a>*/

                            }
                        }
                        }else{
                            ?>
                            <tr><td><?php   echo "No data Found";  ?></td></tr>
                                                <?php
                        }
                    }
                 else {
                    ?>

                    <?php

                       
                    // showing admin added from database

                    $sql = "SELECT DISTINCT users.u_id AS u_id,users.u_name AS u_name,
                    users.u_image AS u_image ,users.u_mob AS u_mob,
                consultant.c_office AS c_office,consultant.c_from_time As c_from_time, consultant.c_to_time As c_to_time , 
                consultant.c_language AS c_language, consultant.c_fee AS c_fee ,consultant.c_available_from As c_available_from,
                consultant.c_available_to AS c_available_to ,consultant.c_qualification AS c_qualification ,
                consultant_category.cat_name AS cat_name FROM consultant_category JOIN consultant JOIN users
                WHERE users.u_id = consultant.u_id AND  consultant_category.cat_name='$cat'
                AND consultant.c_category=consultant_category.cat_id AND users.u_type='consultant' ";
           
                    $res = mysqli_query($conn1, $sql);


                    //checking whether query is excuted or not
                    if ($res) {
                        // count that data is there or not in database
                        $count = mysqli_num_rows($res);
                        $sno = 1;
                        if ($count > 0) {
                            // we have data in database
                            while ($row = mysqli_fetch_assoc($res)) {
                               $app_id=rand(0000000,9999999);

                            ?>
                              <tr>
                        <td><?php echo $sno++; ?></td>
                       <td><img src="<?php echo $row['u_image']; ?>" width="100" height="100"></td>
                        <td><?php echo $row['u_name']; ?></td>
                        <td><?php echo $row['cat_name']; ?></td>
                        <td><?php echo $row['c_office']; ?></td>
                        <td><?php echo $row['c_language']; ?></td>
                        <td><?php echo $row['c_from_time']; ?></td>
                        <td><?php echo $row['c_to_time']; ?></td>
                        <td><?php echo $row['c_fee']; ?></td>
                        <td><?php echo $row["c_available_from"]; ?></td>

                        <td><?php echo $row['c_available_to']; ?></td>
                        
                       
                        <td><?php echo $row['c_qualification']; ?></td>

                        <td>
                        <a class="btn btn-secondary" href="./appoint.php?cid=<?php echo $row['u_id']; ?>&b_id=<?php echo $app_id; ?>&cat_name=<?php echo $row['cat_name']; ?>&con_name=<?php echo $row['u_name']; ?>" >Book Appointment </a>

                        <?php
                        if(isset($_SESSION['current_user_id'])){

                        
                            $email=$_SESSION['current_user_email'];
                            $sql="SELECT * FROM `webhook` WHERE email='$email'";
                            $user_id=$_SESSION['current_user_id'];
                            $res2  = mysqli_query($conn,$sql);
                            $row2=mysqli_fetch_assoc($res2);
                            $count=mysqli_num_rows($res2);
                           
    
    
                            if($count >0){
                                 //India time (GMT+5:30)
    
                                $user_name=substr($_SESSION['current_user_name'],0,4);
                                $con_name=substr($row['u_name'],0,4);
                                $consult_id=$row['u_id'];
                            
                                $user_id=$_SESSION['current_user_id'];
                               
                                $channel_name=$user_id.$consult_id;
                               
                                $appID = "464ff3e49fb3409494c0956edcec52e7";
                                $appCertificate = "21f542eedcde43a38f6c292abaa8c4c2";
                                $channelName =$user_name.$consult_id;
                                $uid = 0;
                                $uidStr = $user_id;
                                $role = RtcTokenBuilder::RoleAttendee;
                                $expireTimeInSeconds = 3600;
                                $currentTimestamp = (new DateTime("now", new DateTimeZone('UTC')))->getTimestamp();
                                $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;
                                
                               $time= date('Y-m-d H:i:s');
    
                                // $sql="SELECT * from agora_call where user_id='$user_id' and consult_id='$consult_id' ORDER BY id DESC";
                                // $result = mysqli_query($conn, $sql);
                                // $row1=mysqli_fetch_assoc($result);
                                // $token=$row1['token'];
                                // $channelname=$row1['channel_name'];
                                $token = RtcTokenBuilder::buildTokenWithUid($appID, $appCertificate, $channelName, $uid, $role, $privilegeExpiredTs);
                                    ?>
                            <a id="link" class=" btn btn-secondary btn-sm" data-id="<?php echo $consult_id;?>" onclick="redirectTo('<?php echo $consult_id;?>','<?php echo $user_id;?>','<?php echo $token;?>','<?php echo $appID;?>','<?php echo $channelName;?>','<?php echo $time; ?>');" class="btn-second" style="color:black;background-color:yellow"> Call Counsultants</a>
                             
                            <a id="link1" class=" btn btn-secondary btn-sm" data-id="<?php echo $consult_id;?>" onclick="scheduleredirectTo('<?php echo $consult_id;?>','<?php echo $user_id;?>','<?php echo $token;?>','<?php echo $appID;?>','<?php echo $channelName;?>','<?php echo $time; ?>');" class="btn-second" data-bs-toggle="modal" data-bs-target="#SheduleleModal" style="color:black;background-color:yellow">Schedule call</a>
                             <?php 
                            }
                           
                                    /*<a href="<?php echo SITEURL;?>chatbot/room.php?roomname=uid<?php echo $uid;?>" class="btn-primary">CHAT</a>*/
    
                                }
                        ?>

                  

                <?php
                                /*<a href="<?php echo SITEURL;?>chatbot/room.php?roomname=uid<?php echo $uid;?>" class="btn-primary">CHAT</a>*/

                            }
                        }else{
                            ?>
        <tr><td><?php   echo "No data Found";  ?></td></tr>
                            <?php
                    }
                      
                    }
                }
                ?>

            </table>
            
    </div>
</div>
<div class="modal fade" id="SheduleleModal" tabindex="-1" aria-labelledby="SheduleleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="SheduleleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" id="schedule" name="schedule">

      <div class="container">
   <div class="row">
      <div class='col-sm-6'>
      <div class="input-group">
            <div class='input-group date' id='datetimepicker1'>
               <input type='text' class="form-control" id="date1" name="date1">
               <span class="input-group-addon">
               <span class="glyphicon glyphicon-calendar"></span>
               </span>
            </div>
        
      </div>
      
   </div>
</div>
</div>

<input type="submit" id="submit">
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<?php
// $module_logo = "../img/logo/ConsultUs.jpeg";
include_once '../common/footer_module.php';
          

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script> 
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/agora-rtc-sdk@3.5.1/AgoraRTCSDK.min.js"></script>
<script type="text/javascript">
         $(function () {
             $('#datetimepicker1').datetimepicker({
                format: "YYYY-MM-DD HH:mm ",
                minDate: moment()
             });
         });
      </script>




<script type="text/javascript">
 
    
function redirectTo(id,user_id,token,appId,channel_name,time){

var c_id=id;

//var id='<?php /// echo $_SESSION['user_id'];  ?>';
var url = window.location.href;
var regex = new RegExp('/[^/]*$');
var linkfull=url.replace(regex, '/');
var time = new Date(); //without params it defaults to "now"

var c_time=+time;

 var link=linkfull+"Agora_Web_SDK_FULL/index.html?id="+token+"&appId="+appId+"&channel="+channel_name+"&id="+id+"&user_id="+user_id;
 $.ajax({
    url:"video.php",method:"POST",
    data:{
        link:link,
        c_id:c_id,
        video:1,
        time:time,
        channel_name:channel_name,
        time:time,
        token:token,
        user_id:user_id,
        c_time:c_time
        


    },
    success:function(data){
        console.log(data);
        alert(data);
    }
 })

 window.location.href="Agora_Web_SDK_FULL/index.html?id="+token+"&appId="+appId+"&channel="+channel_name+"&id="+id+"&user_id="+user_id;  
} 


function scheduleredirectTo(id,user_id,token,appId,channel_name){
    var c_id=id;

//var id='<?php /// echo $_SESSION['user_id'];  ?>';
var url = window.location.href;
var regex = new RegExp('/[^/]*$');
var linkfull=url.replace(regex, '/');
 //without params it defaults to "now"


    $('#schedule').on('submit',function(){
        var time1=$('#date1').val();
      
   time=+time1;
      
        $.ajax({
    url:"video.php",method:"POST",
    data:{
        link:link,
        c_id:c_id,
        video:1,
        time:time,
        channel_name:channel_name,
        time:time,
        token:token,
        user_id:user_id,
        c_time:c_time
        


    },
    success:function(data){
        console.log(data);
        alert(data);
    }
    })
    
    });  
}


</script>


