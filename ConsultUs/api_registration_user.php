<?php  // this is serverside page === api key ?>

<?php include("../Db_Connection/db_consultus_app.php")?>
<?php
if(!empty($_GET["username"])){
 $user_name=$_GET["username"];}
 if(!empty($_GET["fullname"])){
 $name= $_GET["fullname"];}
 if(!empty($_GET["email"])){
 $email=$_GET["email"];}
 if(!empty($_GET["mobile"])){
 $mob= $_GET["mobile"];}
 if(!empty($_GET["img"])){
 $img=$_GET["img"];}
 if(!empty($_GET["password"])){
 $pass=$_GET["password"];}
 if(!empty($_GET["token"])){
 $token=$_GET["token"];}

?>
<?php
        // showing admin added from database
        if(!empty($user_name) and !empty($name) and !empty($email) and !empty($mob) and !empty($pass))
        {
        $sql = "INSERT INTO `login`(`username`, `password`, `name`, `email`, `phone`, `img`, `token`) 
        VALUES ('$user_name','$pass','$name','$email','$mob','$img','$token')";
        $res = mysqli_query($conn,$sql);
        if(!$res){
            echo "Unable to register you ,please try again later";
            }
        else{
            echo "User was successfully registered";
        
        }
    }
    else{
               echo "please enter registration details
               Details required-
               username- it should be unique or you can enter you mail
               fullname- your name
               password
               mobile
               email
               img- your image(it can be null)
               token- device token(it can be null)                                
               
               
               ";
    }

    
                    // displaying value in table
            ?>