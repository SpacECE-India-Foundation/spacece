<?php  // this is serverside page === api key 
 error_reporting(0);
 include("../Db_Connection/db_consultus_app.php");
// $user = $_GET['user'];

$status= null;
if(isset($_POST['status'])){
    $status=$_POST['status'];
}

$c_id='';
if(isset($_POST['c_id'])){
    $c_id = $_POST['c_id'];
}



$u_id='';
if(isset($u_id)){
    $u_id=$_POST['u_id'];
}



if(empty($c_id) && $status=='All'){
    //echo "inside1";
        // showing admin added from database
        $sql = "SELECT DISTINCT spacece.users.u_name,spacece.users.u_image,consultant_app.new_apointment.booking_id,consultant_app.new_apointment.booking_time , consultant_app.new_apointment.end_time FROM spacece.users JOIN consultant_app.new_apointment WHERE 
        consultant_app.new_apointment.c_id=spacece.users.u_id OR consultant_app.new_apointment.u_id=spacece.users.u_id";
        $res = mysqli_query($conn,$sql);
        header('Content-Type:application/json');


        //checking whether query is excuted or not
        if($res){
            // count that data is there or not in database
            $count= mysqli_num_rows($res);
            $sno =1;
            if($count>0){
                // we have data in database
                while($row = mysqli_fetch_assoc($res))
                {

                    $arr[] = $row;   // making array of data
                 
                }
               echo json_encode(['status'=>'success','data'=>$arr,'c_id'=>$u_id,'result'=>'found']);
               //echo json_encode(['status'=>'success','result'=>'found']);


            }
            else{
                echo json_encode(['status'=>'fail','msg'=>"NO DATA FOUND"]);
            }
        }

    }
                    // displaying value in table
