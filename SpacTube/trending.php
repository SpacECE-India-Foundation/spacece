<?php

require_once 'Config/Functions.php';
$Fun_call = new Functions();
$fetch_video = "";
$trend_video_call = []; 
// Set videos per page
$videos_per_page = 12;

// Get current page from URL, default is 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate offset
$offset = ($page - 1) * $videos_per_page;


include_once './header_local.php';
include_once '../common/header_module.php';


$trend_video = $Fun_call->select_order('videos', 'cntlike', 'DESC');
$get_video = $Fun_call->selected_order('videos', 'filter', 'cntlike', 'DESC');

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=filter_alt" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="topright">
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
<body style="background-color: #eeeeee;">
<div class="container-fluid">

    <div class="container" style="margin-top: 45px; margin-left: 350px !important;">
        <?php include 'menu.php'; ?>
    </div>

<?php include_once '../common/banner.php'; ?>

<style>
    
.heading-title {
  color: rgb(37, 35, 35);
  font-size: 35px;
  font-weight: normal;
  text-align: left;
  margin: 0;
  padding: 0;
}
.search-container {
  display: flex;
  align-items: center;
  background-color: white;
  border: 1px solid #ccc;
  border-radius: 10px;
  padding: 0 10px;
  width: 220px;
  height: 40px;
}

.search-container input {
  border: none;
  outline: none;
  flex: 1;
  font-size: 14px;
}

.search-container button {
  background: none;
  border: none;
  cursor: pointer;
  color: #333;
  font-size: 16px;
}

select#filterr {
  height: 40px;
  padding: 0 12px;
  border-radius: 10px;
  font-size: 14px;
}

.top-filter-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.filter-search-form {
  display: flex;
  width: 100%;
  justify-content: space-between;
  gap: 10px;
}

.custom-select-wrapper {
  position: relative;
  width: 220px;
}

.custom-select {
  appearance: none;
  width: 100%;
  padding: 12px 40px 12px 40px;
  border: 1px solid #ccc;
  border-radius: 12px;
  background-color: white;
  font-size: 16px;
  color: #333;
  outline: none;
  cursor: pointer;
}

.custom-select:focus {
  border-color: #80bdff;
  box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.2);
}

.custom-select-icon {
  position: absolute;
  left: 12px;
  top: 50%;
  transform: translateY(-50%);
  font-size: 20px;
  color: #888;
  pointer-events: none;
}

.custom-select-arrow {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  font-size: 14px;
  color: #666;
  pointer-events: none;
}

a:hover i {
  color:rgb(242, 170, 46);
}

.pagination-container {
  display: flex;
  justify-content: center;
  align-items: center;
  background:rgb(255, 255, 255);
  border-radius: 16px;
  padding: 20px 40px;
  width: fit-content;
  margin: 30px auto;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  transform: translateX(117%);
}


.pagination-button {
  padding: 10px 18px;
  background: white;
  border: 2px solid #ccc;
  border-radius: 10px;
  text-decoration: none;
  color: black;
  font-weight: bold;
  font-size: 20px;
  margin: 0 5px;
}


.pagination-button.disabled {
  color: #aaa;
  pointer-events: none;
}

.pagination-page-info {
  font-size: 18px;
  color: #333;
  margin: 0 15px;
}


</style>

<div class="container">
  <div class="ins-box" style="border: none; box-shadow: none;">
  <div class="container">
    <div class="container">
      <div class="heading-title" style="color: black; text-align: left; margin-left: 0;">Our Free Videos</div>
    </div>
  </div>
</div>
            <br>
            <div class="top-filter-bar">
  <form action="trending.php" method="post" class="filter-search-form">
    <div class="search-container">
      <input type="text" name="search_query" placeholder="Search for videos" />
      <button type="submit" name="Submit">
        <i class="fas fa-search"></i>
      </button>
    </div>
    <div class="custom-select-wrapper">
  <span class="material-symbols-outlined custom-select-icon">filter_alt</span>
  <select class="custom-select" name="filterr" id="filterr" style="appearance: none; width: 100%; padding: 5px 40px 6px 30px; border: 1px solid #ccc; border-radius: 12px; background-color: white; font-size: 14px; color: #666; outline: none;">
    <option value="all">Filter</option>
    <?php
    if ($get_video) {
        foreach ($get_video as $video_data) {
            echo "<option value='" . $video_data['filter'] . "'>" . $video_data['filter'] . "</option>";
        }
    }
    ?>
  </select>
    </div>
  </form>
</div>


            <?php $abc = isset($_POST['filterr']) ? $_POST['filterr'] : 'all';
$search_query = isset($_POST['search_query']) ? trim($_POST['search_query']) : '';
$videos_per_page = 12;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $videos_per_page;

$search_query = isset($_POST['search_query']) ? trim($_POST['search_query']) : (isset($_GET['search_query']) ? trim($_GET['search_query']) : '');
$abc = isset($_POST['filterr']) ? $_POST['filterr'] : (isset($_GET['filterr']) ? $_GET['filterr'] : 'all');

