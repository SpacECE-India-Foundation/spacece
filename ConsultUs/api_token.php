<?php  // this is serverside page === api key ?>

<?php include("../Db_Connection/indexDB.php")?>
<?php
 $email=$_GET["email"];
 $token = $_GET['token'];
?>
<?php
        // showing admin added from database
        $sql = "SELECT * FROM `login` WHERE `token`='$token' ";
        $res = mysqli_query($conn,$sql);
        if(mysqli_num_rows($res)>0 ){
            echo "this token already exsists please try with different credentials";
            }
        else{
        $sql3 = "UPDATE `login` SET `token`='$token' WHERE `email` = '$email'";
        $res3= mysqli_query($conn,$sql3);
        if($res3){
            echo "Token has been successfully registered with email id $email";
        }
        
        }
        

    
                    // displaying value in table
            ?>