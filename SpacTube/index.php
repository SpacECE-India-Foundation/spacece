<?php
session_start();
include 'connection.php';

require_once 'Config/Functions.php';
$Fun_call = new Functions();

$fetch_video = $Fun_call->select_order('videos', 'v_id', 'DESC');
$get_video = $Fun_call->selected_order('videos', 'filter');
// include 'Stylesheet/stylesheet.css';
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="google-signin-client_id" content="144318608772-lnmrm3l9acninha12ultd7gjslrq0tdm.apps.googleusercontent.com">
                <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>    
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SpacTube</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script defer src="https://friconix.com/cdn/friconix.js"> </script>
    <link rel="stylesheet" href="Stylesheet/stylesheet.css">
    <center>
    	<img align="left"  src="Space_ECE_logo.png" style="width: 60px; height: auto ">
    </center>
    <h5 style="padding:12px;">&nbspSPACE For ECE</h5>
    <!-- <br> -->
    <style>
       <?php
       include 'Stylesheet/stylesheet.css'; 
       ?>

.left{
    left: 0px;
}

 .box{ 
     overflow-x: scroll; 
 } 
 
</style>
</head>
<script>
                
               function logout(){
                    var auth2 = gapi.auth2.getAuthInstance();
                    auth2.signOut();  
                    jQuery.ajax({
                                url:'logout.php',
                                success:function(result){
                                        window.location.href="index.php";
                                }
                        });
                    
                }

                function onLoad(){
                       gapi.load('auth2',function (){
                              gapi.auth2.init();
                       }); 
                }
                
                function gmailLogIn(userInfo){
                        var userProfile=userInfo.getBasicProfile();
                        
                        
                        jQuery.ajax({
                                url:'login_check.php',
                                type:'post',
                                data:'user_id='+userProfile.getId()+'&name='+userProfile.getName()+'&image='+userProfile.getImageUrl()+'&email='+userProfile.getEmail(),
                                success:function(result){
                                        window.location.href="view.php";
                                }
                        });
                }
                </script>
<body style="background-color:#ffffff";>


    <div class="container-fluid">

        <div class="container"><br>
        <ul class="nav justify-content-center bg-dark" >
                <li class="nav-item">
                    <div class="nav-link heading" style="color:white;">SpacTube</div>
                </li>
            </ul><br>
                <img src="parentsimg2.jpeg" style="background-image: : center; padding-left: 25%; height: 300px; width: 800px"><br>
                        
            <div class="g-signin2" data-onsuccess="gmailLogIn" style="display: flex; justify-content: center; align-items: center; top: 30%;  padding-top: 5%; padding-left: 2%"></div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        </div>
        
                <br><br><br>
   


<!-- <div class="all-v-btn btn btn-outline-dark">
    <a href="home.php"><i class="fi-xwluxl-gear-wide fi-2x fi-flip-h"></i></a>
</div> -->


<?php include 'footer.php' ?>
                
                <!--End - Delete - Modal -->


</body>

</html>
<!-- 
<html>
        <head>
            
        </head>
        
        <body style="background-color:white">
                <?php
                // if(isset($_SESSION['USER_ID'])){
                        ?>
                        <a href="logout.php" onclick="logout()">Logout</a> -->
                        <?php
                // }else{
                        ?>
                        
                        <?php
                // }
                ?>
                
                
<!--                
        </body>
</html>
 -->
