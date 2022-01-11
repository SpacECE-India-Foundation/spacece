<?php
 include('indexDB.php');
if(isset($_POST['video'])){
	$id=$_POST['c_id'];
	$url=$_POST['link'];
	$time=date($_POST['time']);
	$channel_name=$_POST['channel_name'];
	$token=$_POST['token'];
	$user_id=$_POST['user_id'];
	$c_time=$_POST['c_time'];
//echo $url;
			$sql="Insert into agora_call (user_id,consult_id,channel_name,token,call_time,joining_url,c_time) VALUES('$user_id','$id','$channel_name','$token','$time','$url','$c_time')";
		
			$res2 = mysqli_query($conn,$sql);
	if($res2){
		echo"Success ";

	}else{
		echo"Success ";
	}
	
}

	if(isset($_POST['getCall'])){
		//echo "inside";
		$cname=$_POST['user'];

		date_default_timezone_set('Asia/Kolkata');
$timenow=strtotime(date('d-m-Y H:i'));

//echo $cname;
$sql1="SELECT * from consultant where name='$cname'";

$res2 = mysqli_query($conn,$sql1);

//$count =mysqli_fetch_assoc($res2);
while($row1=mysqli_fetch_assoc($res2)){
	$call=null;

 $sql = "SELECT * FROM `appointment` where `cname`='$cname'";
                    $res = mysqli_query($conn,$sql);
                     while($row = mysqli_fetch_assoc($res))
                            {
                            	$time1=$row1['call_time'];
                            	if(($timenow-$time1)<1800){
                            		
                            		 $call.= $row['call_url'];
                            	
                            	}else{
                            		 $call= "";
                            	}
                            	
                            	//if()

                            	
                            }
                            if($call){
                            	 echo "<a href='".$call."'>Join Now</a>"; echo "<a href='".$call."' class='btn btn-sm'><i class='fa fa-video-camera' aria-hidden='true'>Join Now</i></a>";
                            }
                           
	}


	
}



		