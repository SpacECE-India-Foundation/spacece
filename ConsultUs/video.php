<?php
 include('indexDB.php');
if(isset($_POST['video'])){
	$id=$_POST['c_id'];
	$url=$_POST['link'];
	$time=$_POST['time'];
	$channel_name=$_POST['channel_name'];
	$token=$_POST['token'];
	$user_id=$_POST['user_id'];
	$c_time=strtotime($_POST['time']);
//echo $url;

			$sql="Insert into agora_call (user_id,consult_id,channel_name,token,call_time,joining_url,c_time) VALUES('$user_id','$id','$channel_name','$token','$time','$url','$c_time')";
		echo $sql;
			$res2 = mysqli_query($conn,$sql);
	if($res2){
		echo"Success ";

	}else{
		echo"Success ";
	}
	
}

	if(isset($_POST['getCall'])){
	
		$c_id=$_POST['user'];
		echo $c_id;
		date_default_timezone_set('Asia/Kolkata');
$timenow=strtotime(date('Y-m-d H:i:s'));
echo $timenow;
//echo $cname;
$sql1="SELECT * from agora_call where consult_id='$c_id'";
echo $sql1;

$res2 = mysqli_query($conn,$sql1);

//$count =mysqli_fetch_assoc($res2);
while($row1=mysqli_fetch_assoc($res2)){
	$call=null;

 $sql = "SELECT * FROM `agora_call` where `consult_id`='$c_id'";
                    $res = mysqli_query($conn,$sql);
                     while($row = mysqli_fetch_assoc($res))
                            {
                            	$time1=$row['c_time'];
								echo $time1;
                            	if(($timenow-$time1)<1800){
                            		
                            		 $call.= $row['joining_url'];
                            	
                            	}else{
                            		 $call= "";
                            	}

                            }
                            if(!empty($call)){
                            	 echo "<a href='".$call."'>Join Now</a>"; echo "<a href='".$call."' class='btn btn-sm'><i class='fa fa-video-camera' aria-hidden='true'>Join Now</i></a>";
                            }
                           
	}


	
}



		