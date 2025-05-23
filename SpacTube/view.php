<?php
error_reporting(E_ERROR | E_PARSE);
?>

<?php

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



// include 'Stylesheet/stylesheet.css';
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=filter_alt" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="css/share.css" class="real">
<link rel="stylesheet" href="./src/ALightBox.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="container-fluid">

    <body>
        <div class="container"><br>
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

            .filter-icon {
                font-size: 16px;
                margin-right: 8px;
                color: #888;
                /* soft gray */
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
                /* Gap between rows */
                /*column-gap: 0.5px; /* Gap between columns */
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
                /* or adjust as needed */
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
                        <?php
                        $status = 'free';
                        $abc = $_POST['filterr'];
                        $filter_videos = $Fun_call->filter_video('videos', null, $status, 'v_id', 'DESC', $abc);
                        ?>
                    </form>
                    <form action="" method="post" class="filter-form">
                        <div class="filter-box">
                            <!-- Material Symbols filter_alt icon -->
                            <span class="material-symbols-outlined filter-icon" style="color: #333;">filter_alt</span>
                            <select name="filterr" class="filter-select">
                                <option value="all" selected>Filter</option>
                                <?php
                                $abc = "all";
                                if ($get_video) {
                                    foreach ($get_video as $video_data) {
                                        echo "<option value='" . $video_data['filter'] . "'>" . $video_data['filter'] . "</option>";
                                    }
                                }
                                $abc = $_POST['filterr'];
                                ?>
                            </select>
                        </div>
                        <?php
                        $status = 'free';
                        $filter_videos = $Fun_call->filter_video('videos', $abc, $status, 'v_id', 'DESC', '');
                        ?>
                    </form>
                </div>

            </div>

            <br>
            <div class="row row-cols-1 row-cols-md-2 custom-gap">
                <?php
                //var_dump($filter_videos);
                if ($filter_videos) {

                    foreach ($fetch_video as $video_data) {

                        if ($abc == "all" || $abc == NULL) {
                            if ($video_data['status'] ==  "free") {
                ?>
                                <div class="col mb-4">
                                    <div class="card h-100">
                                        <div class="set-box youtube-video-r t" data-title="Landscape">

                                            <a class="alb_item mt-2 d-flex align-content-center" href="https://www.youtube.com/watch?v=<?php echo $video_data['v_url']; ?>">Youtube 2</a>
                                            <!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php //echo $video_data['v_url']; 
                                                                                                                        ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->

                                        </div>
                                        <div class="card-body pt-2 pb-2">
                                            <?php include 'options.php'; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        } else if ($video_data['status'] ==  "free") {
                            ?>
                            <div class="col mb-4">
                                <div class="card h-100">
                                    <div class="set-box youtube-video-r t d-flex align-content-center" data-title="Landscape">

                                        <a class="alb_item  mt-2 " href="https://www.youtube.com/watch?v=<?php echo $video_data['v_url']; ?>">Youtube 2</a>
                                        <!-- <iframe width="460" height="275" src="https://www.youtube.com/embed/<?php // echo $video_data['v_url']; 
                                                                                                                    ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->

                                    </div>
                                    <div class="card-body pt-2 pb-2">
                                        <!-- Video Title -->
                                        <h6 class="card-title"><?php echo $video_data['title']; ?></h6>

                                        <!-- Likes/Dislikes + Share Row -->
                                        <div style="display: flex; align-items: center; justify-content: space-between; padding: 10px 0;">
                                            <div style="display: flex; align-items: center; gap: 20px;">
                                                <a href="likecnt.php?btn=<?php echo $video_data['v_id']; ?>" style="text-decoration: none;">
                                                    <i class="far fa-thumbs-up" style="font-size: 24px; color: black;"></i>
                                                </a>

                                                <a href="likecnt.php?btn1=<?php echo $video_data['v_id']; ?>" style="text-decoration: none;">
                                                    <i class="far fa-thumbs-down" style="font-size: 24px; color: black;"></i>
                                                </a>
                                            </div>

                                            <!-- Share Button -->
                                            <div class="share-button sharer" style="display: flex; align-items: center;">
                                                <button name="share" class="btn" style="background: none; border: none; padding: 0; margin: 0;">
                                                    <i class="fas fa-share-alt" style="font-size: 24px; color: black;"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-success share-btn">Share</button>
                                    <div class="social top center networks-5 ">
                                        <!-- Facebook Share Button -->
                                        <a class="fbtn share facebook" href="https://www.facebook.com/sharer/sharer.php?u=url"><i class="fa fa-facebook"></i></a>
                                        <!-- Google Plus Share Button -->
                                        <a class="fbtn share gplus" href="https://plus.google.com/share?url=url"><i class="fa fa-google-plus"></i></a>
                                        <!-- Twitter Share Button -->
                                        <a class="fbtn share twitter" href="https://twitter.com/intent/tweet?text=title&amp;url=url&amp;via=creativedevs"><i class="fa fa-twitter"></i></a>
                                        <!-- Pinterest Share Button -->
                                        <a class="fbtn share pinterest" href="https://pinterest.com/pin/create/button/?url=url&amp;description=data&amp;media=image"><i class="fa fa-pinterest"></i></a>

                                        <!-- LinkedIn Share Button -->
                                        <a class="fbtn share linkedin" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=url&amp;title=title&amp;source=url/"><i class="fa fa-linkedin"></i></a>
                                        </a>
                                    </div>
                                </div>

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
                        <div class="set-box youtube-video-r t" data-title="Landscape">

                            <a class="alb_item col-sm-3 mt-2 d-flex align-content-center" href="https://www.youtube.com/watch?v=<?php echo $video_data['v_url']; ?>">Youtube 2</a>
                            <!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php // $video_data['v_url']; 
                                                                                                        ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                        </div>
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
            <div id="myvideos" name="myvideos" data-title="Landscape" class="t col-sm-3">


                <a class="alb_item  mt-2 d-flex align-content-center" href="https://www.youtube.com/watch?v=<?php echo $video_data['v_url']; ?>">Youtube 2</a>
            </div>
            <!-- <iframe width="460" height="275" src="https://www.youtube.com/embed/<?php //echo $video_data['v_url']; 
                                                                                        ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
        </div>
        <div class="card-body pt-2 pb-2">
            <!-- Video Title -->
            <h6 class="card-title" style="color: orange !important;"><?php echo $video_data['title']; ?></h6>

            <!-- Likes/Dislikes + Share Row -->
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 10px 0;">
                <div style="display: flex; align-items: center; gap: 20px;">
                    <a href="likecnt.php?btn=<?php echo $video_data['v_id']; ?>" style="text-decoration: none;">
                        <i class="far fa-thumbs-up" style="font-size: 24px; color: black;"></i>
                    </a>

                    <a href="likecnt.php?btn1=<?php echo $video_data['v_id']; ?>" style="text-decoration: none;">
                        <i class="far fa-thumbs-down" style="font-size: 24px; color: black;"></i>
                    </a>
                </div>


                <!-- Share Button -->
                <div class="share-button sharer" style="display: flex; align-items: center;">
                    <button name="share" class="btn" style="background: none; border: none; padding: 0; margin: 0;">
                        <i class="fas fa-share-alt" style="font-size: 24px; color: black;"></i>
                    </button>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-success share-btn">Share</button>
        <div class="social top center networks-5 ">
            <!-- Facebook Share Button -->
            <a class="fbtn share facebook" href="https://www.facebook.com/sharer/sharer.php?u=url"><i class="fa fa-facebook"></i></a>
            <!-- Google Plus Share Button -->
            <a class="fbtn share gplus" href="https://plus.google.com/share?url=url"><i class="fa fa-google-plus"></i></a>
            <!-- Twitter Share Button -->
            <a class="fbtn share twitter" href="https://twitter.com/intent/tweet?text=title&amp;url=url&amp;via=creativedevs"><i class="fa fa-twitter"></i></a>
            <!-- Pinterest Share Button -->
            <a class="fbtn share pinterest" href="https://pinterest.com/pin/create/button/?url=url&amp;description=data&amp;media=image"><i class="fa fa-pinterest"></i></a>

            <!-- LinkedIn Share Button -->
            <a class="fbtn share linkedin" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=url&amp;title=title&amp;source=url/"><i class="fa fa-linkedin"></i></a>
            </a>
        </div>
    </div>



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
<?php if (empty($fetch_video)) {
    echo "<h1 class='text-center'>Sorry Vidoes Not Found</h1>";
} ?>
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





<!-- <div class="container1" >
                <a href="trending.php">
                    <button type="button">Trending Videos</button>
                </a>
                <a href="recents.php">
                    <button type="button">Recently Watched</button>
                </a>
                <a href="user1.php">
                    <button type="button">Remove Video</button>
                </a>
            </div> -->
</div>

</div>
<div class="all-v-btn btn btn-outline-dark">
    <a href="home.html"><i class="fi-xwluxl-gear-wide fi-2x fi-flip-h"></i></a>
</div>
</body>

<?php include_once '../common/footer_module.php'; ?>
<script>
    $(document).ready(function() {
        //custom button for homepage
        $(".share-btn").click(function(e) {
            $('.networks-5').not($(this).next(".networks-5")).each(function() {
                $(this).removeClass("active");
            });

            $(this).next(".networks-5").toggleClass("active");
        });
    });
</script>
<!--End - Delete - Modal -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="./src/ALightBox.js"></script>

<script type="text/javascript">
    $('body').ALightBox({
        showYoutubeThumbnails: true
    });
</script>
<script>
    $('#alb_icon_close').on('click', function() {

        console.log("Close");
        //   $('video').trigger('pause');
        var myVideo = document.getElementsByClassName("video-stream");


        myVideo.pause();
    })
</script>