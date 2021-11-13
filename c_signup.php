
<?php

//index.php

//Include Configuration File
include('config.php');

$login_button = '';


if(isset($_GET["code"]))
{

 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


 if(!isset($token['error']))
 {
 
  $google_client->setAccessToken($token['access_token']);

 
  $_SESSION['access_token'] = $token['access_token'];


  $google_service = new Google_Service_Oauth2($google_client);

 
  $data = $google_service->userinfo->get();

 
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}


if(!isset($_SESSION['access_token']))
{
    ?>
  
   
    <?php
 $login_button = '<a href="'.$google_client->createAuthUrl().'">Login With Google</a>';
}

?>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title> Login using Google Account</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

 

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 
 </head>
 <body>

    <br><br><br>
  <div class="container">
   <br />
   <h2 align="center">Login using Google Account</h2>
   <br />
  
   <div class="panel panel-default">
   <tr>
         <td colspan=2>
                    <center><img src="https://i.stack.imgur.com/mGHPI.png" style="width: 150px; height:150px;"></img></center><br><br>
                </td>
            </tr>
   <?php
   if($login_button == '')
   {
    $fname=$_SESSION['user_first_name'];
    $lname=$_SESSION['user_last_name'];
    $email_=$_SESSION['user_email_address'];
 /*echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
 echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
 echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
 echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
 echo '<h3><a href="logoutg.php">Logout</h3></div>';*/
 header('Location: c_login.php' . "?user=$fname $lname&email=$email_");
   }
   else
   {
    echo '<div align="center">'.$login_button . '</div>';
   }
   ?>
   <hr>
   <h3 style="text-align: center;">-----------------------------------OR-------------------------------</h3>
   <form id="form" method="GET" action="c_login.php" >

   <h3 style="text-align: center;">Enter Your Full Name And Email</h3><br>

  <label for="fname">Full Name:</label><br>
  <input type="text" id="user" name="user"><br><br>
  <label for="lname">Email:</label><br>
  <input type="text" id="email" name="email"><br><br>
  <input type="submit" value="Submit"><br><br>

            <tr>
                <td><a href="loginuser.php">Already have an account?</a></td>
            </tr>
        </table>
        <br><br><br><br><br><br><br><br><br><br>
    </form>
   </div>
  </div>
 </body>
</html>



    </footer>
    <!--footer end-->
    <p class="font_10" style="line-height: 1.8em; text-align: center; font-size: 20px;"><span style="font-size:20px;"><span class="color_15">&copy;2021 by SpacECE INDIA FOUNDATION</span></span></p>

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