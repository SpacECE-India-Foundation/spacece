<?php

$DBHOST = '3.109.14.4';
$DBUSER = 'ostechnix';
$DBPASS = 'Password123#@!';
// $DBHOST = 'localhost';
// $DBUSER = 'root';
// $DBPASS = '';



$DBNAME = 'spaceece';
$conn;

$conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);


if ($conn) {

} else {
    die("No Connection!");
}


if(isset($_POST['subscribe'])){

  
    $email=$_POST['email'];

   ///var_dump($_POST);

                $sql =  "SELECT * from subscription Where email='$email'";
                var_dump($sql);
                $query=mysqli_query($conn,$sql);
                
                
                if (mysqli_num_rows( $query) > 0) {
                    echo "Already Exists";
              }
               
                  else {
    
                $query3 = mysqli_query($conn, "INSERT into subscription (email) values('$email') ");
               // var_dump($query3);

                $toEmail = $email; 
             $sent = sendEmail( $headers,$toEmail, $emailSubject,$emailBody);
              
                if( $sent==='Success'){
                    
                 echo "Successfully Registered $email";
                }else{
                     echo "Error";
                 }


                //    }
                   }
           
            function sendEmail($headers,$toEmail, $emailSubject, $emailBody){
                $eol = "\r\n";
                $headers = "From: 'SpacActive' <'contactus@spacece.co'>" . $eol;
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            
              
              
                $emailSubject = 'Activity';
            
            
            
                $emailBody = "Hello " . $toEmail . ",<br><br>";
                $emailBody .= "Wishing you a very good morning and a great day ahead.<br><br>";
                $emailBody .= "Please find the activity for your children below. We are sure that it will make children's days full of fun and engaging.<br><br>";
                $emailBody .= "<b>Activity:</b> <br><br>";
                if (mail($toEmail, $emailSubject, $emailBody, $headers)) {
                    echo "Success";
                }else{
                    echo "Error";
                }
             }
            } 
