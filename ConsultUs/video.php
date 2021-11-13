<?php
 include('indexDB.php');
if(isset($_POST['video'])){
	$id=$_POST['c_id'];
	$url=$_POST['link'];
	$time=$_POST['time'];
//echo $url;

			$sql="UPDATE  consultant set call_url='$url',call_time='$time' where c_id='$id'";
			echo $sql;
			$res2 = mysqli_query($conn,$sql);

		//	echo"Success ";
	
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
                            	 echo "<a href='".$call."'>Join Now</a>";
                            }
                           
	}


	
}



		