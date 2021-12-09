  <?php

    include 'Config/Functions.php';
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
        integrity="sha384s-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script defer src="https://friconix.com/cdn/friconix.js"> </script>
    <link rel="stylesheet" href="Stylesheet/stylesheet.cs">
    <img align="left"  src="Space_ECE_logo.png" style="width: 60px; height: auto ">
    <h4 style="padding:12px;">&nbspSPACE For ECE</h4>
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
    <!-- <div class="container" style="background-color: white">
        <div class="container" style="background-color: white">
            <ul class="nav justify-content-center background-color-white" >
                <li class="nav-item">
                    <h1 style="color: orange; background-color: white">SpacTube</h1>
                </li>
            </ul>
        </div> -->

        <div class="topright" >
            <a href="logout.php">
                <button type="button"style="color:white; background-color:black;border-radius: 10px;">Logout</button>
            </a>
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
            <ul class="nav justify-content-center bg-dark">
                <li class="nav-item">
                    <div class="nav-link heading">SpacTube</div>
                </li>
            </ul><br>
            <a href="view.php">
                <button name = "free" class="btn-btn"style="background-color:orange;"><h6>Go to Free Section</h6></button>
            </a>
            <a href="view1.php">
                <button name = "paid" class="btn-btn"style="background-color:orange;"><h6>Go to Paid Section</h6></button>
            </a>
            <a href="trending.php">
                <button name = "trending" class="btn-btn"style="background-color:orange;"><h6>Trending Videos</h6></button>
            </a>
            <a href="https://www.spacece.co/about-us" target="_blank">
                <button name = "about" class="btn-btn"style="background-color:orange;"><h6>About Us</h6></button>
            </a>
            <a href="http://api.whatsapp.com/send?phone=+919096305648" target="_blank">
                <button name = "contact" class="btn-btn"style="background-color:orange;"><h6>Contact Us</h6></button>
            </a>
            <!-- <a href="user.php">
                <button name = "upload" class="btn-btn"style="background-color:orange;"><h6>Upload Video</h6></button>
            </a>
            <a href="user1.php">
                <button name = "remove" class="btn-btn"style="background-color:orange;"><h6>Remove Video</h6></button>
            </a> -->
            <!-- <a href="recents.php">
                <button name = "recent" class="btn-btn"><h6>Recently Watched</h6></button>
            </a> -->
        </div>
       
        <div class="container">
            
            <div class="ins-box">
            <ul class="nav justify-content-center bg-dark">
                <li class="nav-item">
                    <div class="nav-link heading">Upload Video</div>
                </li>
            </ul>
            <br>
                <form  id="video-ins" name="video-ins" >
                    <div class="form-row justify-content-center">
                        <div class="form-group col-sm-12 col-lg-6 mb-0">
                            <input type="text" class="form-control" id="video_code" name="video_code" placeholder="Enter Youtube Video URL" >
                        </div>
                        <div class="form-group col-sm-12 col-lg-6 mb-0">
                            <input type="text" class="form-control" name="date" id="date" placeholder="Enter Video Upload Date" >
                        </div>
                        <br><br>
                        <div class="form-group col-sm-12 col-lg-6 mb-0">
                            <input type="text" class="form-control" name="title"  id="title"  placeholder="Enter Youtube Video Title">
                        </div>
                        <div class="form-group col-sm-12 col-lg-6 mb-0">
                            <input type="text" class="form-control" name="desc" id="desc" placeholder="Enter Video Desciption">
                        </div>
                        <br><br>
                        <div class="form-group col-sm-12 col-lg-6 mb-0">
                            <input type="text" class="form-control" name="length" id="length"  placeholder="Enter Video Length" >
                        </div>
			<div class="form-group col-sm-12 col-lg-6 mb-0">
                            <input type="text" class="form-control" name="filter"  id="filter" placeholder="Enter Video Filter" >
                        </div>
                        <div class="form-group col-sm-12 mb-0">
                            <br>
                            <p>
                                Select Status: 
                                <select name="status" >
                                <option value="">Select...</option>
                                <option value="free">Free</option>
                                <option value="created">Created</option>
                                </select>
                            </p>
                        </div>
                        <div class="form-group col-sm-12 col-lg-2 mb-0">
                            <br><br>
                            <input type="submit" name="submit" value="Upload" class="btn btn-outline-dark" data-toggle="modal"
                                data-target="#exampleModalCenter" style="background-color:black ;border-radius:10px;color:white;">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php

            include 'connection.php';
            

            if(isset($_POST['submit']))
            {
///$url = $_POST['video_code'];
                // Here is a sample of the URLs this regex matches: (there can be more content after the given URL that will be ignored)

                // http://youtu.be/dQw4w9WgXcQ
                // http://www.youtube.com/embed/dQw4w9WgXcQ
                // http://www.youtube.com/watch?v=dQw4w9WgXcQ
                // http://www.youtube.com/?v=dQw4w9WgXcQ
                // http://www.youtube.com/v/dQw4w9WgXcQ
                // http://www.youtube.com/e/dQw4w9WgXcQ
                // http://www.youtube.com/user/username#p/u/11/dQw4w9WgXcQ
                // http://www.youtube.com/sandalsResorts#p/c/54B8C800269D7C1B/0/dQw4w9WgXcQ
                // http://www.youtube.com/watch?feature=player_embedded&v=dQw4w9WgXcQ
                // http://www.youtube.com/?feature=player_embedded&v=dQw4w9WgXcQ

                // It also works on the youtube-nocookie.com URL with the same above options.
                // It will also pull the ID from the URL in an embed code (both iframe and object tags)

                // preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
                // $video_url = $match[1];
                // // echo $video_url;
                // $selectquery = "SELECT MAX(`v_id`) AS max_id FROM `videos` ";
                // $rowSQL = mysqli_query($conn, $selectquery); 
                // $row = mysqli_fetch_assoc($rowSQL); 
                // $video_id = $row['max_id'] + 1; 
                // $video_date = $_POST['date'];
                // // echo $video_date;
                
                // $video_unique = rand(1000000000000000, 10000000000000000);
                // // echo $video_unique;
                // $video_status = $_POST['status'];
                // // echo $video_status;
                // $video_title = $_POST['title'];
                // $video_desc = $_POST['desc'];
                // $video_length = $_POST['length'];
                // $video_filter = $_POST['filter'];

                // $insertquery = "INSERT into `videos`(`v_id`, `v_url`, `v_date`, `v_uni_no`, `status`, `filter`, `title`, `desc`, `length`, `cntlike`, `cntdislike`, `views`, `cntcomment`) values ('$video_id', '$url', '$video_date', '$video_unique', '$video_status', '$video_filter', '$video_title', '$video_desc', '$video_length',0,0,0,0)";
                
                // // echo $insertquery;

                // $res = mysqli_query($conn, $insertquery);
                // if($res)
                // {
                //     ?>
                //     <script>//alert("Video uploaded succesfully!");</script>
                //     <?php
                // }
                // else {
                //     ?>
                //     <script>//alert("Video not uploaded!");</script>
                //     <?php

                // }
                    
            }

        ?>

        <!-- <div class="container1">
            <a href="logout.php">
                <button type="button">Logout</button>
            </a>
            <a href="home.php">
                <button type="button">Back to Gallery</button>
            </a>
        </div> -->
    <div class="all-v-btn btn btn-outline-dark">
        <a href="home.php"><i class="fi-xwluxl-gear-wide fi-2x fi-flip-h"></i></a>
    </div>
    <footer style="background-color:#DCDCDC;font-size:16px;">
   
   <br><small id="h.95afdmhxvf3q" dir="ltr" class="CDt4Ke zfr3Q TMjjoe" style="display: block; text-align: center;color:Dark-Black;"> @copyrights 2021</small>
   <small id="h.xywgd2wyshlz" dir="ltr" class="CDt4Ke zfr3Q TMjjoe" style="display: block; text-align: center;">
   <span class=" aw5Odc" style="text-decoration: underline;">
   <a class="XqQF9c" href="mailto:events@spacece.co" target="_blank" style="">events@spacece.co</a></span> |
    <span class=" aw5Odc" style="text-decoration: underline;"><a class="XqQF9c" href="https://api.whatsapp.com/send/?phone=%2B919096305648&text=You+are+chatting+with+%27SPACE+for+ECE%27.+Please+text+your+query+here.&app_absent=0">Contact US</a></span></small>
    <small id="h.q469uon9qrj9" dir="ltr" class="CDt4Ke zfr3Q TMjjoe" style="display: block; text-align: center;">
    <span class=" aw5Odc" style="text-decoration: underline;">
    <a class="XqQF9c" href="https://www.spacece.co/terms-and-conditions">Terms and Conditions</a></span> | <span class=" aw5Odc" style="text-decoration: underline;">
    <a class="XqQF9c" href="https://www.spacece.co/disclaimer">Disclaimer</a></span> | <span class=" aw5Odc" style="text-decoration: underline;">
    <a class="XqQF9c" href="https://www.spacece.co/cookie-policy">Cookie Policy</a></span></small><small id="h.e5fs5t1klyxc" dir="ltr" class="CDt4Ke zfr3Q TMjjoe" style="display: block; text-align: center;">
    <span class=" aw5Odc" style="text-decoration: underline;">
    <a class="XqQF9c" href="https://www.spacece.co/privacy-policy">Privacy Policy</a></span> | <span class=" aw5Odc" style="text-decoration: underline;">
    <a class="XqQF9c" href="https://www.spacece.co/return-and-refund-policy">Refund Policy</a></span> | <span class=" aw5Odc" style="text-decoration: underline;"><a class="XqQF9c" href="https://www.google.com/url?q=https%3A%2F%2Fmstalkse.spacece.co%2Fshipping-policy&amp;sa=D&amp;sntz=1&amp;usg=AFQjCNF2kcrbrifnSPsKeb8XliwTJyV6BA" target="_blank">Shipping Policy</a></span></small></div></div></div></div>
    <div class="oKdM2c"><div id="h.39752d6bfe644c6b_12" class="hJDwNd-AhqUyc-uQSCkd jXK9ad D2fZ2 wHaque GNzUNc">
        <div class="jXK9ad-SmKAyb">
            <div class="tyJCtd mGzaTb baZpAe">
                <small id="h.tac4mnm75ep2" dir="ltr" class="CDt4Ke zfr3Q TMjjoe" style="display: block;"><br></small></div></div></div></div></div></div></div></div></div></section>
               </footer>
        
