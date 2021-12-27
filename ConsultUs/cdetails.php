<?php
include_once './header_local.php';
include_once '../common/header_module.php';
// include_once '../common/banner.php';
include('indexDB.php');
error_reporting(0);
$ref = $_GET['user'];
$cat = $_GET['category'];
//echo $cat;
define('DB_HOST_NAME', '3.109.14.4');
define('DB_USER_NAME', 'ostechnix');
define('DB_USER_PASSWORD', 'Password123#@!');
define('DB_USER_DATABASE', 'spaceece');

$conn1 = new mysqli(DB_HOST_NAME, DB_USER_NAME, DB_USER_PASSWORD, DB_USER_DATABASE);
if(isset($_SESSION['current_user_email'])){
    $email=$_SESSION['current_user_email'];
}else{
    header('location:../spacece_auth/login.php');
    exit();
}

$sql="SELECT * FROM users WHERE u_email='$email'";
$res = mysqli_query($conn1, $sql);



if ($res) {
   
    $count = mysqli_num_rows($res);
    $sno = 1;
    if ($count > 0) {
      
        while ($row = mysqli_fetch_assoc($res)) {
            $u_mob=$row['u_mob'];
            $u_email=$row['u_email'];
       
        }
    }
}


?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

<div class="main-content text-centre" style="background: linear-gradient(to bottom right, #ffcc99 0%, #ffffff 100%);">
    <div class="wrapper ">
        <br><br><br><br><br>
        <h2>
            <center><u> CONSULTANT DETAIL</u></center>
        </h2>
        <br>
        <!.... BUTTON TO ADD consultant...>
            <a href="./chatbot/room.php?roomname=global1" class="btn-primary" style="color:black;background-color:orange;float:right;">CHAT GLOBAL</a><br><br>
            <br>
            <br>

            
    </div>
</div>
<?php
// $module_logo = "../img/logo/ConsultUs.jpeg";
include_once '../common/footer_module.php';


?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>