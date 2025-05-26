<?php
//session_start();

//use Google\Service\Script;

include_once './header_local.php';
include_once '../common/header_module.php';
include_once '../common/banner.php';

?>
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Upload Youtube video
    </button> -->

<!-- Modal -->
<link rel="stylesheet" href="./src/ALightBox.css">

<style>
body { 
    background-color: #EEEEEE !important;
    margin: 0; /* Remove any default body margin */
    padding: 0;
}

.table-container {
    background-color: #FFFFFF;
    padding: 0px; /* Remove extra padding */
    margin: 40px auto;
    max-width: 100%; /* You can use 100% or a higher value if needed */
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden; /* Prevent white space overflow */
}

table#activity_table {
    width: 100%;
    border-collapse: collapse;
    background-color: #FFFFFF !important;
}

table#activity_table th {
    background-color: #EEEEEE !important;
    font-weight: 600;
    color: #333;
    text-align: left;
    padding: 16px 20px;
    border: 1px solid #ddd; /* Adds vertical and horizontal lines */
}

table#activity_table td {
    padding: 16px 20px;
    background-color: #FFFFFF !important;
    white-space: normal;
    border: 1px solid #ddd; /* Adds vertical and horizontal lines */

}


/* Buttons */
.preview-btn {
    background-color: #FFA500;
    color: white;
    padding: 10px 20px;
    font-size: 15px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.action-btn {
    background-color: #00BFFF;
    color: white;
    padding: 10px 20px;
    font-size: 15px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}



    .table {


        /* margin: 0 auto; */


    }
   .youtube {
    
         background: transparent; 
          display: inline-block;
           
             margin-left:50%;
             position: relative;
 
    bottom: 25px;
    }
    @media (min-width: 1090px) {
    #tablediv {
        display: flex;
        justify-content: center;
    }

    .table-container {
        width: 90%;
        max-width: 1080px;
        margin: auto;
    }

    .table {
        width: 100%;
        margin: 0 auto;
    }
}

    
</style>
<?php
if(isset($_SESSION['space_active'])){



if($_SESSION['space_active']==="inactive"){
    ?>
    <button onclick="window.location.href = 'https://www.instamojo.com/@spacece/l3a3b190992504d639f4fb6fc9bfc40fe/';" type="button" class="btn-btn" style="background-color:orange;">
    <h6>Subscribe</h6>
</button>
    <?php 
}elseif(!isset($_SESSION['space_active'])){
    ?>
    <button onclick="window.location.href = 'https://www.instamojo.com/@spacece/l3a3b190992504d639f4fb6fc9bfc40fe/';" type="button" class="btn-btn" style="background-color:orange;">
    <h6>Subscribe</h6>
</button>
    <?php
}
}
?>
<div class="container" style="margin-top:-5%;">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- <script type="text/javascript" src="js/scriptcall.js"></script> -->
<body>




    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Upload Youtube video</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>
                <div class="modal-body">
                    <form id="uploadVideo" method="post" enctype="multipart/form-data" action="Youtube/upload.php">
                        <div class="row mb-3">
                            <div class="col">
                                <input class="form-control" type="text" name="title" id="title" placeholder="Enter Video Title">
                            </div>
                        </div>
                       
                        <br>
                       
                        <?php

                       /// $API_URL1 = $base_url . "part=snippet%2Cstatus&key=" . $key . " HTTP/1.1";
                        ?>
                        <br>
                        <div class="row mb-3">
                            <div class="col">
                                <textarea id="summary" class="form-control" name="summary" cols="30" rows="10" placeholder="Enter video description"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="file" name="file" id="file" class="form-control" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="submit" name="submit" id="uploadVideo1" class="btn btn-primary" value="Submit" />
                            </div>
                        </div>

                    </form>
                    <!-- <div class="progress">
  <div class="progress-bar progress-bar-striped"  id="progress" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
    <span class="prograss-bar-text">0%</span>
  </div>

</div> -->
                   
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                   
                </div>
            </div>
        </div>
    </div>

</div>
<br><br>
<div class="container" style="margin-top:10%;">
<div style="text-align: center; margin-bottom: 20px;">
    <button onclick="window.location.href='add_space_activity.php'" class="btn btn-warning" style="padding: 10px 25px; font-size: 16px; border-radius: 8px;">Add New Space Activity</button>
</div>

