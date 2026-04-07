<?php 
include_once './includes/header1.php';
include '../Db_Connection/db_spacece.php'; ?>
<?php error_reporting(0); 

 $ref = '';
if(isset($_SESSION['current_user_email'])){
    $email = $_GET['current_user_email'];
    $ref= $_SESSION['current_user_name'];
} else{
	header('location:../spacecce_auth/login.php');
	exit();
}
$cat = $_GET['category']; ?>
<html>
    <head>
        <title>Appointment-HOME PAGE</title>
        <link rel="stylesheet"  href="css/admin.css">
    </head>
    <body>
        <! ... menu section starts...>
        <div class="menu text-center" style="background-color:orange;text-align:right;height:50px;">
            <div class="wrapper">
                <ul>
                    <li><a href="index2.php">HOME</a></li>
                    <li><a href="manage_paediatric.php">CONSULTANT PAGE</a></li>
                    <li><a href="showmyappointment.php">SHOW MY APPOINTMENT</a></li>
                </ul>
            </div>
        </div>
        <!... menu section ends....>

        
        <! ... main section starts...>
        <div class="main-content text-centre" style="background-color: #c8d6e5;">
            <div class="wrapper ">
                <h2 > CONSULTANT DETAIL</h2>
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
                <a href="<?php echo SITEURL;?>chatbot/room.php?roomname=global1" class="btn-primary">CHAT GLOBAL</a>
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
                        <th>ACTION:</th>
                       
                    </tr>
                    <?php
                    // schanges
                    $sql = "SELECT * FROM `login` WHERE `username`= '$ref'";
                    $res2 = mysqli_query($conn,$sql);


                    //checking whether query is excuted or not
                    if($res2){
                        // count that data is there or not in database
                        $count= mysqli_num_rows($res2);
                        $sno2 =1;
                        if($count>0){
                            // we have data in database
                            while($row2 = mysqli_fetch_assoc($res2))
                            {
                                // extracting values from dATABASE

                                $user_id=$row2['UID'];
                                $user_name=$row2['username'];
                                $user_email=$row2['email'];
                                $user_mob=$row2['phone'];          

                            }}}
                                // changes
                        ?>
                    <?php
                    // showing admin added from database
                    $sql = "SELECT * FROM `consultant` WHERE `category`='$cat' order by `name` ";
                    $res = mysqli_query($conn,$sql);


                    //checking whether query is excuted or not
                    if($res){
                        // count that data is there or not in database
                        $count= mysqli_num_rows($res);
                        $sno =1;
                        if($count>0){
                            // we have data in database
                            while($row = mysqli_fetch_assoc($res))
                            {
                                // extracting values from dATABASE

                                $id=$row['c_id'];
                                $full_name=$row['name'];
                                $category=$row['category'];
                                $office_location=$row['office'];
                                $stime=$row['stime'];
                                $ctime=$row['ctime'];
                                $lang =$row['lang'];
                                $conmob = $row['mobile'];
                                $img = $row['img'];
                                $uid= rand(0,1000000);
                                

                                
                                // displaying value in table
                        ?>
                     
                        <tr>
                        <td><?php echo $sno++; ?></td>
                       <td><img src="<?php echo $img ?>" width="100" height="100"></td>
                        <td><?php echo $full_name; ?></td>
                        <td><?php echo $category; ?></td>
                        <td><?php echo $office_location; ?></td>
                        <td><?php echo $lang; ?></td>
                        <td><?php echo $ctime; ?></td>
                        <td><?php echo $stime; ?></td>
                        


                        <td>
                            <a href="<?php echo SITEURL;?>appoint.php?id=<?php echo $id;?>&ctime=<?php echo $ctime;?>&stime=<?php echo $stime;?>&name=<?php echo $full_name;?>&category=<?php echo $category;?>&conmob=<?php echo $conmob;?>&uid=<?php echo $uid;?>&user_name=<?php echo $user_name;?>&user_email=<?php echo $user_email;?>&user_mob=<?php echo $user_mob;?>" class="btn-second" style="color:black;">Book Appointment </a>
                            <br><br><br>
 <a href="<?php echo SITEURL;?>instamojo_payment/index.php?id=<?php echo $id;?>&user=<?php echo $user_name;?>" class="btn-second" style="color:black;"> Confirm Appointment </a><br>
 <?php  $sql = "SELECT * FROM `webhook` WHERE `email`= '$ref'";
                   $res2= mysqli_query($conn,$sql);
                   while($row=mysqli_fetch_assoc($res2)){
                       ?>
                    <a id="link" data-id="<?php echo $id;?>" onclick="redirectTo('<?php echo $id;?>','<?php echo $_SESSION['user_id'];?>');" onclick="redirectTo();" class="btn-second" style="color:black;background-color:yellow">Chat With Counsultants</a>
              <?php     }
                  
                  
                 ?>
                   
 
                            <br><br><br>

                        </td>
                    </tr>
                   
                    <?php
                    /*<a href="<?php echo SITEURL;?>chatbot/room.php?roomname=uid<?php echo $uid;?>" class="btn-primary">CHAT</a>*/
                   
                     }
                    }
                    }
                    ?>

                </table>     
            </div>
        </div>
       
        <?php
include_once './includes/footer1.php';
        ?>
        <!... end section ends....>
    </body>
  <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/agora-rtc-sdk@3.5.1/AgoraRTCSDK.min.js"></script>
    <script src="Agora_Web_SDK_FULL/index.js"></script> 
<script type="text/javascript">
    
    function redirectTo(id,user_id){
var id1=generateToken();
   appid=agoraAppId;
 channel ="testing";
 
var c_id=$('#link').data('id');

//var id='<?php echo $_SESSION['user_id'];  ?>';
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

</script>
</html>