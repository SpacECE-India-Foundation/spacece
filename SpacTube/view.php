<?php
error_reporting(E_ERROR | E_PARSE);

require_once 'Config/Functions.php';
$Fun_call = new Functions();

include_once './header_local.php';
include_once '../common/header_module.php';
include_once '../common/banner.php';

$fetch_video = $Fun_call->select_order('videos', 'v_id', 'DESC');
$get_video = $Fun_call->selected_order('videos', 'filter');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Gallery</title>
    <link rel="stylesheet" href="css/share.css" class="real">
    <link rel="stylesheet" href="./src/ALightBox.css">
    <style>
        img {
            width: 100%;
            height: auto;
        }
        img#thumb {
            height: 180px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="container"><br>
            <?php include 'menu.php'; ?>
        </div>

        <div class="container">
            <div class="ins-box">
                <div class="container">
                    <ul class="nav justify-content-center bg-dark">
                        <li class="nav-item">
                            <div class="nav-link heading">Free Videos</div>
                        </li>
                    </ul>
                </div>
                <br>

                <!-- Filter Form -->
                <form action="" method="post">
                    <select name="filterr">
                        <option value="all" <?php echo isset($_POST['filterr']) && $_POST['filterr'] == 'all' ? 'selected' : ''; ?>>ALL</option>
                        <?php
                        if ($get_video) {
                            foreach ($get_video as $video_data) {
                                $selected = isset($_POST['filterr']) && $_POST['filterr'] == $video_data['filter'] ? 'selected' : '';
                                echo "<option value='" . $video_data['filter'] . "' $selected>" . $video_data['filter'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <input type="submit" value="Filter" name="Submit">
                </form>
                <br><br>

                <!-- Search Form -->
                <form action="" method="post">
                    <input type="search" name="search" id="search" placeholder="Search..." value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>">
                    <input type="submit" value="Search" name="Submit">
                </form>
                <br><br>

                <div class="row row-cols-1 row-cols-md-3">
                    <?php
                    $status = 'free';
                    $filter = isset($_POST['filterr']) ? $_POST['filterr'] : 'all';
                    $search = isset($_POST['search']) ? $_POST['search'] : '';

                    // Update filter condition: if filter is 'all', fetch all videos, otherwise filter by the selected filter
                    if ($filter === 'all') {
                        $filter_videos = $Fun_call->filter_video('videos', null, $status, 'v_id', 'DESC', $search);
                    } else {
                        $filter_videos = $Fun_call->filter_video('videos', $filter, $status, 'v_id', 'DESC', $search);
                    }

                    if ($filter_videos) {
                        foreach ($filter_videos as $video_data) {
                            if ($video_data['status'] == "free") {
                    ?>
                                <div class="col mb-4">
                                    <div class="card h-100">
                                        <div class="set-box youtube-video-r t" data-title="Landscape">
                                            <a class="alb_item mt-2 d-flex align-content-center" href="https://www.youtube.com/watch?v=<?php echo $video_data['v_url']; ?>">Youtube 2</a>
                                        </div>
                                        <div class="card-body pt-2 pb-2">
                                            <h6 class="card-title"><?php echo $video_data['title']; ?></h6>
                                            <?php echo $video_data['v_date']; ?><br>
                                            <a href="likecnt.php?btn=<?php echo $video_data['v_id'] ?>">
                                                <button name="likecnt" class="btn"><i class="fas fa-thumbs-up" style="color:black"></i></button>
                                            </a>
                                            <?php echo $video_data['cntlike']; ?>
                                            <a href="likecnt.php?btn1=<?php echo $video_data['v_id'] ?>">
                                                <button name="dislikecnt" class="btn"><i class="fas fa-thumbs-down" style="color:black"></i></button>
                                            </a>
                                            <?php echo $video_data['cntdislike']; ?>
                                            <button name="share" class="btn">
                                                <a href="whatsapp://send?text=<?php echo "*SpacTube - Video Gallery on Child Education* %0a %0aI am sharing one important video on Child Education.%0ahttps://www.youtube.com/watch?v=" . $video_data['v_url'] . " %0a %0aYou can also subscribe to SpacTube by clicking on the following.%0ahttps://www.spacece.co/offerings/spactube %0a %0aThanks and Regards, %0aSpacECE India Foundation %0a %0awww.spacece.co %0awww.spacece.in %0a"; ?>" data-action="share/whatsapp/share" target="_blank"><i class="fas fa-share-alt" style="color:black"></i></a>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                    } else {
                        echo "<h1 class='text-center'>Sorry, Videos Not Found</h1>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="all-v-btn btn btn-outline-dark">
        <a href="home.html"><i class="fi-xwluxl-gear-wide fi-2x fi-flip-h"></i></a>
    </div>

    <?php include_once '../common/footer_module.php'; ?>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="./src/ALightBox.js"></script>
    <script type="text/javascript">
        $('body').ALightBox({
            showYoutubeThumbnails: true
        });

        $(document).ready(function() {
            $(".share-btn").click(function(e) {
                $('.networks-5').not($(this).next(".networks-5")).each(function(){
                    $(this).removeClass("active");
                });

                $(this).next(".networks-5").toggleClass("active");
            });

            $('#alb_icon_close').on('click', function(){
                console.log("Close");
                var myVideo = document.getElementsByClassName("video-stream"); 
                for (var i = 0; i < myVideo.length; i++) {
                    myVideo[i].pause(); 
                }
            });
        });
    </script>
</body>
</html>