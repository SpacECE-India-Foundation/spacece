<div class = "row">                
<table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                          
                            
                            <th>
                            <form>
                            Video filters:
                            <select name ="filter">
                                <option disabled selected>-- Available filters --</option>
                                <?php
                                  
                                  if($fetch_video){ 
                                    foreach($fetch_video as $video_data){
                                      echo "<option value='". $video_data['filter'] ."'>" .$video_data['filter'] ."</option>";
                                    }}
                                ?>  
                                
                            </select>
                            </form>
                                  </th>
                              <th>
                            <div class="form-group col-sm-12 col-lg-6 mb-0">
                                <input type="text" name="abc" placeholder="Enter filter">
                            </div>
                            </th>
                                  <th>
                            <div class="form-group col-sm-12 col-lg-2 mb-0" >
                                <input type="submit" name="submit" value="View filtered videos" action =  >
                            </div>
                        </div>
                        </th>
                        
                        </tr>

                        <tr>
                            
                        <th width = "200"><b>Free Videos</b></th>
                        </tr>
                      <tr>
                        <th scope="col">S. No.</th>
                        <th scope="col">Videos</th>
                        <th scope="col">Date</th>
                        <th scope="col">Video id</th>


                    <?php
                        if(isset($_POST['submit']))
                        {
                            $first = $_POST['filter'];

                        }


                    ?>



                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if(isset($_POST['submit'])){
                       $filtered = $_GET['abc'];
                    $i = 1; if($fetch_video){ foreach($fetch_video as $video_data){
                         if(($video_data['status'] ==  "free") && ($video_data['filter'] == $filtered) ){
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
               }}else{ echo "<tr><td colspan='4'><h1>Sorry Videos Not Found</h1></td></tr>"; }}
               else{
                $i = 1; if($fetch_video){ foreach($fetch_video as $video_data){
                    if(($video_data['status'] ==  "free")  ){
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
          }}else{ echo "<tr><td colspan='4'><h1>Sorry Videos Not Found</h1></td></tr>"; }
               } ?>
                
                    </tbody>
                </table>

                <table class="table table-hover">
                <thead class="thead-dark">
                        <tr>
                          
                        <th width = "200"><b>Subscribed Videos</b></th>
                            
                            
                        
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
