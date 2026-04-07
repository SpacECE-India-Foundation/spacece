<?php

require_once '../Config/Functions.php';
$Fun_call = new Functions();

$fetch_video = $Fun_call->select_order('videos', 'v_id', 'ASC');


?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
      $("#abcd").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#abcde").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
    </script>
</head>
<body>
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                          
                        <th width = "200"><b>Free Videos</b></th>
                            
                            <th>
                            <form>
                            Video filters:
                            <form method ="post" id = "abcd">
                              <select name=cars >
                                  
                                <?php
                                  
                                  if($fetch_video){ 
                                    foreach($fetch_video as $video_data){
                                      echo "<option value='". $video_data['filter'] ."'>" .$video_data['filter'] ."</option>";
                                    }}
                                ?>
                                </select>
                                  <input type="submit" value=submit name=submit>
                                <?php
                                  if(isset($_POST["submit"])){
                                    
                                  // $DBHOST = 'localhost';
                                  // $DBUSER = 'root';
                                  // $DBPASS = '*A82F3DE193D908186178306A79EF627928F3CDBE';
                                  // $DBNAME = 'gallery';
                                  // $conn;

                                  // $conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);

                                  $to_pass = $_POST["cars"];
                                    
                    $i = 1; if($fetch_video){ foreach($fetch_video as $video_data){
                      if(($video_data['status'] ==  "free" && $video_data == $to_pass)  ){

                                  }
                                  
                                  ?>
                                </form>
                                  
                                  </th>
                                  
                        
                        </tr>
                      <tr>
                        <th scope="col">S. No.</th>
                        <th scope="col">Videos</th>
                        <th scope="col">Date</th>
                        <th scope="col">Video id</th>
                        
                      </tr>
                    </thead>
                    <tbody id = "abcde">
                      <?php
                      
                      // $filtered = $_POST['v_filter'];
                         ?>
                      <tr class="v-set">
                        <th scope="row"><?php echo $i; $i++; ?></th>
                        <td>
                            <iframe width="265" height="150" src="https://www.youtube.com/embed/<?php echo $video_data['v_url']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </td>
                        <td><?php echo $video_data['v_date']; ?></td>
                        <td><?php echo $video_data['v_id']; ?></td>

                      </tr>
                   <?php }
               }}else{ echo "<tr><td colspan='4'><h1>Sorry Videos Not Found</h1></td></tr>"; } ?>
                
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
                    <tbody id = "abcde">
                    <?php 
                       
                      
                    $i = 1; if($fetch_video){ foreach($fetch_video as $video_data){
                         if($video_data['status'] ==  "created"  ){
                         ?>
                      <tr class="v-set">
                        <th scope="row"><?php echo $i; $i++; ?></th>
                        <td>
                            <iframe width="265" height="150" src="https://www.youtube.com/embed/<?php echo $video_data['v_url']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </td>
                        <td><?php echo $video_data['v_date']; ?></td>
                        
                        <td><?php echo $video_data['v_id']; ?></td>
                      </tr>
                   <?php }
               }}else{ echo "<tr><td colspan='4'><h1>Sorry Videos Not Found</h1></td></tr>"; } ?>

                    </tbody>
                </table>
</body>
</html>

