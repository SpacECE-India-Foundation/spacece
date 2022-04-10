<?php
$room = $_POST['name'];

if(strlen($room)>20 or strlen($room)<2){

    $message = "please enter room name between 2-20 characters";
    echo "<script language='javascript'> alert('$message')</script>";
    echo "<script language='javascript'> ";
   echo "window.location='http://localhost/chatapp';";
    echo'</script>';

}

else if(!ctype_alnum($room)){

    $message = "please choose alphanumeric room name";
    echo "<script language='javascript'> alert('$message')</script>";
    echo "<script language='javascript'> ";
   echo "window.location='http://localhost/chatapp';";
    echo'</script>';
}

else{
    include '../../Db_Connection/indexDB.php'; 
}
// 
$sql= "SELECT * FROM `chat` WHERE `room_name`='$room'";
$res = mysqli_query($conn,$sql);
if($res)
{
    if(mysqli_num_rows($res)>0){
        $message = "please choose different room, room already exist";
        echo "<script language='javascript'> alert('$message')</script>";
        echo "<script language='javascript'> ";
       echo "window.location='http://localhost/chatapp';";
        echo'</script>';
    }

    else{
        $sql = "INSERT INTO `chat`( `room_name`, `rtime`) VALUES ('$room',CURRENT_TIMESTAMP)";
        if(mysqli_query($conn,$sql)){
            $message = "room is ready ";
            echo "<script language='javascript'> alert('$message')</script>";
            echo "<script language='javascript'> ";
           echo "window.location='http://localhost/chatapp/room.php?roomname=$room';";
            echo'</script>';
        }
    }
}
else{
    echo "sorry";
}
?>