<?php

require_once 'Config/Functions.php';
$Fun_call = new Functions();

include_once './header_local.php';
include_once '../common/header_module.php';
include_once '../common/banner.php';

$status = 'false';
if (isset($_SESSION['current_user_email'])) {
    $table = 'webhook';
    //$email='yashasvipundeer@gmail.com';
    $status =  $Fun_call->checkSubscription($table, $email);
}


$fetch_video = $Fun_call->select_order('videos', 'v_id', 'DESC');
$get_video = $Fun_call->selected_order('videos', 'filter');

?>

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
<?php
if ($status === true) {


?>
    <div class="container-fluid">

        <div class="container">
            <?php include 'menu.php'; ?>
        </div>





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
                    echo "<h1 class='text-center'>Sorry Vidoes Not Found</h1>";
                } ?>
            </div>

        </div>

    </div>
<?php
} else {
    echo "Please Subscribe for This Videos";
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

<?php include_once '../common/footer_module.php'; ?>