if(!empty($status)){


if($u_id || $c_id && $status==='Active' ){
   
   //echo "inside2";
   
    date_default_timezone_set("Asia/Kolkata");
    $date2=strtotime(date("Y-m-d h:i:sa"));
        // showing admin added from database
       
    if($u_id){
        $sql="SELECT DISTINCT spacece.users.u_name,spacece.users.u_image,consultant_app.new_apointment.booking_id,
        consultant_app.new_apointment.booking_time,concat(consultant_app.new_apointment.b_date, ' ', consultant_app.new_apointment.booking_time) as b_datetime,(SELECT spacece.users.u_name from spacece.users WHERE spacece.users.u_id='$u_id')AS c_name,
        (SELECT spacece.users.u_image from spacece.users where spacece.users.u_id='$u_id')AS c_image, 
         consultant_app.new_apointment.end_time FROM spacece.users 
        JOIN consultant_app.new_apointment
         WHERE spacece.users.u_id = consultant_app.new_apointment.c_id AND consultant_app.new_apointment.u_id ='$u_id'";
    }if($c_id){
        $sql="SELECT DISTINCT spacece.users.u_name,spacece.users.u_image,consultant_app.new_apointment.booking_id,
        consultant_app.new_apointment.booking_time,concat(consultant_app.new_apointment.b_date, ' ', consultant_app.new_apointment.booking_time) as b_datetime,(SELECT spacece.users.u_name from spacece.users where spacece.users.u_id='$c_id')AS c_name,
        (SELECT spacece.users.u_image from spacece.users where spacece.users.u_id='$c_id')AS c_image,  consultant_app.new_apointment.end_time FROM spacece.users 
        JOIN consultant_app.new_apointment
         WHERE spacece.users.u_id = consultant_app.new_apointment.c_id AND consultant_app.new_apointment.c_id ='$c_id'";
    }
        $res = mysqli_query($conn,$sql);
        header('Content-Type:application/json');
   

        //checking whether query is excuted or not
        if($res  ){
           
            
            // count that data is there or not in database
            $count= mysqli_num_rows($res);
            $sno =1;
            if($count>0){
                function add_time($time,$plusMinutes){

                    $endTime = strtotime("+{$plusMinutes} minutes", strtotime($time));
                    return date('Y-m-d h:i:s', $endTime);
                 }
                // we have data in database
                while($row = mysqli_fetch_assoc($res))
                {
               $time1=  $row['end_time'];
            
                   //echo  $time1;
                      $total= add_time(date("Y-m-d h:i:sa"), $time1);
                     $str=strtotime($total);
                    
 
             
                
                //if(strtotime($row['b_time'],strtotime("+{$plusMinutes} minutes")    )> $date2){

                       $arr[] = $row;  
                      }



                 
               // }
                
               echo json_encode(['status'=>'success', 'status1'=>$status,'data'=>$arr, 'c_id'=>$cid , 'result'=>'found']);
               //echo json_encode(['status'=>'success','result'=>'found']);


            }
            else{
                echo json_encode(['status'=>'fail','msg'=>"NO DATA FOUND"]);
            }
        }

    }
}  
    if( $u_id || $c_id ){
    //echo "inside3";
       
  
    if($u_id){
        $sql="SELECT DISTINCT spacece.users.u_id as c_id,spacece.users.u_name as c_name,spacece.users.u_image as c_image,consultant_app.new_apointment.booking_id,
        consultant_app.new_apointment.booking_time,concat(consultant_app.new_apointment.b_date, ' ', consultant_app.new_apointment.booking_time) as b_datetime, consultant_app.new_apointment.b_date,(SELECT spacece.users.u_name from spacece.users WHERE spacece.users.u_id='$u_id')AS u_name,
        (SELECT spacece.users.u_image from spacece.users where spacece.users.u_id='$u_id')AS u_image, 
         consultant_app.new_apointment.end_time FROM spacece.users 
        JOIN consultant_app.new_apointment
         WHERE spacece.users.u_id = consultant_app.new_apointment.c_id AND consultant_app.new_apointment.u_id ='$u_id'";
    }if($c_id){
        $sql="SELECT DISTINCT  spacece.users.u_id as c_id,spacece.users.u_name as c_name ,spacece.users.u_image as c_image,consultant_app.new_apointment.booking_id,
        consultant_app.new_apointment.booking_time,concat(consultant_app.new_apointment.b_date, ' ', consultant_app.new_apointment.booking_time) as b_datetime,consultant_app.new_apointment.b_date,(SELECT spacece.users.u_name from spacece.users where spacece.users.u_id='$c_id')AS u_name,
        (SELECT spacece.users.u_image from spacece.users where spacece.users.u_id='$c_id')AS u_image,  consultant_app.new_apointment.end_time FROM spacece.users 
        JOIN consultant_app.new_apointment
         WHERE spacece.users.u_id = consultant_app.new_apointment.u_id AND consultant_app.new_apointment.c_id ='$c_id'";
    }
    //echo $sql;
             $res = mysqli_query($conn,$sql);
             header('Content-Type:application/json');
     
     
             //checking whether query is excuted or not
             if($res){
               
                 // count that data is there or not in database
                 $count= mysqli_num_rows($res);
                 $sno =1;
                 if($count>0){
                     // we have data in database
                     while($row = mysqli_fetch_assoc($res))
                     {

     
                         $arr[] = $row;   // making array of data
    
                      
                     }
                    echo json_encode(['status'=>'success','data'=>$arr,'result'=>'found']);
                    //echo json_encode(['status'=>'success','result'=>'found']);
     
     
                 }
                 else{
                     echo json_encode(['status'=>'fail','msg'=>"NO DATA FOUND"]);
                 }
             } else{
                echo json_encode(['status'=>'fail','msg'=>"NO DATA FOUND"]);
            }
     
         }
   

         if(isset($_POST['c_id']) && isset($_POST['u_id'])){
    
           
            // echo "inside";
                 // showing admin added from database
                 $sql = "SELECT DISTINCT spacece.users.u_name,spacece.users.u_image,consultant_app.new_apointment.booking_id,consultant_app.new_apointment.booking_time ,
                 consultant_app.new_apointment.end_time,concat(consultant_app.new_apointment.b_date, ' ', consultant_app.new_apointment.booking_time) as b_datetime,
                 FROM spacece.users JOIN consultant_app.new_apointment WHERE spacece.users.u_id IN('$c_id','$u_id') 
                 AND consultant_app.new_apointment.u_id ='$u_id' AND consultant_app.new_apointment.c_id='$c_id' ";
                 $res = mysqli_query($conn,$sql);
                 header('Content-Type:application/json');
         
         
                 //checking whether query is excuted or not
                 if($res  ){
                   
                     // count that data is there or not in database
                     $count= mysqli_num_rows($res);
                     $sno =1;
                     if($count>0){
                         // we have data in database
                         while($row = mysqli_fetch_assoc($res))
                         {
    
         
                             $arr[] = $row;   // making array of data
        
                          
                         }
                        echo json_encode(['status'=>'success' ,'data'=>$arr,'result'=>'found']);
                        //echo json_encode(['status'=>'success','result'=>'found']);
         
         
                     }
                     else{
                         echo json_encode(['status'=>'fail','msg'=>"NO DATA FOUND"]);
                     }
                 }
         
             }
       
 
            ?>

