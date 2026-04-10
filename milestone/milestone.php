<?php
//  
$main_logo = "../img/logo/SpacECELogo.jpg";
$module_logo = null;
$module_name = null;
$main_page = true;

$extra_styles = "<link rel='stylesheet' href='./css/bootstrap.min.css' />
<link rel='stylesheet' href='./css/font-awesome.min.css' />
<link rel='stylesheet' href='./css/animate.css' />
<link rel='stylesheet' href='./css/owl.carousel.css' />
<link rel='stylesheet' href='./css/style.css' />
<link
  rel='stylesheet'
  href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'
/>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>

<link rel='stylesheet' type='text/css' href='./Styles.css' />
<link rel='stylesheet' type='text/css' href='./css/jquery.convform.css' />
<link rel='stylesheet' type='text/css' href='./css/responsive.css' />
<link rel='stylesheet' type='text/css' href='./css/jquery-ui.css' />";

$extra_scripts = "<script src='./js/jquery-3.2.1.min.js'></script>
<script src='./js/bootstrap.min.js'></script>
<script src='./js/owl.carousel.min.js'></script>
<script src='./js/masonry.pkgd.min.js'></script>
<script src='./js/magnific-popup.min.js'></script>
<script src='./js/main.js'></script>
<script type='js/jquery.js'></script>
<script type='text/javascript' src='./js/jquery-3.1.1.min.js'></script>
<script type='text/javascript' src='./js/jquery.convform.js'></script>
<script type='text/javascript' src='./js/custom.js'></script>
<script type='text/javascript' src='./js/jquery-1.12.4.js'></script>
<script type='text/javascript' src='./js/jquery-ui.js'></script>
<script type='text/javascript' src='./js/bootstrap.min.js'></script>";

include_once '../common/header_module.php';

// print_r($_SESSION);update
//session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Completion Status & Tasks - <?php echo $selected_child_id ? 'Child Milestones' : 'Milestone Tracker'; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<!-- <link rel="stylesheet" href="../Assets/css/style.css"> -->
<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Poppins',sans-serif;
}

.b{
  background-color: #fff7da;
  overflow-x: hidden;

}
.hero-image{
  width: 50%;
  padding: 0px 15px;
}

.navbar .logo img {
    width: 100px;
    height: auto;
    max-width: 100%;
    display: block;
}

.navbar .logo a {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
}
/* WRAPPER */
.wrapper{
  max-width:1100px;
  margin:auto;
  padding:150px 15px 30px 15px;
}

/* ================= CHILD SELECTOR ================= */
.child-selector{
  background:#fff;
  border-radius:15px;
  padding:20px;
  margin-bottom:30px;
  box-shadow:0 5px 15px rgba(0,0,0,.1);
}

.child-selector h3{
  margin-bottom:15px;
  color:#333;
}

.child-buttons{
  display:flex;
  gap:10px;
  flex-wrap:wrap;
}

.child-btn{
  background:#ff9800;
  color:#fff;
  border:none;
  padding:10px 20px;
  border-radius:25px;
  cursor:pointer;
  transition:0.3s;
}

.child-btn:hover,
.child-btn.active{
  background:#e68900;
  transform:translateY(-2px);
}