<div class="container" style="margin-top:10%;">
    <div class=" col-sm-12 " id="tablediv">
    <div class="table-container">
        <table id="activity_table" class="table">
            <tr>
                <th>Activity Id</th>
                <th>Activity Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Preview</th>
                <tH>Action</th>
            </tr>
            <tbody id="tablebody">

            </tbody>
        </table>
        </div>
    </div>
    <div class="modal fade  " id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal">View Activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-inline"><strong><label>Activity Id :</label></strong>
                                <div id="act_id"> </div>
                            </div>
                            <br>

                            <div class="form-inline"><strong> <label>Activity Level : </label></strong>
                                <div id="act_lvl"></div>
                            </div>
                            <br>
                            <div class="form-inline"><strong><label>Activity Developing Domain : </label></strong>
                                <div id="act_domain"></div>
                            </div>
                            <br>
                            <div class="form-inline"><strong><label>Activity objectives : </label></strong>
                                <div id="act_obj"></div>
                            </div>
                            <br>
                            <div class="form-inline"><strong><label>Activity Key Objectives : </label></strong>
                                <div id="act_key"></div>
                            </div>
                            <br>
                            <div class="form-inline"><strong><label>Activity material : </label></strong>
                                <div id="act_mat"></div>
                            </div>
                            <br>


                        </div>
                        <div class="col-sm-6">
                            <div class="form-inline"><strong><label> Activity Name : </label></strong>
                                <div id="act_name"></div>
                            </div>
                            <br>
                            <div class="form-inline"><strong><label>Activity Assesment : </label></strong>
                                <div id="act_assess"></div>
                            </div>
                            <br>
                            <div class="form-inline"><strong><label>Activity process : </label></strong>
                                <div id="act_pro"></div>
                            </div>
                            <br>
                            <div class="form-inline"><strong><label>Activity Instructions :</label> </strong>
                                <div id="act_ins"></div>
                            </div>
                            <br>
                            <div class="form-inline"><strong><label>Activity Date :</label></strong>
                                <div id="act_date"></div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
<div class="modal-footer" style="display: flex; flex-direction: column; gap: 10px; align-items: flex-end;">
                    <button type="button" class="btn" style="background-color: #FFA500; color: white; padding: 10px 20px; border-radius: 8px; border: none;">
                        Online Activity Registration
                    </button>
                    
                    <button type="button" class="btn" style="background-color: #007BFF; color: white; padding: 10px 20px; border-radius: 8px; border: none; margin-right: 4px;">
                        In-Person Visit Registration
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- <iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&layout=button_count&size=small&width=98&height=20&appId" width="98" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe> -->
</div>
</div>
</div>
<!-- <div class="progress mt-5" >
  <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
</div> -->




<!-- <script src="https://apps.elfsight.com/p/platform.js" defer></script>
    <div class="elfsight-app-0a2b4f6c-d665-4279-8b36-d0cf353f754d"></div> -->

<div class="modal fade  " id="playlistModel" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal">View Activity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="AddDescription" method="post">
                    <div class="row">
                        <div class="col-sm-10">
                            <input class="form-control col-sm-3" type="text" name="title" id="title" placeholder="Enter Playlist name ">
                        </div>
                    </div>
                    <br>
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <textarea id="summary" class="form-control col-sm-3" name="summary" cols="30" rows="10" placeholder="Enter playlist description"></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row mb-3">
                        <div class="col-sm-8">
                            <input type="submit" name="submit" id="addPlaylist" class="btn btn-primary col-sm-3" value="Submit" />
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-lg  " id="myVideos" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg   " role="document">
   
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal">My Videos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div id="myvideos" name="myvideos" data-title="Landscape" class="t"></div>
               
            </div>
        </div>
    </div>
</div>


<div class="modal fade  " id="allVideos" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg" role="document">
   
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal">View all Videos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div id="allvideos" name="allvideos" data-title="Landscape" class="t" >
                
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
                </form>
            </div>
        </div>
    </div>
</div>
    </div>
<div class="progress">
    <div id="progress-bar" class="progress-bar progress-bar-striped" role="progressbar" style="width:10px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
</div>

<div class="row">

</div><br><br>
</body>

</html>
<?php
include_once '../common/footer_module.php';
?>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- <script type="text/javascript" src="js/scriptcall.js"></script> -->

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="./src/ALightBox.js"></script>
	
		<script type="text/javascript">
			$('body').ALightBox({
				showYoutubeThumbnails: true
			});
		</script>
          
