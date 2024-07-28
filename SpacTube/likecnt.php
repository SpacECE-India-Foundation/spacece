<?php

include 'Config/Functions.php';
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
</head>
<body>
   
    <?php

        include 'connection.php';
        
        if(!empty($_GET['btn'])) 
        {
            $id = $_GET['btn'];
            $incquery = "UPDATE `videos` SET `cntlike` = `cntlike`+ 1 WHERE `v_id` = $id ";
            $res = mysqli_query($conn, $incquery);
            if($res)
            {}
            else{
                ?>
                <script> alert("Connection lost!"); </script> 
                <?php
            }
            header('location: view.php');
            exit();

        }

        if(!empty($_GET['btn1'])) 
        {
            $id = $_GET['btn1'];
            $incquery = "UPDATE `videos` SET `cntdislike` = `cntdislike`+ 1 WHERE `v_id` = $id ";
            $res = mysqli_query($conn, $incquery);
            if($res)
            {}
            else{
                ?>
                <script> alert("Connection lost!"); </script> 
                <?php
            }
            header('location: view.php');
            exit();

        }


        // if(isset($_POST['submit']))
        // {
        //     $id = $_POST['remove'];
            
            // $removequery = "DELETE FROM `videos` WHERE `v_id` = $id ";

        //     $res = mysqli_query($conn, $removequery);
        //     if($res)
        //     {
        //         
        // <!-- //         <script>alert("Video removed succesfully!");</script> -->
        //         
        //     }
        //     else {
        //         
        // <!-- //         <script>alert("Video not removed!");</script> -->
        //         

        //     }

        //     header('location: home.php');
        //         exit();
        // }

    ?>

    
</body>
</html>