</body>
</html>

<!-- <div class="container">
            <div class="ins-box" id="load_videos">
            </div>
        </div>
    </div>


    <div class="all-v-btn btn btn-outline-dark">
        <a href="view.php"><i class="fi-xwluxl-table-wide fi-2x"></i></a>
    </div>

    <div class="container1">
        <a href="logout.php">
            <button type="button">Logout</button>
        </a>
        <a href="user.php">
            <button type="button">Upload Video</button>
        </a>
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
    </script> -->




<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SpacECE Video Gallery</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script defer src="https://friconix.com/cdn/friconix.js"> </script>
    <link rel="stylesheet" href="Stylesheet/stylesheet.css">
</head>

<body>


        <div class="container">
            <div class="ins-box">
                <form method="post" id="video-ins" action="/Ajax/video_process.php">
                    <div class="form-row justify-content-center">
                        <div class="form-group col-sm-12 col-lg-6 mb-0">
                            <input type="text" class="form-control" id="video_code" placeholder="Enter Youtube Video URL">
                        </div>
                        <div class="form-group col-sm-12 col-lg-2 mb-0">
                            <input type="submit" value="Upload" class="btn btn-outline-dark" data-toggle="modal"
                                data-target="#exampleModalCenter">
                        </div>
                    </div>
                </form>
            </div>
        </div>