<script type="text/javascript">
    $(document).ready(function() {
      
        $('.progress').hide();
        // $('#progress').hide();
        $.ajax({
            type: 'POST',
            url: 'fetch.php',
            data: {
                'getDetails': 1
            },
            success: function(data) {
            // console.log(data);
                $('#tablebody').append(data);
            }

        });

        $("#file").change(function() {
            var allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'video/mp4', 'video/AVI', 'audio/mp3'];
            var file = this.files[0];
            var fileType = file.type;
            if (!allowedTypes.includes(fileType)) {
                alert('Please select a valid file (JPEG/JPG/PNG/GIF/MP4/AVI/MP3).');
                $("#file").val('');
                return false;
            }
        });
    });

    $(document).on("click", "#edit", function() {
        //alert("Yes");
        //$('#editModal').modal('toggle');
        $('#act_id').empty();
        $('#act_lvl').empty();
        $('#act_domain').empty();
        $('#act_obj').empty();
        $('#act_key').empty();
        $('#act_mat').empty();
        $('#act_name').empty();
        $('#act_assess').empty();
        $('#act_pro').empty();
        $('#act_ins').empty();
        $('#act_date').empty();
        var id = $(this).data('text');
        //alert(id);
        $.ajax({
            type: 'POST',
            data: {
                'getDetails': 1,
                'id': id
            },
            url: 'fetch.php',
            success: function(data1) {
                /// console.log(data1);
                var data2 = JSON.parse(data1);
                //alert(data2.activity_no);
                $('#act_id').append(data2.activity_no);
                $('#act_lvl').append(data2.activity_level);
                $('#act_domain').append(data2.activity_dev_domain);
                $('#act_obj').append(data2.activity_objectives);
                $('#act_key').append(data2.activity_key_dev);
                $('#act_mat').append(data2.activity_material);
                $('#act_name').append(data2.activity_name);
                $('#act_assess').append(data2.activity_assessment);
                $('#act_pro').append(data2.activity_process);
                $('#act_ins').append(data2.activity_instructions);
                $('#act_date').append(data2.activity_date);

            }
        });
    });

    
    $(document).on("click", "#upload", function() {
        var cat_id= $(this).data('text');
        var pl_id=$(this).data('playlist');
        var id =    $(this).data('text');

    $('#uploadVideo').on('submit', function(event) {

       
        event.preventDefault();

        var fd = new FormData();
        var file_data = $('input[type="file"]').prop('files')[0];
        //alert(file_data);
        var title = $('#title').val();
        var summary = $('#summary').val();
       
        fd.append("file", file_data);
        fd.append("title", title);
        fd.append("summary", summary);
        fd.append("id", id);
        fd.append("pl_id", pl_id);
        $('#exampleModal').modal('hide');
        $('.progress').show();

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = parseInt(((evt.loaded / evt.total) * 100));
                        $("#progress-bar").width(percentComplete + '%');
                        $("#progress-bar").html(percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: 'Youtube/index.php',
            data: fd,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#progress-bar").width('0%');
                $('#loader-icon').show();
                $('#exampleModal').modal('hide');
                $("#exampleModal").hide();
                $("#exampleModal").removeClass("in");
                $(".modal-backdrop").remove();
            },
            error: function() {
                $('#loader-icon').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
            success: function(resp) {
                alert(resp);
                $('.progress').hide();
                if (resp == 'ok') {
                    // $('#uploadForm')[0].reset();
                    // $('#loader-icon').html('<p style="color:#28A74B;">File has uploaded successfully!</p>');

                } else if (resp == 'err') {
                    //  $('#loader-icon').html('<p style="color:#EA4335;">Please select a valid file to upload.</p>');
                }
            }
        });
    });

});


    $('#playlist').on('click', function() {

        $('#exampleModal').modal('toggle');
    });


    $('#AddDescription').on('submit', function(event) {

        event.preventDefault();
        var title = $('#title').val();
        var summary = $('#summary').val();
        $.ajax({
            type: 'POST',
            url: 'Youtube/data.php',
            data: {
                title: title,
                summary: summary

            },
            success: function(data) {
                alert(data);
            }

        });

    });
</script>
<script>

$(document).on("click", "#myVideo", function() 
{
    $('#myvideos').empty();
    var act_id = $(this).data("text");
$.ajax({
    method:'POST',
    data:{
        act_id:act_id,
        myVideo:1
    },
    url:'get_videos.php',
    success:function(result){
        
        $('#myvideos').append(result);
    }
})                      
                    })
                    
                     $(document).on("click", "#all", function() {
                        
                        var act_id = $(this).data("text");
                        $('#allvideos').empty();
                        $.ajax({
                        method:'POST',
                        data:{
                            act_id:act_id,
                            all:1
                        },
                        url:'get_videos.php',
                        success:function(result){
                          //  alert(result); 
                          //$(result).appendTo('#allvideos');
                            $('#allvideos').append(result);
                        }
                    })
                })
                $(document).ready(function() {
    var currentPage = 1;
    var totalPages = 0;

    function loadTable(page) {
        $.ajax({
            type: 'POST',
            url: 'fetch.php',
            data: {
                'getDetails': 1,
                'page': page
            },
            success: function(data) {
                // Parse the response data
                data = JSON.parse(data);
                $('#tablebody').html(data.records); // Populate table body
                totalPages = data.totalPages; // Update total pages
                $('#currentPage').text('Page ' + currentPage); // Display current page
                $('#prevPage').prop('disabled', currentPage <= 1); // Disable "Previous" button on first page
                $('#nextPage').prop('disabled', currentPage >= totalPages); // Disable "Next" button on last page
            }
        });
    }

    loadTable(currentPage); // Load first page initially

    $('#prevPage').click(function() {
        if (currentPage > 1) {
            currentPage--;
            loadTable(currentPage);
        }
    });

    $('#nextPage').click(function() {
        if (currentPage < totalPages) {
            currentPage++;
            loadTable(currentPage);
        }
    });
});


                
                    </script>
                  