$all_videos = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($search_query !== '') {
        $all_videos = $Fun_call->search_and_filter_videos('videos', $abc, $search_query);
    } else {
        $all_videos = $Fun_call->trend_video_cat('videos', $abc, 'views', 'DESC');
    }
} else {
    $all_videos = $Fun_call->select_order('videos', 'cntlike', 'DESC');
}

$total_videos = count($all_videos);
$total_pages = ceil($total_videos / $videos_per_page);
$trend_video_call = array_slice($all_videos, $offset, $videos_per_page);
?>
            <br>
            <div class="row row-cols-1 row-cols-md-2">
                <?php

                if ($trend_video_call) {
                    // var_dump($trend_video_call);
                    foreach ($trend_video_call as $video_data) {

                ?>
                            <div class="col mb-4">
                                <div class="card h-100">
                                    <div class="set-box youtube-video-r">
                                        <iframe width="560" height="316" src="https://www.youtube.com/embed/<?php echo $video_data['v_url']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


                                    </div>
                                    <div class="card-body pt-2 pb-2">
                                        <h6 class="card-title">
                                            <?php echo $video_data['title']; ?></h6>
                                        
                                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 20px;">

                                            <div style="display: flex; gap: 20px;">
                                              <a href="likecnt.php?btn=<?php echo $video_data['v_id']; ?>" style="color: #333; font-size: 22px;">
                                                <i class="fa-regular fa-thumbs-up"></i>
                                              </a>
                                              <a href="likecnt.php?btn1=<?php echo $video_data['v_id']; ?>" style="color: #333; font-size: 22px;">
                                                <i class="fa-regular fa-thumbs-down"></i>
                                              </a>
                                            </div>

                                            <a href="whatsapp://send?text=<?php echo '...'; ?>" target="_blank" style="color: #000; font-size: 22px;">
                                              <i class="fas fa-share-alt"></i>
                                            </a>
                                          </div>



<!-- <a href="comment.php">
                                <button name="comment" class="btn"><img src="comments.png" style="justify-content: center; padding-left: 30%; height: 20px; width: 35px"></button>
                            </a> -->

                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {


                    $i = 0;
                    if ($trend_video) {
                        foreach ($trend_video as $video_data) {
                            if ($i < 5) {
                                $i++;
                            ?>
                                <div class="col mb-4">
                                    <div class="card h-100">
                                        <div class="set-box youtube-video-r">
                                            <iframe width="560" height="316" src="https://www.youtube.com/embed/<?php echo $video_data['v_url']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


                                        </div>
                                        <div class="card-body pt-2 pb-2">
                                            <h6 class="card-title">
                                                <?php echo $video_data['title']; ?></h6>
                                           
                                                <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 20px;">
                                                
                                                <div style="display: flex; gap: 20px;">
                                                  <a href="likecnt.php?btn=<?php echo $video_data['v_id']; ?>" style="color: #333; font-size: 22px;">
                                                    <i class="fa-regular fa-thumbs-up"></i>
                                                  </a>
                                                  <a href="likecnt.php?btn1=<?php echo $video_data['v_id']; ?>" style="color: #333; font-size: 22px;">
                                                    <i class="fa-regular fa-thumbs-down"></i>
                                                  </a>
                                                </div>

                                                
                                                <a href="whatsapp://send?text=<?php echo '...'; ?>" target="_blank" style="color: #000; font-size: 22px;">
                                                  <i class="fas fa-share-alt"></i>
                                                </a>
                                              </div>


<!-- <a href="comment.php">
                                <button name="comment" class="btn"><img src="comments.png" style="justify-content: center; padding-left: 30%; height: 20px; width: 35px"></button>
                            </a> -->

                                        </div>
                                    </div>
                                </div>
                <?php
                            }
                        }
                    }
                } ?>

            </div>
            <?php if ($total_pages > 1): ?>
    <div class="pagination-container">
        <?php if ($page > 1): ?>
            <a class="pagination-button" href="?page=<?php echo $page - 1; ?>&filterr=<?php echo urlencode($abc); ?>&search_query=<?php echo urlencode($search_query); ?>">&lt;</a>
        <?php else: ?>
            <span class="pagination-button disabled">&lt;</span>
        <?php endif; ?>

        <span class="pagination-page-info">Page <?php echo $page; ?> of <?php echo $total_pages; ?></span>

        <?php if ($page < $total_pages): ?>
            <a class="pagination-button" href="?page=<?php echo $page + 1; ?>&filterr=<?php echo urlencode($abc); ?>&search_query=<?php echo urlencode($search_query); ?>">&gt;</a>
        <?php else: ?>
            <span class="pagination-button disabled">&gt;</span>
        <?php endif; ?>
    </div>
<?php endif; ?>


        </div>
    </div>



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