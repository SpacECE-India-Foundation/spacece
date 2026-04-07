
<?php

$abc;
require_once '../Config/Functions.php';
$Fun_call = new Functions();
$fetch_video = $Fun_call->select_order('videos', 'v_id', 'ASC');

?>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  </head>
  <body>
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr> 
              <th width = "200"><b>Free Videos</b></th>
              
            </tr>
            <tr>
              <th scope="col">S. No.</th>
              <th scope="col">Videos</th>
              <th scope="col">Date</th>
              <th scope="col">Video id</th>  
            </tr>
        </thead>
        <tbody>
        <?php
          // // $filtered = $_POST['v_filter'];
          //   $select1 = $_POST['Select Filter'];
          // if(isset($_POST['submit'])){
          //   $abc = $_POST['filterr'];
          
          
          
            $i = 1; foreach($fetch_video as $video_data){
              if($video_data['status'] ==  "free" ){
        ?>

          <tr class="v-set">
            <th scope="row"><?php echo $i; $i++; ?></th>
            <td>
              <iframe width="265" height="150" src="https://www.youtube.com/embed/<?php echo $video_data['v_url']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
             <div class="card-body pt-2 pb-2">
                                            <h6 class="card-title">
                                            <?php echo $video_data['title']; ?></h6>
                                            <?php echo $video_data['v_date']; ?><br>
                                            <a href="likecnt.php?btn=<?php echo $video_data['v_id'] ?>">
                                                <button name="likecnt" class="btn"><img src="like.png" style="justify-content: center; padding-left: 30%; height: 15px; width: 25px"></button>

                                            </a>
                                            <?php echo $video_data['cntlike']; ?>
                                            <a href="likecnt.php?btn1=<?php echo $video_data['v_id'] ?>">
                                                <button name="dislikecnt" class="btn"><img src="dislike.png" style="justify-content: center; padding-left: 30%; height: 15px; width: 30px"></button>

                                            </a>
                                            <?php echo $video_data['cntdislike']; ?>
                                            <button name="share" class="btn"><a href="whatsapp://send?text=<?php echo "*SpacTube - Video Gallery on Child Education* %0a %0aI am sharing one important video on Child Education.%0ahttps://www.youtube.com/watch?v=" . $video_data['v_url'] . " %0a %0aYou can also subscribe to SpacTube by clicking on the following.%0ahttps://www.spacece.co/offerings/spactube %0a %0aThanks and Regards, %0aSpacECE India Foundation %0a %0awww.spacece.co %0awww.spacece.in %0a"; ?>" data-action="share/whatsapp/share" target="_blank"><img src="whatsapp logo.png" style="justify-content: center; padding-left: 30%; height: 15px; width: 25px"></a></button>
                                            <!-- <a href="comment.php">
                                <button name="comment" class="btn"><img src="comments.png" style="justify-content: center; padding-left: 30%; height: 20px; width: 35px"></button>
                            </a> -->

                                        </div>
            
            
              </td>
            <td><?php echo $video_data['v_date']; ?></td>
            <td><?php echo $video_data['v_id']; ?></td>
            </tr>

          <?php
              }}
?>
        </tbody>
      </table>

      <table class="table table-hover">
      <thead class="thead-dark">
        <tr><th><b>Subscribed Videos</b></th></tr>
        <tr>
          <th scope="col">S. No.</th>
          <th scope="col">Videos</th>
          <th scope="col">Date</th>
          <th scope="col">Video id</th> 
        </tr>
      </thead>
      <tbody>
      <?php 
      $i = 1; if($fetch_video){ 
        foreach($fetch_video as $video_data){
          if($video_data['status'] ==  "created"){
      ?>
        <tr class="v-set">
          <th scope="row"><?php echo $i; $i++; ?></th>
          <td>
            <iframe width="265" height="150" src="https://www.youtube.com/embed/<?php echo $video_data['v_url']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </td>
          <td><?php echo $video_data['v_date']; ?></td>
          <td><?php echo $video_data['v_id']; ?></td>
         
        </tr>

        <?php
        }}}
        else{
         echo "<tr><td colspan='4'><h1>Sorry Videos Not Found</h1></td></tr>"; }?>
      </tbody>
    </table>
  </body>
</html>