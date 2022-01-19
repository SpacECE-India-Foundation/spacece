<?php

require_once 'Config/Functions.php';
$Fun_call = new Functions();

include_once './header_local.php';
include_once '../common/header_module.php';
include_once '../common/banner.php';

$fetch_video = $Fun_call->select_order('videos', 'v_id', 'DESC');
$get_video = $Fun_call->selected_order('videos', 'filter');
// include 'Stylesheet/stylesheet.css';
?>
<link rel="stylesheet" href="css/share.css" class="real">
<div class="container-fluid">

   


    <div class="container">
    <div class="container"><br>
        <?php include 'menu.php'; ?>
    </div>
        <div class="ins-box">
            <div class="container">
                <ul class="nav justify-content-center bg-dark">
                    <li class="nav-item">
                        <div class="nav-link heading">Free Videos</div>
                    </li>
                </ul>
            </div>
            <br>
            <form action="" method="post">
                <select name="filterr">
                    <option value="all" selected>ALL</option>
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
                <input type="Submit" value="Submit" name="Submit">

                <?php
                $status = 'free';
                $filter_videos = $Fun_call->filter_video('videos', $abc, $status, 'v_id', 'DESC', '');

                ?>
            </form>
            <br><br>
            <form action="" method="post">
                <input type="search" name="filterr">
                <input type="Submit" value="Submit" name="Submit">

                <?php
                $status = 'free';
                $abc = $_POST['filterr'];
                $filter_videos = $Fun_call->filter_video('videos', null, $status, 'v_id', 'DESC', $abc);

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
                                       
                                        <button name="share" class="btn"><a href="whatsapp://send?text=<?php echo "*SpacTube - Video Gallery on Child Education* %0a %0aI am sharing one important video on Child Education.%0ahttps://www.youtube.com/watch?v=" . $video_data['v_url'] . " %0a %0aYou can also subscribe to SpacTube by clicking on the following.%0ahttps://www.spacece.co/offerings/spactube %0a %0aThanks and Regards, %0aSpacECE India Foundation %0a %0awww.spacece.co %0awww.spacece.in %0a"; ?>" data-action="share/whatsapp/share" target="_blank"><i class="fas fa-share-alt" style="color:black"></i></button>
                                        <div class="share-button sharer" style="display: block;">
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
                                            <!-- 0000035 -->
                                            <?php echo $video_data['cntdislike']; ?>
                                            
                                            <button name="share" class="btn"><a href="whatsapp://send?text=<?php echo "*SpacTube - Video Gallery on Child Education* %0a %0aI am sharing one important video on Child Education.%0ahttps://www.youtube.com/watch?v=" . $video_data['v_url'] . " %0a %0aYou can also subscribe to SpacTube by clicking on the following.%0ahttps://www.spacece.co/offerings/spactube %0a %0aThanks and Regards, %0aSpacECE India Foundation %0a %0awww.spacece.co %0awww.spacece.in %0a"; ?>" data-action="share/whatsapp/share" target="_blank"><i class="fas fa-share-alt" style="color:black"></i></button>
                                        <div class="share-button sharer" style="display: block;">
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
            <?php if (!$fetch_video) {
                echo "<h1 class='text-center'>Sorry Vidoes Not Found</h1>";
            } ?>
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
    <a href="home.php"><i class="fi-xwluxl-gear-wide fi-2x fi-flip-h"></i></a>
</div>


<?php include_once '../common/footer_module.php'; ?>
<script>
$( document ).ready(function() {
	//custom button for homepage
     $( ".share-btn" ).click(function(e) {
     	 $('.networks-5').not($(this).next( ".networks-5" )).each(function(){
         	$(this).removeClass("active");
    	 });
     
            $(this).next( ".networks-5" ).toggleClass( "active" );
    });   
});
    </script>
<!--End - Delete - Modal -->