<?php 
session_start();
include_once 'Youtube/class-db.php';
include_once 'Youtube/class-db.php';


if(isset($_POST['myVideo'])){


if (isset($_SESSION['current_user_email'])) {
     $cat_id=1;
    
     $user = $_SESSION['current_user_email'];
    
     echo "<div class='row'>";
     $db = new DB();
     $videos = $db->get_Videos($user,$cat_id);
     
     if(sizeof($videos) < 2){
        echo "<div class='col-md-6'>";
        echo "NO Data Found";
        echo "</div>";

     }
     
  else{

  
  // $video_id = isset($video['video_id']) ? ($video['video_id']) : NULL;

     foreach ($videos as $video) {
         $video_id = isset($video['video_id']) ? ($video['video_id']) : NULL;
         //$video_id;
         echo "<div class='col-md-6'>";
         echo'<iframe width="250" height="180"
                src="https://www.youtube.com/embed/'.$video_id.'"
                frameBorder="0" allow="accelerometer";encrypted-media;gyroscope;picture-in-picture"allowfullscreen>
                </iframe> ';
         // echo '<iframe width="230" height="180"
         //        src="youtube.com/watch?v='.$video_id. '"
         //        frameBorder="0" allow="accelerometer";encrypted-media;gyroscope;picture-in-picture"allowfullscreen>
         //        </iframe>';
         echo "</div>";
      
     }
    
     echo "</div>";
     echo "</div>";
 }
}
}
if(isset($_POST['all'])){
    if (isset($_SESSION['current_user_email'])) {
                
       
        $user = $_SESSION['current_user_email'];
        echo "<div class='row'>";
        
        $db = new DB();
        $videos = $db->get_all_Videos($cat_id,$user);
        
     if(sizeof($videos) < 2){
        echo "<div class='col-md-6'>";
        echo "NO Data Found";
        echo "</div>";

     }
  else{
        foreach ($videos as $video) {
            $video_id = isset($video['video_id']) ? ($video['video_id']) : NULL;
           
            echo "<div class='col-md-6'>";
            echo '<iframe width="250" height="180"
                   src="https://www.youtube.com/embed/' .  $video_id . '"
                   frameBorder="0" allow="accelerometer";encrypted-media;gyroscope;picture-in-picture"allowfullscreen>
                   </iframe>';
            echo "</div>";
        }
        echo "</div>";
    }
    }else{
     
     
       
        echo "<div class='row'>";
        $db = new DB();
        $videos = $db->get_all_Videos($cat_id);
        foreach ($videos as $video) {
            $video_id = isset($video['video_id']) ? ($video['video_id']) : NULL;
            
     if(sizeof($video_id) < 2){
        echo "<div class='col-md-6'>";
        echo "NO Data Found";
        echo "</div>";

     }
  else{
            echo "<div class='col-md-6'>";
            echo '<iframe width="250" height="180"
                   src="https://www.youtube.com/embed/' .  $video_id . '"
                   frameBorder="0" allow="accelerometer";encrypted-media;gyroscope;picture-in-picture"allowfullscreen>
                   </iframe>';
            echo "</div>";
        }
        echo "</div>";
    }
}
}