<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script type="text/javascript">
    
    $(document).ready(function (){

        $delete_no = '';

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

        $(document).on('click', '#video_update', function(){
            $update_no = $(this).data('update_no');
            $('#upd_status').text('');
            $.getJSON("Ajax/Fetch_update.php", {'update_no' : encodeURIComponent($update_no)}, function(json_data){
                if(json_data.status == 200){
                    $('#update_no').val($update_no);
                    $('#update_iframe').attr('src', 'https://www.youtube.com/embed/'+json_data.code);
                }
                else{
                    console.log(json_data.code);
                }
            });
        });

        $('#update_video').on('submit', function(e){
            e.preventDefault();
            $upd_video_url = $('#update_url').val().trim();
            $upd_video_no = $('#update_no').val().trim();
            if($upd_video_url != '' && $upd_video_no != ''){
                $.ajax({
                    type: "POST",
                    url: "Ajax/Video_process.php",
                    data: { 
                        'upd_video_url' : encodeURIComponent($upd_video_url),
                        'upd_video_no' : encodeURIComponent($upd_video_no) },
                    success: function (response) {
                        $json_res = JSON.parse(response);
                        if($json_res.status == 104){
                            $('#update_reset').trigger('click');
                            $('#load_videos').load('Ajax/Load_gallery.php');
                            $("#update_video").trigger("reset");
                        }
                        else{
                            console.log($json_res.msg);
                        }
                    }
                });
            }
            else{
                if($upd_video_url == ''){
                    $('#upd_status').text('Please Enter Video Code');
                }
                if($upd_video_no == ''){
                    $('#upd_status').text('Video No Not Found');
                }
                
            }
        });

        $(document).on('click', '#video_delete', function(){
            $delete_no = $(this).data('delete_no');
        });

        $('#video_delete').on('click', function(){
            if($delete_no != ''){
                $.ajax({
                    type: "POST",
                    url: "Ajax/Video_process.php",
                    data: { 'de_video_no' : encodeURIComponent($delete_no) },
                    success: function (res) {
                        var json_data = JSON.parse(res);
                        if(json_data.status == '107'){
                            $('#video_delete').trigger('click');
                            $('#load_videos').load('Ajax/Load_gallery.php');
                        }
                        else{
                            console.log(json_data.msg);
                        }
                    }
                });
            }
            else{
                $('#de_status').text('Video Not Found');
            }
        });



    });

    </script>

