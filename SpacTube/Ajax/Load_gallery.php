
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