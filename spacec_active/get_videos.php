<?php 
session_start();
include_once 'Youtube/class-db.php';

if(isset($_POST['myVideo'])){

    if (isset($_SESSION['current_user_email'])) {
        $act_id=$_POST['act_id'];
        
        $user = $_SESSION['current_user_email'];
        
        echo "<div class='row'>";
        $db = new DB();
        $videos = $db->get_Videos($user,$act_id);
    
        
    
        echo '<div class="row col-lg-11" >';
    
    // $video_id = isset($video['video_id']) ? ($video['video_id']) : NULL;
        if (count($videos)>0){
            foreach ($videos as $video) {
            $video_id = isset($video['video_id']) ? ($video['video_id']) : NULL;
            //$video_id;
            echo '<a class="alb_item col-3 mt-2" href="https://www.youtube.com/watch?v='.$video_id.'">Youtube 2</a>';
            }
            
            echo '<script type="text/javascript">$("body").ALightBox({showYoutubeThumbnails: true});</script>';
        
        }else{
            echo  "No Data Found";
        }
        
        echo "</div>";
        echo "</div>";
        }
}

if(isset($_POST['all'])){
    $act_id=$_POST['act_id'];
    if (isset($_SESSION['current_user_email'])) {
                
       
        $user = $_SESSION['current_user_email'];
        echo '<div class="row col-lg-11" >';
        
        $db = new DB();
        $videos = $db->get_all_Videos($act_id,$user);
  
        if (count($videos)>0){
        foreach ($videos as $video) {
            $video_id = isset($video['video_id']) ? ($video['video_id']) : NULL;

            echo '<a class="alb_item col-3 mt-2" href="https://www.youtube.com/watch?v='.$video_id.'">Youtube 2</a>';
            // echo '<div class="col-md-6"  id="videosList2" name="videosList2" onClick="fullscreen()"><iframe  id="videosList" width="250" height="180"
            //        src="https://www.youtube.com/embed/' .  $video_id . '"
            //        frameBorder="0" allow="accelerometer";encrypted-media;gyroscope;picture-in-picture"allowfullscreen>
            //        </iframe></div>';
            
            }
            echo '<script type="text/javascript">$("body").ALightBox({showYoutubeThumbnails: true});</script>';
        }else{
            echo "No data found";
        }
        echo "</div>";
    
    }else{
        
        echo '<div class="row col-lg-11" >';
        $db = new DB();
        $videos = $db->get_all_Videos($act_id);
     
       if (count($videos)>0){

        foreach ($videos as $video) {
            $video_id = isset($video['video_id']) ? ($video['video_id']) : NULL;

            echo '<a class="alb_item col-3 mt-2" href="https://www.youtube.com/watch?v='.$video_id.'">Youtube 2</a>';
            // echo '<div class="col-md-6"  id="videosList2" name="videosList2" onClick="fullscreen()"><iframe width="250" height="180"  id="videosList"
            //        src="https://www.youtube.com/embed/' .  $video_id . '"
            //        frameBorder="0" allow="accelerometer";encrypted-media;gyroscope;picture-in-picture"allowfullscreen onClick="fullscreen()">
            //        </iframe>';

            }
            echo '<script type="text/javascript">$("body").ALightBox({showYoutubeThumbnails: true});</script>';
        }else{
            echo "No data Found";
        }
    }
      
    echo "</div>";
}
