
<?php
include('indexDB.php');
$msg = "";

if (isset($_POST['submit'])) {
    $filename = $_FILES["img"]["name"];
    $tempname = $_FILES["img"]["tmp_name"];
    $folder = "img/" . $filename;

    echo $user_name = $_POST['user_name'];
    echo $fullname = $_POST['fullname'];
    echo $user_email = $_POST['user_email'];
    echo $user_mobile = $_POST['user_phone'];
    echo $user_password = $_POST['user_password'];
    echo $user_type = $_POST['user_type'];
  //  echo $user_address = $_POST['user_address'];

$to= $_POST['user_email'];
$subject = "REGISTRATION SUCCESSFULL";
$msg = "You have been successfully registered with us(with username= $user_name and email = $user_email), please login in into our website to use all features- 
1- you can book appointment with top consultants in india
2- you can take toys on rent from are toy library for your child at reasonable prices
3- you can explore different online courses ,which will help in developing the future of your child
.... and many more features.
visit today only on SPACEFORECE.COM
LINK- http://www.spaceforece.com/spacece/c_index.html;

and learn more about us on-
LINK- http://www.spaceforece.com/spacece/about.html";
$header=[
    "MIME-Version: 1.0",
    "Content-type: text/plain; charset=utf-8",
    "From : space ece",
];

$headers= implode("\r\n",$header);

    if(empty(trim($filename))){
        echo "img cannot be bank";
    }
    if(empty(trim($fullname))){
        echo "fullname cannot be bank";
    }
    if(empty(trim($user_email))){
        echo "email cannot be bank";
    }
    if(empty(trim($user_mobile))){
        echo "phone number cannot be bank or you have entered wrong number";
    }
    if(empty(trim($user_password))){
        echo "password cannot be bank";
    }
   /* if(empty(trim($user_address))){
        echo "address cannot be bank";
    }*/

    $sq = "SELECT  `username` FROM `login` WHERE `username` ='$user_name'";
    $r = mysqli_query($conn, $sq);
    if (mysqli_num_rows($r) != 0) {
        echo "Username already exists";
    } 

    else {

        $sql = "INSERT INTO `login`(`username`, `password`, `name`, `email`, `phone`,`img`) VALUES  ('$user_name','$user_password','$fullname','$user_email','$user_mobile','$filename')";
        $res = mysqli_query($conn, $sql);
if($res ){

            echo "insert done";
            // setcookie('success', 'User register successfully', time() + 30, "/");

if(mail($to,$subject,$msg,$headers)){

echo" msg send";}

else{
    echo "failed to send";
}

              header('Location: index2.php' . "?user=$user_name");
            
        
    
        if (move_uploaded_file($tempname, $folder)) {
            $msg = "Image uploaded successfully";
            echo $msg;
        } else {
            $msg = "Failed to upload image";
            echo $msg;
        }

     }
    
  
        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>USER REGISTRATION</title>
    <meta charset="UTF-8">
    <meta name="description" content="HOUSING-CO">
    <meta name="keywords" content="LERAMIZ, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="shortcut icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/animate.css" />
    <link rel="stylesheet" href="css/owl.carousel.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="Styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body>
    <!-- Page Preloder -->


    <!-- Header section -->
    <header class="header-section">
        <div class="header-top" style="position:absolute; left:80%; top:15px;">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 text-lg-right header-top-right">
                        <div class="top-social">

                            <a href="https://www.facebook.com/SpacECEIn"><i class="fa fa-facebook"></i></a>
                            <a href="https://www.instagram.com/spacece.in/"><i class="fa fa-instagram"></i></a>
                            <a href="https://t.me/joinchat/EtMJq_3BKL4zNGE1"><i class="fa fa-telegram" aria-hidden="true"></i></a>
                            <a href="https://www.linkedin.com/company/spacece-co/"><i class="fa fa-linkedin"></i></a>

                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="row">
                <div>
                    <div>

                        <div style="padding: -30px 20px; ">

                            <i class="fa fa-bars"></i>


                        </div>
                        <ul class="main-menu" style="margin-left: 60px;">
                            <img src="img/space.jpg" alt="" style="width:6%; ">
                            <li><a href="index.html" style="color:orange"><i class="fa fa-home"></i>HOME</a></li>
                            <li><a href="about.html" style="color:orange"><i class="fa fa-users"></i> ABOUT US</a></li>
                            <li><a href="contact.php" style="color:orange"><i class="fa fa-envelope" style="color:orange;"></i> CONTACT US</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header section end -->
    
    <style type="text/css">
        body {
            background-repeat: no-repeat;
            background-image: url("img/service-bg1.jpg");
            background-size: cover;
            background-attachment: fixed;
            color: white;
        }

        input[type=text],
        input[type=date],
        input[type=password] {
            border: none;
            border-bottom: 1px solid #fff;
            width: 100%;
            padding: 30px 40px;
            background: transparent;
            outline: none;
            height: 40px;
            color: #fff;
            font-size: 16px;
        }

        input[type=submit],
        input[type=reset] {
            border: none;
            outline: none;
            height: 30px;
            width: 100px;
            background-color: #fb2525;
            color: #fff;
            font-size: 20px;
            border-radius: 20px;
            align-items: center;
        }



        input[type=radio] {
            height: 20px;
            width: 50px;


        }



        select {
            background-color: #e0e0d1;
            border: none;
            color: black;
            padding: 4px 32px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
            font-weight: bold;
            border-radius: 20px;

        }

        textarea {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            background-color: #e0e0d1;
            color: black;
        }

        table {
            margin-top: -120px;
            background-color: black;
            border-collapse: collapse;
            border: 2px solid navy;

            height: 900px;
            width: 700px;


        }

        form {
            opacity: 0.7;
        }

        td {
            font-weight: bold;
        }

        span {
            color: red;
        }
    </style>
    </head>
    <!-- 0000027: Remove LOGOUT in REGISTRATION FORM -->

    <br><br><br><br><br><br><br><br><br><br><br>

    <form id="form" method="post" action="register.php" onsubmit="return validatereg()" enctype="multipart/form-data">

        <table cellpadding="7" width="50%" border="0" align="center" cellspacing="2" color="white">

            <!-- I want another button here, center to the tile-->



            <tr>
                <td colspan=2>
                    <center><img src="img/reg_icon.png" style="width: 150px; height:150px;border-radius: 50%; position:absolute;
top: 120px; left:calc(49% - 50px);"></img></center><br><br><br><br>
                </td>
            </tr>
            <tr>
                <td colspan=2>
                    <center>
                        <font size=7><b>REGISTERATION FORM</b></font>
                    </center>
                </td>
            </tr>

            <tr>
                <td>
                    <font size=5><b>USERNAME<span style="color:red;font-weight:bold">*</span></b></font>
                </td>
                <td><input type="text" name="user_name" size="300" id="uname" placeholder="Enter Unique Username">
                    <br><br>
                </td>
            </tr>
            <tr>
                <td>
                    <font size=5><b>FULLNAME<span style="color:red;font-weight:bold">*</span></b></font>
                </td>
                <td><input type="text" name="fullname" id="fname" size="30" placeholder="enter name">
                    <br><br>
                </td>
            </tr>
            <tr>
                <td>
                     <!-- bug id-0000013 -->
                    <font size=5>EMAIL<span style="color:red;font-weight:bold">*</span></font>
                </td>
                <td><input type="text" name="user_email" size="300" id="email" onblur="validateEmail(email)" placeholder="enter email">
                   <h2 id="result"></h2 <br><br>
                </td>
            </tr>
            <tr>
                <td>
                    <font size=5>PHONE NO<span style="color:red;font-weight:bold">*</span></font>
                </td>
                <!-- bug id-0000013 -->
                <td><input type="text" name="user_phone"  size="11" id="pno" onclick="validate()" minlength="10" maxlength="10" onkeyup="this.value=this.value.replace(/[^\d]/,'')" placeholder="Phone no">
                <div class="message">  <br><br>
                </td>
            </tr>
            <td>
                <font size=5>PASSWORD<span style="color:red;font-weight:bold">*</span></font>
            </td>
            <!-- 0000074 -->
            <td><input type="password" name="user_password" size="30" id="regPassword" onblur="validatePassword()" maxlength="6" placeholder="Password" autocomplete="off">
                <br><br>
                <div class="messageBox"></div>
            </td>
            </tr>

            <td>
                <font size=5>USER TYPE<span style="color:red;font-weight:bold">*</span></font>
            </td>
           
             <tr>
                <td>
                    <select name="user_type" id="type">
                    <option value="user">User</option>
                    <option value="admin">admin</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <font size=5>UPLOAD IMAGE<span style="color:red;font-weight:bold">*</span></font>
                </td>
                <td><input type="file" name="img" id="img" onchange="validateImage()">

                </td>
            </tr>
            <br>
            <tr>
                <td><input type="submit" value="Register" name="submit" style="float:center;"><br>
                    <div style="font-size:20px; color:#cc0000; margin-top:10px"></div>
                </td>
            </tr>
            <tr>
            <!-- 0000043 -->
                <td><a href="login2.php">Already have an account?</a></td>
            </tr>
        </table>
        <br><br><br><br><br><br><br><br><br><br>
    </form>


    <!--footer section-->
    <footer class="footer-section set-bg" style="background-color:black;border-collapse: collapse; border: 2px solid navy;opacity:0.7; padding:30px 30px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-widget">
                    <img src="img/logo1.png" alt="">

                    <div class="social">

                        <a href="https://www.facebook.com/SpacECEIn"><i class="fa fa-facebook"></i></a>
                        <a href="https://www.instagram.com/spacece.in/"><i class="fa fa-instagram"></i></a>
                        <a href="https://t.me/joinchat/EtMJq_3BKL4zNGE1"><i class="fa fa-telegram" aria-hidden="true"></i></a>
                        <a href="https://www.linkedin.com/company/spacece-co/"><i class="fa fa-linkedin"></i></a>

                    </div>

                </div>
                <div class="col-lg-3 col-md-6 footer-widget">
                    <p>Still delaying your child's health concerns ?</p>
                    <p>Connect with India's top doctors online</p>
                </div>
                <div class="col-lg-3 col-md-6 footer-widget">
                    <div class="contact-widget">
                        <h5 class="fw-title">
                            <center>CONTACT US</center>
                        </h5>
                        <p><i class="fa fa-map-marker"></i><a href="http://www.spacece.in/"> SPACE-ECE</a></p>
                        <p><i class="fa fa-phone"></i>+91 90963 05648</p>
                        <p><i class="fa fa-envelope"></i><a href="mailto:events@spacece.co" target="_blank" rel="noopener">contactus@spacece.co</a></p>
                        <p><i class="fa fa-clock-o"></i>Mon - Sat, 08 AM - 06 PM</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6  footer-widget">
                    <div class="newslatter-widget">
                        <h5 class="fw-title">
                            <center>NEWSLETTER</center>
                        </h5>
                        <p>Subscribe your email to get the latest news and new offer also discount</p>
                        <form class="footer-newslatter-form">
                            <input type="text" placeholder="Email address">
                            <button><i class="fa fa-send"></i></button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

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