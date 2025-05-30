<?php

require_once 'Config/Functions.php';
$Fun_call = new Functions();

include_once './header_local.php';
include_once '../common/header_module.php';


$status = 'false';
if (isset($_SESSION['current_user_email'])) {
    $table = 'webhook';
    //$email='yashasvipundeer@gmail.com';
    $status =  $Fun_call->checkSubscription($table, $email);
}


$fetch_video = $Fun_call->select_order('videos', 'v_id', 'DESC');
$get_video = $Fun_call->selected_order('videos', 'filter');

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="topright">
    <!-- <a href="logout.php"> -->
    <!-- <button onclick="window.open('logout.php', '_self')" type="button" style="background-color:black;color:white;border-radius:10px;">Logout</button> -->
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
<div class="container-fluid">
<body style="background-color: #eeeeee;">
<div class="container" style="margin-left: 350px !important;">
            <?php include 'menu.php'; ?>
        </div>
<?php include_once '../common/banner.php';
if ($status === true) {
?>
        <div class="container">
            <div class="ins-box">
                <div class="container">
                    <ul class="nav justify-content-center bg-dark">
                        <li class="nav-item">
                            <div class="nav-link heading">Subscribed Videos</div>
                        </li>
                    </ul>
                </div>
                <br>
                <form action="" method="post">
                    <select name="filterr">
                        <option value="all" selected>ALL</option>
                        <?php
                        if ($get_video) {
                            foreach ($get_video as $video_data) {
                                echo "<option value='" . $video_data['filter'] . "'>" . $video_data['filter'] . "</option>";
                            }
                        }
                        $abc = $_POST['filterr'];
                        ?>
                    </select>
                    <input type="Submit" value="Submit" name="Submit">
                    <?php
                    $status = 'created';
                    $filter_videos = $Fun_call->filter_video('videos', $abc, $status, 'v_id', 'DESC');

                    ?>
                </form>
                <br><br>
                <div class="row row-cols-1 row-cols-md-3">
                    <?php

                    if ($filter_videos) {

                        foreach ($fetch_video as $video_data) {
                            if ($abc == "all" || $abc == NULL) {
                                if ($video_data['status'] ==  "free") {
                    ?>
                                    <div class="col mb-4">
                                        <div class="card h-100">
                                            <div class="set-box youtube-video-r">
                                                <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $video_data['v_url']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>
                                            <div class="card-body pt-2 pb-2">
                                                <?php include 'options.php'; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                            } else if ($video_data['status'] ==  "free" && $video_data['filter'] == $abc) {
                                ?>
                                <div class="col mb-4">
                                    <div class="card h-100">
                                        <div class="set-box youtube-video-r">
                                            <iframe width="460" height="275" src="https://www.youtube.com/embed/<?php echo $video_data['v_url']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                        <div class="card-body pt-2 pb-2">
                                            <h6 class="card-title">
                                                <?php echo $video_data['title']; ?></h6>
                                            <?php echo $video_data['v_date']; ?><br>
                                            <a href="likecnt.php?btn=<?php echo $video_data['v_id'] ?>">
                                                <button name="likecnt" class="btn"><i class="fas fa-thumbs-up" style="color:black"></i></button>

                                            </a>
                                            <?php echo $video_data['cntlike']; ?>
                                            <a href="likecnt.php?btn1=<?php echo $video_data['v_id'] ?>">
                                                <button name="dislikecnt" class="btn"><i class="fas fa-thumbs-down" style="color:black"></i></button>

                                            </a>
                                            <?php echo $video_data['cntdislike']; ?>
                                            <button name="share" class="btn"><a href="whatsapp://send?text=<?php echo "*SpacTube - Video Gallery on Child Education* %0a %0aI am sharing one important video on Child Education.%0ahttps://www.youtube.com/watch?v=" . $video_data['v_url'] . " %0a %0aYou can also subscribe to SpacTube by clicking on the following.%0ahttps://www.spacece.co/offerings/spactube %0a %0aThanks and Regards, %0aSpacECE India Foundation %0a %0awww.spacece.co %0awww.spacece.in %0a"; ?>" data-action="share/whatsapp/share" target="_blank"><i class="fas fa-share-alt" style="color:black"></i></a></button>
                                            <!-- <a href="comment.php">
                <button name="comment" class="btn"><img src="comments.png" style="justify-content: center; padding-left: 30%; height: 20px; width: 35px"></button>
            </a> -->

                                        </div>
                                    </div>
                                </div>
                                <?php }
                        }
                    } else {
                        if ($fetch_video) {
                            foreach ($fetch_video as $video_data) {
                                if ($abc == "all" || $abc == NULL) {
                                    if ($video_data['status'] ==  "free") {
                                ?>
                                        <div class="col mb-4">
                                            <div class="card h-100">
                                                <div class="set-box youtube-video-r">
                                                    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $video_data['v_url']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                </div>
                                                <div class="card-body pt-2 pb-2">
                                                    <?php include 'options.php'; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                } else if ($video_data['status'] ==  "free" && $video_data['filter'] == $abc) {
                                    ?>
                                    <div class="col mb-4">
                                        <div class="card h-100">
                                            <div class="set-box youtube-video-r">
                                                <iframe width="460" height="275" src="https://www.youtube.com/embed/<?php echo $video_data['v_url']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>
                                            <div class="card-body pt-2 pb-2">
                                                <h6 class="card-title">
                                                    <?php echo $video_data['title']; ?></h6>
                                                <?php echo $video_data['v_date']; ?><br>
                                                <a href="likecnt.php?btn=<?php echo $video_data['v_id'] ?>">
                                                    <button name="likecnt" class="btn"><i class="fas fa-thumbs-up" style="color:black"></i></button>

                                                </a>
                                                <?php echo $video_data['cntlike']; ?>
                                                <a href="likecnt.php?btn1=<?php echo $video_data['v_id'] ?>">
                                                    <button name="dislikecnt" class="btn"><i class="fas fa-thumbs-down" style="color:black"></i></button>

                                                </a>
                                                <?php echo $video_data['cntdislike']; ?>
                                                <button name="share" class="btn"><a href="whatsapp://send?text=<?php echo "*SpacTube - Video Gallery on Child Education* %0a %0aI am sharing one important video on Child Education.%0ahttps://www.youtube.com/watch?v=" . $video_data['v_url'] . " %0a %0aYou can also subscribe to SpacTube by clicking on the following.%0ahttps://www.spacece.co/offerings/spactube %0a %0aThanks and Regards, %0aSpacECE India Foundation %0a %0awww.spacece.co %0awww.spacece.in %0a"; ?>" data-action="share/whatsapp/share" target="_blank"><i class="fas fa-share-alt" style="color:black"></i></a></button>
                                                <!-- <a href="comment.php">
                <button name="comment" class="btn"><img src="comments.png" style="justify-content: center; padding-left: 30%; height: 20px; width: 35px"></button>
            </a> -->

                                            </div>
                                        </div>
                                    </div>
                    <?php }
                            }
                        }
                    }
                    ?>
                </div>
                <?php if (!$fetch_video) {
                    echo "<h1 class='text-center d-flex justify-content-center'>Sorry Vidoes Not Found</h1>";
                } ?>
            </div>

        </div>

    </div>
<?php
} else {
    echo "<h5 class='text-center d-flex justify-content-center'>Please Subscribe for This Videos</h5>";
}
?>
<!-- <div class="container1" >
                
                <a href="user1.php">
                    <button type="button">Remove Video</button>
                </a>
    </div> -->




<div class="all-v-btn btn btn-outline-dark">
    <a href="home.php"><i class="fi-xwluxl-gear-wide fi-2x fi-flip-h"></i></a>
</div>

<!--End - Delete - Modal -->

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
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
              <img src="<?= isset($main_logo) ? $main_logo : '#' ?>" class="img img-fluid img-thumbnail img-circle" alt="Logo" style="width: 240px; height:240px; border:none;" />
            </a>
          </div>

          <!-- Contact Section -->
         <div class="col-md-3 mb-3 mt-5 text-start">
  <div class="contact-widget" style="color: black;">
    <h5 style="font-size: 20px !important;">Contact Us</h5>
    
    <p class="mb-3" style="font-size: 15px !important; margin-right: 120px !important;">
      <i class="fa-solid fa-phone text-warning me-2"></i> +91 90963 05648
    </p>
    
    <p class="mb-3" style="font-size: 15px !important; margin-right: 95px !important;">
      <i class="fas fa-envelope text-warning me-2"></i> events@spaceece.co
    </p>
    
    <p class="mb-3" style="font-size: 15px !important; margin-right: 120px !important;">
      <i class="fas fa-map-marker-alt text-warning me-2"></i> SPACE-ECE
    </p>
    
    <p class="mb-3" style="font-size: 15px !important; margin-right: 80px !important;">
      <i class="fas fa-clock text-warning me-2"></i> Mon - Sat 8 AM - 6 PM
    </p>
  </div>
</div>

          <!-- Health Message + Social Media -->
          <div class="col-md-3 mb-3 mt-5 text-start">
            <h5 class="text-warning" style="font-size:20px;">Still delaying treatment for your child's health concerns?</h5>
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

    </footer>

    <?= isset($extra_scripts) ? $extra_scripts : null ?>

    <script>
      $(document).ready(function() {
        $('#sub').on('submit', function(e) {
          e.preventDefault();
          var email = $('#email').val();

          $.ajax({
            method: "POST",
            url: "./common/function.php",
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