/* ================= COMPLETION STATUS ================= */
.completion{
  background:linear-gradient(135deg,#f6a623,#f8d350);
  border-radius:20px;
  padding:25px;
  box-shadow:0 10px 25px rgba(0,0,0,.15);
}

.completion h2{
  text-align:center;
  color:#fff;
  margin-bottom:20px;
}

.status-row{
  display:flex;
  justify-content:space-between;
  align-items:center;
  gap:20px;
  flex-wrap:wrap;
}

.status-card{
  background:#fff;
  border-radius:14px;
  padding:18px;
  width:200px;
  text-align:center;
}

.status-card p{
  color:#ff7a00;
  font-size:14px;
}

.status-card h3{
  color:#ff7a00;
  font-size:32px;
}

.circle{
  width:120px;
  height:120px;
  background:#f3c623;
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  color:#fff;
  font-size:26px;
  font-weight:700;
}

/* ================= TASK SECTIONS ================= */
.tasks{
  margin-top:35px;
  background:#fffbe6;
  border-radius:20px;
  padding:25px;
  box-shadow:0 8px 20px rgba(0,0,0,.12);
}

.tasks.past-tasks{
  background:transparent;
  box-shadow:none;
  padding:10px 0;
}

/* ================= TASK CARD (SAME FOR ALL) ================= */
.task{
  background:#fff;
  border:2px solid #f6c14b;
  border-radius:16px;
  padding:16px;
  display:flex;
  justify-content:space-between;
  align-items:flex-start;
  gap:15px;
  margin-bottom:14px;
  opacity:1;
}

/* completed */
.task.completed p{
  text-decoration:line-through;
  color:#888;
}

/* failed (LOOK SAME) */
.task.failed{
  border:2px solid #f6c14b;
  opacity:1;
}

/* ================= TASK INFO ================= */
.task-info p{
  font-size:15px;
  line-height:1.4;
}

/* TAGS */
.tag{
  display:inline-block;
  margin-top:6px;
  padding:4px 12px;
  border-radius:18px;
  font-size:12px;
  font-weight:500;
}

.language{background:#ffe0a3;}
.motor{background:#d4fff4;}
.cognitive{background:#ffb7b7;}
.social{background:#ccffb8;}

/* ================= CHECK ================= */
.check{
  width:22px;
  height:22px;
  border:2px solid #f6a623;
  border-radius:6px;
  display:flex;
  align-items:center;
  justify-content:center;
  cursor:pointer;
}

.check.active{
  background:#f6a623;
  color:#fff;
}

/* disable failed cross */
.check.cross{
  background:#ff6b6b;
  color:#fff;
  border-color:#ff6b6b;
  pointer-events:none;
}

/* ================= MILESTONE ================= */
.milestone{
  background:#ffc857;
  border-radius:16px;
  padding:18px;
  margin-top:20px;
}

.milestone-title{
  font-weight:600;
  margin-bottom:10px;
}

.milestone-box{
  background:#fff;
  border-radius:14px;
  padding:14px;
  display:flex;
  justify-content:space-between;
  align-items:center;
  gap:12px;
}

/* UPLOAD */
.upload{
  width:48px;
  height:48px;
  background:#fff;
  border:2px solid #f6a623;
  border-radius:12px;
  cursor:pointer;
  display:flex;
  align-items:center;
  justify-content:center;
  position:relative;
}

.upload input{
  position:absolute;
  inset:0;
  opacity:0;
}

/* VIDEO BADGE */
.video-badge{
  background:#4caf50;
  color:#fff;
  padding:6px 10px;
  border-radius:10px;
  font-size:12px;
  white-space:nowrap;
}

/* DATE */
.date-title{
  text-align:center;
  font-weight:600;
  margin:20px 0 15px;
  color:#333;
}

/* ================= RESPONSIVE ================= */
@media(max-width:768px){
  .status-row{
    justify-content:center;
  }

  .status-card{
    width:100%;
  }

  .task{
    flex-direction:column;
  }

  .check{
    align-self:flex-end;
  }

  .milestone-box{
    flex-direction:column;
    align-items:flex-start;
  }

  .child-buttons{
    justify-content:center;
  }
}
</style>
</head>

<body class="b">



<div class="wrapper">

  <!-- CHILD SELECTOR -->
  <div class="child-selector">
    <h3>Select Child</h3>
    <div class="child-buttons" id="childButtons">
      <!-- Children buttons from API -->
    </div>
  </div>

  <!-- COMPLETION STATUS -->
  <div class="completion">
    <h2>Completion Status</h2>
    <div class="status-row">
      <div class="status-card">
        <p>Total Milestones</p>
        <h3 id="totalMilestones">0</h3>
      </div>

      <div class="circle" id="completionCircle">0/0</div>

      <div class="status-card">
        <p>Completed Tasks</p>
        <h3 id="completedTasks">0</h3>
      </div>
    </div>
  </div>

  <!-- MILESTONES -->
  <div class="tasks">
    <h2>Milestone Progress</h2>

    <div id="milestoneTasks">
      <!-- Milestone tasks from API -->
    </div>
  </div>

</div>

<!-- Video Upload Modal -->
<div id="videoModal" style="display:none">
  <input type="file" id="taskVideo" accept="video/*">
  <button onclick="uploadVideo()">Upload</button>
  <button onclick="closeModal()">Cancel</button>
</div>


<script src="../Assets/js/milestone.js"></script>



<!-- footer include -->
<!-- <div id="footer"></div>
<script src="../layout/layout.js"></script> -->

</body>
</html>

<div>
  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- SweetAlert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <style>
    .fa {
      display: inline-flex;
      justify-content: center;
      align-items: center;
      padding: 10px;
      font-size: 20px;
      width: 40px;
      height: 40px;
      margin: 5px;
      text-align: center;
      text-decoration: none;
      border-radius: 50%;
      transition: transform 0.2s ease;
    }

    .fa:hover {
      transform: scale(1.1);
      opacity: 0.8;
    }

    .fa-facebook-f {
      background: #3B5998;
      color: white;
    }

    .fa-twitter {
      background: #55ACEE;
      color: white;
    }

    .fa-linkedin {
      background: #007bb5;
      color: white;
    }

    .fa-instagram {
      color: white;
      background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
      box-shadow: 0px 3px 10px rgba(0, 0, 0, .25);
    }

    @media only screen and (max-width: 600px) {
      .on-desktop {
        display: none;
      }

      .on-mobile {
        display: block;
      }
    }

    @media (min-width: 1025px) and (max-width: 1280px) {
      .on-desktop {
        display: block;
      }

      .on-mobile {
        display: none;
      }
    }

    .footer-widget {
      padding-left: 5px !important;
      padding-right: 5px !important;
    }

    .email-container {
      max-width: 600px;
      margin: 0 auto;
    }

    .email-label {
      display: block;
      margin-bottom: 10px;
      font-size: 18px;
      color: #333;
    }

    .email-form {
      display: flex;
      border: 1px solid #ccc;
      border-radius: 16px;
      padding: 6px;
      background: white;
    }

    .email-form input[type="email"] {
      flex: 1;
      min-width: 100px;
      padding: 16px;
      border: none;
      outline: none;
      font-size: 16px;
    }

    .email-form button {
      padding: 12px 20px;
      background-color: #fff;
      font-weight: bold;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 12px;
      cursor: pointer;
      transition: background 0.2s ease;
    }

    .email-form button:hover {
      background-color: rgb(215, 211, 211);
    }
  </style>
  </head>

  <body>


    <footer class="bg-white border-top pb-5">
      <div class="container" style="padding-top: 30px;">

        <div class="row g-5">


          <!-- Logo Section -->
          <div class="col-md-3 mb-3 mt-5">
            <a href="http://www.spacece.in">
              <img src="<?= isset($main_logo) ? $main_logo : '#' ?>" class="img img-fluid img-thumbnail img-circle" alt="Logo" style="width: 240px; height:240px; border:none; margin-left:-80px !important; margin-top:20px !important;" />
            </a>
          </div>

          <!-- Contact Section -->
         <div class="col-md-3 mb-3 mt-5 text-start">
  <div class="contact-widget" style="color: black; margin-left:-40px !important; margin-top:20px !important;">
    <h5 style="font-size: 20px !important;">Contact Us</h5>
    
    <p class="mb-3" style="font-size: 15px !important; margin-right: 90px !important;">
      <i class="fa-solid fa-phone text-warning me-2"></i> +91 90963 05648
    </p>
    
    <p class="mb-3" style="font-size: 15px !important; margin-right: 50px !important;">
      <i class="fas fa-envelope text-warning me-2"></i> events@spaceece.co
    </p>
    
    <p class="mb-3" style="font-size: 15px !important; margin-right: 120px !important;">
      <i class="fas fa-map-marker-alt text-warning me-2"></i> SPACE-ECE
    </p>
    
    <p class="mb-3" style="font-size: 15px !important; margin-right: 50px !important;">
      <i class="fas fa-clock text-warning me-2"></i> Mon - Sat 8 AM - 6 PM
    </p>
  </div>
</div>

          <!-- Health Message + Social Media -->
           
          <div class="col-md-3 mb-3 mt-5 text-start">
            <h5 class="text-warning" style="font-size:20px;  margin-left:-10px !important; margin-top:12px !important;">Still delaying treatment for your child's health concerns?</h5>
            <p class="mb-3 fs-6" style="text-align: left; font-size:15px !important;">Connect with India’s top doctors online, today!</p>
            <h5 style="font-size:20px">Our Socials</h6>
              <div>
                <a href="https://www.facebook.com/SpacECEIn" target="_blank" class="text-dark me-3"><i class="fa-brands fa-facebook "></i></a>
                <a href="https://twitter.com/" target="_blank" class="text-dark me-3"><i class="fa-brands fa-twitter "></i></a>
                <a href="https://www.linkedin.com/company/spacece-co/" target="_blank" class="text-dark me-3"><i class="fa-brands fa-linkedin "></i></a>
                <a href="https://www.instagram.com/spacece.in/" target="_blank" class="text-dark"><i class="fa-brands fa-instagram "></i></a>
              </div>

          </div>

          <!-- Newsletter Section -->
          <div class="col-md-3 mb-3 mt-5 text-start">
            <div style="margin-left: 20px;">
                <h5 style="font-size:20px !important;">Subscribe To Our Newsletter</h5>
                <p class="mb-3 fs-6" style="text-align: left; font-size:15px !important;">Subscribe to our newsletter to get updates, offers and discounts.</p>

                <div class="email-container">
                <label class="email-label fs-6" style="text-align: left; font-size:15px !important;" for="email">Enter your email -</label>
                <form id="sub" class="email-form">
                    <input type="email" id="email" placeholder="Email here" required />
                    <button type="submit">Submit</button>
                </form>
                </div>

             </div>
           </div>
        </div>
      </div>

    </footer>

    <?= isset($extra_scripts) ? $extra_scripts : null ?>

    <script>
      $(document).ready(function() {
        $('#sub').on('submit', function(e) {
          e.preventDefault();
          var email = $('#email').val();

            // ✅ Custom regex for stricter email validation
            // Previously, the form relied only on HTML5 type="email", which allowed invalid emails like 'test@mailcom'
            // Now, we use regex /^[^\s@]+@[^\s@]+\.[^\s@]+$/ to ensure:
            //   1. Email contains '@' symbol
            //   2. Email contains a dot '.' after domain (like .com, .in)
            //   3. Prevents invalid formats like 'test@mailcom' or 'test@.com'
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailPattern.test(email)) {
                swal("Error!", "Please enter a valid email address!", "error");
                return;
            }

          $.ajax({
            method: "POST",
            // ✅ Changed URL path
            // Previously: './common/function.php'
            // Now: '../common/function.php' to correctly point to the PHP handler from current page directory
            url: "../common/function.php",
            data: {
              subscribe: 1,
              email: email
            },
            success: function(data) {
              console.log("Server response:", data);
              handleSubscriptionResponse(data);
            },
            error: function(xhr, status, error) {
              swal("Error!", "Something went wrong. Please try again later.", "error");
            }
          });
        });

        function handleSubscriptionResponse(data) {
          switch (data.trim()) {
            case 'Error':
              swal("Error!", "You have already subscribed to this site!", "error");
              break;
            case 'Success':
              swal("Good job!", "You have subscribed!", "success");
              break;
            case 'Invalid':
              swal("Error!", "Please enter a valid email!", "error");
              break;
            default:
              swal("Error!", "Unexpected response from the server.", "error");
          }
        }
      });
    </script>

  </body>

  </html>
</div>

  <!-- Everything below stays same as index.php -->
  <?php
  // You can add the rest of your course section, cards, JS, etc. here exactly as it was
  // e.g. include 'course_section.php' if modularized
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>



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
                  
