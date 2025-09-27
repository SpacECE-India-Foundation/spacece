<?php
error_reporting(E_ERROR | E_PARSE);

require_once 'Config/Functions.php';
$Fun_call = new Functions();
$videos_per_page = 12;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $videos_per_page;
$total_videos = count($Fun_call->select_where('videos', 'status', 'free'));
$fetch_video = $Fun_call->select_order_limit_where('videos', 'v_id', 'DESC', 'status', 'free', $videos_per_page, $offset);
$total_pages = ceil($total_videos / $videos_per_page);
$get_video = $Fun_call->selected_order('videos', 'filter');

include_once './header_local.php';
include_once '../common/header_module.php';

if (empty($_SESSION['current_user_id'])) {
    echo '<script>
    alert("User must be logged in!!");
    window.location.href = "../spacece_auth/login.php";
  </script>';
    exit;
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=filter_alt" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="css/share.css" class="real">
<link rel="stylesheet" href="./src/ALightBox.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="container-fluid">
    <body>
        <div class="container" style="margin-left: 350px !important;"><br>
            <?php include 'menu.php'; ?>
        </div>
        <?php include_once '../common/banner.php'; ?>
        
        <style>
            body {
                background: #eeeeee;
                font-family: Arial, sans-serif !important;
            }

            .custom-pagination {
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #ffffff;
                border-radius: 12px;
                padding: 15px 25px;
                margin-top: 40px;
                gap: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                width: fit-content;
                margin-left: auto;
                margin-right: 100px;
                margin-bottom: 30px;
            }

            .arrow-button {
                background-color: #f5f5f5;
                border: 1px solid #ccc;
                border-radius: 8px;
                padding: 10px 15px;
                font-size: 20px;
                text-decoration: none;
                color: #333;
                transition: all 0.2s ease;
            }

            .arrow-button:hover {
                background-color: #e2e2e2;
            }

            .page-label {
                font-size: 18px;
                color: #333;
            }

            .top-bar {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 20px;
                padding: 10px 0;
            }

            .search-form,
            .filter-form {
                display: flex;
                align-items: center;
            }

            .search-box,
            .filter-box {
                display: flex;
                align-items: center;
                border: 1px solid #ccc;
                padding: 8px 12px;
                border-radius: 8px;
                background: white;
            }

            .search-input {
                border: none;
                outline: none;
                font-size: 14px;
            }

            .search-button {
                background: none;
                border: none;
                cursor: pointer;
                padding-left: 10px;
            }

            .search-button i {
                color: #000;
                font-size: 16px;
            }

            .filter-icon {
                margin-right: 8px;
                color: #888;
                font-size: 16px;
            }

            .filter-select {
                border: none;
                outline: none;
                font-size: 14px;
                background: transparent;
            }

            .filter-form {
                margin: 20px 0;
            }

            .filter-box {
                display: flex;
                align-items: center;
                background-color: white;
                border: 1px solid #ccc;
                border-radius: 10px;
                padding: 6px 12px;
                width: 280px;
                position: relative;
            }

            .filter-select {
                flex: 1;
                border: none;
                background: transparent;
                font-size: 14px;
                color: #333;
                outline: none;
                appearance: none;
                background-image: url('data:image/svg+xml;utf8,<svg fill="black" height="12" viewBox="0 0 24 24" width="12" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>');
                background-repeat: no-repeat;
                background-position: right 8px center;
                background-size: 12px;
                padding-right: 20px;
            }

            .row {
                row-gap: 30px;
            }

            .search-form {
                margin: 20px 0;
            }

            .search-box {
                display: flex;
                align-items: center;
                border: 1px solid #ccc;
                border-radius: 8px;
                padding: 6px 12px;
                background-color: white;
                width: 280px;
            }

            .search-input {
                flex: 1;
                border: none;
                outline: none;
                font-size: 14px;
                background: transparent;
                color: #333;
            }

            .search-button {
                background: none;
                border: none;
                font-size: 16px;
                cursor: pointer;
                color: #000;
            }

            .container {
                display: grid;
                gap: 20px;
                border: none !important;
                box-shadow: none !important;
                background: none !important;
            }

            .ins-box {
                border: none !important;
                box-shadow: none !important;
                background: none !important;
            }

            .card {
                padding: 0;
                border: none;
            }

            img {
                width: 100%;
                height: auto;
            }

            img#thumb {
                margin: 0;
                padding: 0;
                border: none;
                display: block;
                height: 280px;
            }

            /* YouTube Thumbnail Styling */
            .youtube-thumbnail {
                width: 100%;
                height: 280px;
                object-fit: cover;
                border-radius: 8px;
                cursor: pointer;
                transition: transform 0.2s ease;
            }

            .youtube-thumbnail:hover {
                transform: scale(1.02);
            }

            .youtube-video-container {
                position: relative;
                width: 100%;
                height: 280px;
                border-radius: 8px;
                overflow: hidden;
                cursor: pointer;
            }

            .youtube-video-container::after {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 60px;
                height: 60px;
                background: rgba(255, 0, 0, 0.8);
                border-radius: 50%;
                background-image: url('data:image/svg+xml;utf8,<svg fill="white" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M8 5v14l11-7z"/></svg>');
                background-repeat: no-repeat;
                background-position: center;
                background-size: 24px;
                opacity: 0.9;
                transition: opacity 0.3s ease;
            }

            .youtube-video-container:hover::after {
                opacity: 1;
            }

            .heading-title {
                color: rgb(37, 35, 35);
                font-family: Arial, sans-serif;
                font-size: 35px;
                font-weight: normal;
                text-align: left;
                margin: 0;
                padding: 0;
            }

            .no-padding-container {
                padding-left: 0 !important;
                padding-right: 0 !important;
            }

            /* Like/Dislike button styles */
            .action-btn {
                background: none !important;
                border: none !important;
                padding: 0 !important;
                margin: 0 !important;
                cursor: pointer;
                transition: color 0.2s ease;
            }

            .action-btn:hover i {
                color: #333 !important;
            }

            .action-btn.liked i {
                color: #1976d2 !important;
            }

            .action-btn.disliked i {
                color: #d32f2f !important;
            }

            /* Share button improvements */
            .share-button {
                position: relative;
            }

            .social.networks-5 {
                position: absolute;
                top: 100%;
                right: 0;
                background: white;
                border: 1px solid #ddd;
                border-radius: 8px;
                padding: 10px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                z-index: 1000;
                display: none;
                min-width: 200px;
            }

            .social.networks-5.active {
                display: block !important;
            }

            .fbtn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 35px;
                height: 35px;
                border-radius: 50%;
                color: white;
                text-decoration: none;
                margin: 2px;
                transition: transform 0.2s ease;
            }

            .fbtn:hover {
                transform: scale(1.1);
            }

            .fbtn.facebook { background: #3b5998; }
            .fbtn.twitter { background: #1da1f2; }
            .fbtn.linkedin { background: #0077b5; }
            .fbtn.pinterest { background: #bd081c; }
            .fbtn.gplus { background: #dd4b39; }
        </style>

        <div class="container">
            <div class="ins-box">
                <div class="container">
                    <div class="no-padding-container">
                        <div class="heading-title">Our Free Videos</div>
                    </div>
                </div>
                <br>
                
                <div class="top-bar">
                    <form action="" method="post" class="search-form">
                        <div class="search-box">
                            <input type="search" name="filterr" id="filterr" class="search-input" placeholder="Search for videos">
                            <button type="submit" name="Submit" class="search-button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    
                    <form action="" method="post" class="filter-form">
                        <div class="filter-box">
                            <span class="material-symbols-outlined filter-icon" style="color: #333;">filter_alt</span>
                            <select name="filterr" class="filter-select" onchange="this.form.submit()">
                                <option value="all" selected>Filter</option>
                                <?php
                                if ($get_video) {
                                    foreach ($get_video as $video_data) {
                                        echo "<option value='" . htmlspecialchars($video_data['filter']) . "'>" . htmlspecialchars($video_data['filter']) . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <br>
            <div class="row row-cols-1 row-cols-md-2 custom-gap">
                <?php
                $status = 'free';
                $abc = isset($_POST['filterr']) ? $_POST['filterr'] : 'all';
                $filter_videos = $Fun_call->filter_video('videos', ($abc != 'all' ? $abc : null), $status, 'v_id', 'DESC', '');

                if ($filter_videos && count($filter_videos) > 0) {
                    foreach ($fetch_video as $video_data) {
                        if ($video_data['status'] == "free") {
                            if ($abc == "all" || $abc == NULL || $video_data['filter'] == $abc) {
                                // Extract YouTube video ID
                                $video_url = $video_data['v_url'];
                                $video_id = $video_url;
                                
                                // If it's a full YouTube URL, extract the ID
                                if (strpos($video_url, 'youtube.com/watch?v=') !== false) {
                                    parse_str(parse_url($video_url, PHP_URL_QUERY), $query);
                                    $video_id = isset($query['v']) ? $query['v'] : $video_url;
                                } elseif (strpos($video_url, 'youtu.be/') !== false) {
                                    $video_id = substr(parse_url($video_url, PHP_URL_PATH), 1);
                                }
                ?>   
                                <div class="col mb-4">
                                    <div class="card h-100">
                                      <!--0000510: In the Spacetube section, under "Our Free Videos," clicking on interactive buttons like Like, Dislike, or Share immediately cau-->
                                        <div class="set-box youtube-video-r t" data-title="Landscape">
                                            <div class="youtube-video-container">
                                                <a class="alb_item mt-2 d-flex align-content-center" href="https://www.youtube.com/watch?v=<?php echo htmlspecialchars($video_id); ?>">
                                                    <img src="https://img.youtube.com/vi/<?php echo htmlspecialchars($video_id); ?>/maxresdefault.jpg" 
                                                         alt="<?php echo htmlspecialchars($video_data['title']); ?>" 
                                                         class="youtube-thumbnail"
                                                         onerror="this.src='https://img.youtube.com/vi/<?php echo htmlspecialchars($video_id); ?>/hqdefault.jpg';">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body pt-2 pb-2">
                                            <!-- Video Title -->
                                            <h6 class="card-title"><?php echo htmlspecialchars($video_data['title']); ?></h6>

                                            <!-- Likes/Dislikes + Share Row -->
                                            <div style="display: flex; align-items: center; justify-content: space-between; padding: 10px 0;">
                                                <div style="display: flex; align-items: center; gap: 20px;">
                                                    <a href="btn" class="action-btn like-btn" data-video-id="<?php echo $video_data['v_id']; ?>" style="text-decoration: none;">
                                                        <i class="far fa-thumbs-up" style="font-size: 24px; color: black;"></i>
                                                    </a>

                                                    <a href="btn1" class="action-btn dislike-btn" data-video-id="<?php echo $video_data['v_id']; ?>" style="text-decoration: none;">
                                                        <i class="far fa-thumbs-down" style="font-size: 24px; color: black;"></i>
                                                    </a>
                                                </div>

                                                <!-- Share Button -->
                                                <div class="share-button sharer" style="display: flex; align-items: center; position: relative;">
                                                    <button name="share" class="btn share-toggle-btn" data-video-id="<?php echo $video_data['v_id']; ?>" style="background: none; border: none; padding: 0; margin: 0;">
                                                        <i class="fas fa-share-alt" style="font-size: 24px; color: black;"></i>
                                                    </button>
                                                    <div class="social top center networks-5" id="share-panel-<?php echo $video_data['v_id']; ?>">
                                                        <!-- Facebook Share Button -->
                                                        <a class="fbtn share facebook" href="https://www.facebook.com/sharer/sharer.php?u=https://www.youtube.com/watch?v=<?php echo htmlspecialchars($video_id); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                                                        <!-- Google Plus Share Button -->
                                                        <a class="fbtn share gplus" href="https://plus.google.com/share?url=https://www.youtube.com/watch?v=<?php echo htmlspecialchars($video_id); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
                                                        <!-- Twitter Share Button -->
                                                        <a class="fbtn share twitter" href="https://twitter.com/intent/tweet?text=<?php echo urlencode($video_data['title']); ?>&amp;url=https://www.youtube.com/watch?v=<?php echo htmlspecialchars($video_id); ?>&amp;via=spacece" target="_blank"><i class="fa fa-twitter"></i></a>
                                                        <!-- Pinterest Share Button -->
                                                        <a class="fbtn share pinterest" href="https://pinterest.com/pin/create/button/?url=https://www.youtube.com/watch?v=<?php echo htmlspecialchars($video_id); ?>&amp;description=<?php echo urlencode($video_data['title']); ?>&amp;media=https://img.youtube.com/vi/<?php echo htmlspecialchars($video_id); ?>/maxresdefault.jpg" target="_blank"><i class="fa fa-pinterest"></i></a>
                                                        <!-- LinkedIn Share Button -->
                                                        <a class="fbtn share linkedin" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://www.youtube.com/watch?v=<?php echo htmlspecialchars($video_id); ?>&amp;title=<?php echo urlencode($video_data['title']); ?>&amp;source=spacece" target="_blank"><i class="fa fa-linkedin"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                <?php
                            }
                        }
                    }
                } else {
                ?>
                    <div class="col-12">
                        <h1 class='text-center'>Sorry Videos Not Found</h1>
                    </div>
                <?php
                }
                ?>
            </div>
            
            <?php if (empty($fetch_video)): ?>
                <h1 class='text-center'>Sorry Videos Not Found</h1>
            <?php endif; ?>
        </div>

        <?php
        $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $prev_page = max($current_page - 1, 1);
        $next_page = min($current_page + 1, $total_pages);
        ?>
        <div class="custom-pagination">
            <a href="?page=<?php echo $prev_page; ?>" class="arrow-button">&lt;</a>
            <span class="page-label">Page <?php echo $current_page; ?> of <?php echo $total_pages; ?></span>
            <a href="?page=<?php echo $next_page; ?>" class="arrow-button">&gt;</a>
        </div>

        <div class="all-v-btn btn btn-outline-dark">
            <a href="home.html"><i class="fi-xwluxl-gear-wide fi-2x fi-flip-h"></i></a>
        </div>
    </body>
</div>

<!-- Footer -->
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
                    <p class="mb-3 fs-6" style="text-align: left; font-size:15px !important;">Connect with India's top doctors online, today!</p>
                    <h5 style="font-size:20px">Our Socials</h5>
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

    <script>
        $(document).ready(function() {
            // Like button functionality
            $('.like-btn').on('click', function(e) {
                e.preventDefault();
                const videoId = $(this).data('video-id');
                const button = $(this);
                
                $.ajax({
                    url: 'likecnt.php',
                    type: 'GET',
                    data: { btn: videoId },
                    success: function(response) {
                        button.toggleClass('liked');
                        if (button.hasClass('liked')) {
                            button.find('i').removeClass('far').addClass('fas');
                            const dislikeBtn = button.siblings('.dislike-btn');
                            dislikeBtn.removeClass('disliked');
                            dislikeBtn.find('i').removeClass('fas').addClass('far');
                        } else {
                            button.find('i').removeClass('fas').addClass('far');
                        }
                    },
                    error: function() {
                        swal("Error!", "Unable to process your request.", "error");
                    }
                });
            });

            // Dislike button functionality
            $('.dislike-btn').on('click', function(e) {
                e.preventDefault();
                const videoId = $(this).data('video-id');
                const button = $(this);
                
                $.ajax({
                    url: 'likecnt.php',
                    type: 'GET',
                    data: { btn1: videoId },
                    success: function(response) {
                        button.toggleClass('disliked');
                        if (button.hasClass('disliked')) {
                            button.find('i').removeClass('far').addClass('fas');
                            const likeBtn = button.siblings('.like-btn');
                            likeBtn.removeClass('liked');
                            likeBtn.find('i').removeClass('fas').addClass('far');
                        } else {
                            button.find('i').removeClass('fas').addClass('far');
                        }
                    },
                    error: function() {
                        swal("Error!", "Unable to process your request.", "error");
                    }
                });
            });

            // Share button functionality
            $('.share-toggle-btn').on('click', function(e) {
                e.preventDefault();
                const videoId = $(this).data('video-id');
                const sharePanel = $('#share-panel-' + videoId);
                
                $('.social.networks-5').not(sharePanel).removeClass('active');
                sharePanel.toggleClass('active');
            });

            // Hide share panels when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.share-button').length) {
                    $('.social.networks-5').removeClass('active');
                }
            });

            // ALightBox initialization for video thumbnails
            $('.alightbox').alightbox({ type: 'video' });
        });
    </script>
</body>
</html>