<?php

include 'Config/Functions.php';
$main_logo = "../img/logo/SpacECELogo.jpg";
$module_logo = "../img/logo/Space_Tube.jpeg";
$module_name = "Space Tube";
    include '../common/header_module.php';
$Fun_call = new Functions();

$fetch_video = $Fun_call->select_order('videos', 'v_id', 'DESC');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SpacTube</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script defer src="https://friconix.com/cdn/friconix.js"> </script>
    <link rel="stylesheet" href="Stylesheet/stylesheet.css">
    <img align="left"  src="Space_ECE_logo.png" style="width: 60px; height: auto ">
    <h5 style="padding:12px;">&nbspSPACE For ECE</h5>

    <br><br>
    <style>
.topright {
  position: absolute;
  top: 8px;
  right: 16px;
  font-size: 18px;
}
<?php
       include 'Stylesheet/stylesheet.css'; 
       ?>
</style>
</head>
<body style="background-color:#ffffff">
<div class="container">
    <!-- <div class="container" style="background-color: white">
        <ul class="nav justify-content-center background-color-white" >
            <li class="nav-item">
                <h1 style="color: orange; background-color: white">SpacTube</h1>
            </li>
        </ul>
    </div> -->

    <div class="topright" >
            <!-- <a href="logout.php"> -->
                <button onclick="window.open('logout.php', '_self')" type="button" style="background-color:black;color:white;border-radius:10px;">Logout</button>
            <!-- </a> -->
            <button onclick="window.open('https:/www.instamojo.com/@spacece/l3a3b190992504d639f4fb6fc9bfc40fe/', '_self')" type="button" style="color:white; background-color:black;border-radius: 10px;">Subscribe</button>
            <script src="https://js.instamojo.com/v1/button.js"></script>
            <!-- <a href="user.php">
                <button type="button">Upload Video</button>
            </a>
            <a href="user1.php">
                <button type="button">Remove Video</button>
            </a> -->
    </div>

    <div class="container">
            <?php include 'menu.php'; ?>
        </div>
   
    <div class="container">
            
        <div class="ins-box">
            <ul class="nav justify-content-center bg-dark">
                <li class="nav-item">
                    <div class="nav-link heading">Remove Video</div>
                </li>
            </ul>
            <br>
            <form method="post" id="video-ins" action="">
                <div class="form-group col-sm-12 mb-0">
                    <form>
                   <b> Video to be removed:</b>
                    <select name ="remove">
                        <option class=" col-sm-4" disabled selected>-- Select Video id --</option>
                        <?php
                           $conn=include('../Db_Connection/db_spaceTube.php'); 
                           
                             // Using database connection file here
                           //  $conn = new mysqli('localhost', 'root', '', 'spactube');

                            $records = mysqli_query($conn, "SELECT `v_id`,`title` From `videos` ORDER BY `v_id`");  // Use select query here 
                            
                            
                            while($data = mysqli_fetch_array($records))
                            {
                                var_dump($data);
                                echo "<option value='". $data['v_id'] ."'>" .$data['title'] ."</option>";  // displaying data in option menu
                            }	
                        ?>  
                    </select>
                    </form>
                    <div class="centre">
                        <br><br>
                        <input type="submit" name="submit" value="Remove" class="btn btn-outline-dark"  data-toggle="modal"
                            data-target="#exampleModalCenter" style="background-color:black ;border-radius:10px;color:white;">
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
    

    <?php

include '../Db_Connection/db_spaceTube.php'; 
        

        if(isset($_POST['submit']))
        {
            $id = $_POST['remove'];
            
            $removequery = "DELETE FROM `videos` WHERE `v_id` = $id ";

            $res = mysqli_query($mysqli, $removequery);
            if($res)
            {
                ?>
                <script>alert("Video removed succesfully!");</script>
                <?php
            }
            else {
                ?>
                <script>alert("Video not removed!");</script>
                <?php

            }

            header('location: home.php');
                exit();
        }

    ?>
    
    
    <div class="all-v-btn btn btn-outline-dark">
        <a href="home.php"><i class="fi-xwluxl-gear-wide fi-2x fi-flip-h"></i></a>
    </div>
    
    <?php include 'footer.php' ?>

</body>
</html>
