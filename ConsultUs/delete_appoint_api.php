<?php  // this is serverside page === api key ?>

<?php include('../Db_Connection/db_consultus_app.php');?>
<?php
 $bid=$_GET["bookid"];
?>
<?php
        // showing admin added from database
        $sql = "SELECT * FROM `appointment` WHERE `bid` = '$bid'";
        $res = mysqli_query($conn,$sql);
        if(mysqli_num_rows($res)== 0 ){
            echo "No appointment is booked with booking id $bid ,please enter different booking id";
            }
        else{
        $sql3 = "DELETE FROM `appointment` WHERE `bid` = '$bid'";
        $res3= mysqli_query($conn,$sql3);
        if($res3){
            echo "Appointment has been successfully deleted please check your account to verify the same";
        }
        
        }
        

    
                    // displaying value in table
            ?>