    <?php
    require_once 'Config/Functions.php';
    $Fun_call = new Functions();
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
         <?php
       include 'Stylesheet/stylesheet.css'; 
       ?>
       
.topright {
  position: absolute;
  top: 8px;
  right: 16px;
  font-size: 18px;
}
</style>
</head>

<body style="background-color:##ffffff";>

    <div class="container" style="background-color: white">
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
                <button onclick="window.open('user.php', '_self')" name = "upload" class="btn-btn"style="background-color:orange;"><h6>Upload Video</h6></button>

                <button onclick="window.open('user1.php', '_self')" name = "remove" class="btn-btn"style="background-color:orange;"><h6>Remove Video</h6></button>
            
        </div>

        <div class="container">
            <div class="ins-box" id="load_videos">
            </div>
        </div>
    </div>


    <div class="all-v-btn btn btn-outline-dark">
        <a href="view.php"><i class="fi-xwluxl-table-wide fi-2x"></i></a>
    </div>

    

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script type="text/javascript">

    $(document).ready(function (){
        $('#load_videos').load('Ajax/Load_gallery.php');

        $('#video-ins').on('submit', function(e){
            e.preventDefault();
            $video_url = $('#video_code').val().trim();
            $('#ins_status').text('');
            if($video_url != ''){
                $.ajax({
                    type: "POST",
                    url: "Ajax/Video_process.php",
                    data: { 'video_url' : encodeURIComponent($video_url) },
                    success: function (response) {
                        $json_res = JSON.parse(response);
                        if($json_res.status == 101){
                            $('#load_videos').load('Ajax/Load_gallery.php');
                            $('#ins_status').text('Successfully Video Added');
                            $("#video-ins").trigger("reset");
                        }
                        else{
                            console.log($json_res.msg);
                        }
                    }
                });
            }
            else{
                $('#ins_status').text('Please Enter Video Code');
            }
        });   
    });
    </script>

<?php include 'footer.php' ?>

</body>
</html>