</body>

</html> -->

  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script> 
        <script type="text/javascript">
            $(function () {
                $('#load_videos').load('Ajax/Load_gallery.php');

         
  $.validator.setDefaults({
    submitHandler: function () {
//         var matches = $('#video_code').val().match(/http:\/\/(?:www\.)?youtube.*watch\?v=([a-zA-Z0-9\-_]+)/);
// if (matches) {
//     alert('valid');
// } else {
//     alert('Invalid');


// }


function YouTubeGetID(url){
    var ID = '';
    url = url.replace(/(>|<)/gi,'').split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/);
    if(url[2] !== undefined) {
      ID = url[2].split(/[^0-9a-z_\-]/i);
      ID = ID[0];
    }
    else {
      ID = url;
    }
      return ID;
  }
        var video_url = $('#video_code').val();
        var id=YouTubeGetID( video_url);
       
if(id){
   var title=$('#title').val();
        var date=$('#date').val();
        var desc=$('#desc').val();
        var length=$('#length').val();
        var filter=$('#filter').val();

        var status=$('#status').val();

        //alert($video_url);
                    $('#ins_status').text('');
                    if (video_url != '') {
                        $.ajax({
                            type: "POST",
                            url: "Ajax/Video_process.php",
                            data: {
                                'video_url': encodeURIComponent(video_url),
                                id:id,
                                title:title,
                                date:date,
                                desc:desc,
                                length:length,
                                    status:status,
                                    filter:filter
                            },
                            success: function(response) {
                                //$json_res = JSON.parse(response);
                                alert(response);
                                // if ($json_res.status == 101) {
                                //    $('#load_videos').load('Ajax/Load_gallery.php');
                                //    $('#ins_status').text('Successfully Video Added');
                                //    $("#video-ins").trigger("reset");
                                // } else {
                                //     console.log($json_res.msg);
                                // }
                            }
                        });
                    } else {
                        $('#ins_status').text('Please Enter Video Code');
                    }
}else{
    alert("invalid");
}
        
    }
  });
  $('#video-ins').validate({
  
    rules: {
        video_code: {
        required: true,
       
        
      },
      date: {
        required: true,
      },
      title:{
          required: true,
     },desc:{
        required: true,
     },
     length:{
        required: true,
     },
     filter:{
        required: true,
     },
     status:{
        required: true,
     }
    },
    messages: {
        video_code: {
           
        required: "Please enter Valid Video code",
      
      },
      date: {
        required: "Please enter Uploaded Date",
      },
      title:{
          required: "Please enter Video title",
     },desc:{
        required: "Please Enter Video Dedcription",
     },
     length:{
        required: "Please enyer Video length",
     },
     filter:{
        required: "Please Enter Filter category",
     },
     status:{
        required: "Please select Status",
     }
    }
});
});










//             $(document).ready(function() {
              
//                 $("#video-ins").validate({
//     error: function (label) {
//       $(this).addClass("error");
//     },
//     rules: {
//         video_code: {
//         required: true,
       
//       },
//       date: {
//         required: true,
//       },
//       title:{
//           required: true,
//      },desc:{
//         required: true,
//      },
//      length:{
//         required: true,
//      },
//      filter:{
//         required: true,
//      },
//      status:{
//         required: true,
//      }
//     },
//     messages: {
//         video_code: {
//         required: "Please enter Valid Video code",
      
//       },
//       date: {
//         required: "Please enter Uploaded Date",
//       },
//       title:{
//           required: "Please enter Video title",
//      },desc:{
//         required: "Please Enter Video Dedcription",
//      },
//      length:{
//         required: "Please enyer Video length",
//      },
//      filter:{
//         required: "Please Enter Filter category",
//      },
//      status:{
//         required: "Please select Status",
//      }
//     },
//   });

//                 $('#video-ins').on('submit', function(e) {
//                     e.preventDefault();
//                     $video_url = $('#video_code').val().trim();
//                     $('#ins_status').text('');
//                     if ($video_url != '') {
//                         $.ajax({
//                             type: "POST",
//                             url: "Ajax/Video_process.php",
//                             data: {
//                                 'video_url': encodeURIComponent($video_url)
//                             },
//                             success: function(response) {
//                                 $json_res = JSON.parse(response);
//                                 if ($json_res.status == 101) {
//                                     $('#load_videos').load('Ajax/Load_gallery.php');
//                                     $('#ins_status').text('Successfully Video Added');
//                                     $("#video-ins").trigger("reset");
//                                 } else {
//                                     console.log($json_res.msg);
//                                 }
//                             }
//                         });
//                     } else {
//                         $('#ins_status').text('Please Enter Video Code');
//                     }
//                 });
//             });
        </script>