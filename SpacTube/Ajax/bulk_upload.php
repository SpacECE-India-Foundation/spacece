<?php
include '../../Db_Connection/db_spaceTube.php';




if(isset($_GET['bulk'])){

$arr = $_POST; 

          
          foreach( $arr['filter'] as $key=> $row ) {
            $fiel = rand(1000000000000000, 10000000000000000);
           preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',$_POST['video_code'][$key], $match);
                      $video_url = $match[1];
                     
                      $date=date('Y-m-d');
                      $status=  $_POST['status'][$key];
                     $filter= $_POST['filter'][$key];
                     $title= $_POST['title'][$key];
                     $length= $_POST['length'][$key];
                     $status= $_POST['status'][$key];
                     $desc=$_POST['desc'][$key];
            $sql="Insert into videos (v_url,v_date,v_uni_no,status,filter,title,v_desc,length) values('$video_url','$date','$fiel ','$status','$filter','$title','$desc','$length');";           
            
            echo $sql;
            $insert=mysqli_query($mysqli,$sql);
            echo $insert;
          }
         

    
}


