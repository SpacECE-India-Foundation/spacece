  <?php

    include 'Config/Functions.php';
    $Fun_call = new Functions();
    $main_logo = "../img/logo/SpacECELogo.jpg";
$module_logo = "../img/logo/Space_Tube.jpeg";
$module_name = "Space Tube";
    include '../common/header_module.php';

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
    <!-- <img align="left"  src="Space_ECE_logo.png" style="width: 60px; height: auto ">
    <h4 style="padding:12px;">&nbspSPACE For ECE</h4> -->
    <!-- <br><br> -->
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

        <!-- <div class="topright" >
            <a href="logout.php">
                <button type="button"style="color:white; background-color:black;border-radius: 10px;">Logout</button>
            </a>
            <button onclick="window.open('https:/www.instamojo.com/@spacece/l3a3b190992504d639f4fb6fc9bfc40fe/', '_self')" type="button" style="color:white; background-color:black;border-radius: 10px;">Subscribe</button>
            <script src="https://js.instamojo.com/v1/button.js"></script>
            <a href="user.php">
                <button type="button">Upload Video</button>
            </a>
            <a href="user1.php">
                <button type="button">Remove Video</button>
            </a> 
        </div> -->
    <div class="container">
        <?php
    include './menu.php';
        ?>
        </div>
        <!-- <div class="container">
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
             <a href="user.php">
                <button name = "upload" class="btn-btn"style="background-color:orange;"><h6>Upload Video</h6></button>
            </a>
            <a href="user1.php">
                <button name = "remove" class="btn-btn"style="background-color:orange;"><h6>Remove Video</h6></button>
            </a>
            <a href="recents.php">
                <button name = "recent" class="btn-btn"><h6>Recently Watched</h6></button>
            </a>
        </div> -->
       
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
                            <input type="date" class="form-control" name="date" id="date" placeholder="Enter Video Upload Date" >
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
                                <select name="status"  id="status">
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
                               

<!-- Modal -->

                        </div>
                    </div>
                </form>


                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bulkModal">
  Bulk Upload
</button>
            </div>
        </div>
        <div class="modal fade" id="bulkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bulk Video Upload</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form name="bulk" id="bulk" method="POST"> 
      <div class="field_wrapper">
    <div>
    <input type="text" id="video_code[]" placeholder="Video id" name="video_code[]" class="col-sm-3" required > <input type="text" id="title[]" name="title[]" placeholder="vedio title" class="col-sm-3" required/>
    <input type="text" name="desc[]" id="desc[]" class="col-sm-3"  placeholder="video description" required /> <input type="text" id="length[]"  placeholder="video length" name="length[]" class="col-sm-3" required/>
    <input type="text" name="filter[]" id="filter[]"  placeholder="video filter" class="col-sm-3" required /> 
                                <select name="status[]" id="status[]" class="col-sm-3" required >
                                <option value="">Select...</option>
                                <option value="free">Free</option>
                                <option value="created">Created</option>
                                </select>
        <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-plus"></i></a>
    </div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>

      </div>
     </form>

    </div>
  </div>
</div>
        <?php

            //include 'connection.php';
            

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

   
</body>
</html>






</body>

</html> -->
<?php
include '../common/footer_module.php';
?>

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
        <script type="text/javascript">
$(document).ready(function(){
    var maxField = 5; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" id="video_code[]" name="video_code[]" placeholder="video id" class="col-sm-3" required > <input type="text" id="title[]" name="title[]" class="col-sm-3" placeholder="Video tiltle"  required /><input type="text" name="desc[]" id="desc[]" class="col-sm-3" placeholder="Video description" required/> <input type="text" id="length[]" name="length[]" placeholder="Enter length" class="col-sm-3" required/><input type="text" name="filter[]" id="filter[]" class="col-sm-3" placeholder="Insert Filter" required/> <select name="status[]" id="status[]" class="col-sm-3" required ><option value="">Select...</option><option value="free">Free</option><option value="created">Created</option> </select><a href="javascript:void(0);" class="remove_button"><i class="fa fa-minus" ></i></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
<script>
$('#bulk').on('submit',function(){
  // var id= [];
    //   $('input[name="video_code[]"]').each(function(i, item) {
    //      // alert($(item).val());
    //     id.push($(item).val()) ;
        
    //  });
     //alert(id);
     var form=$("#bulk");
     $.ajax({
        type:"POST",
        url:"Ajax/bulk_upload.php?bulk",
        data:form.serialize(),

        success: function(response){
        alert(response);
        }
    });
})


</script>