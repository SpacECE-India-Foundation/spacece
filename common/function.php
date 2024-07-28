<?php

include '../Db_Connection/db_spacece.php';
//$_POST['subscribe']='1';

if(isset($_POST['subscribe'])){

  
    $email=$_POST['email'];
  // $email='varunmanila@gmail.com';
   ///var_dump($_POST);

                $sql =  "SELECT * from subscription Where email='$email'";
               
                $query=mysqli_query($conn,$sql);
                
                
                if (mysqli_num_rows( $query) > 0) {
                    echo "Error";
              }
               
                  else {
                   
                $query3 = mysqli_query($conn, "INSERT into subscription (email) values('$email') ");
              
                  
                $eol = "\r\n";
               
                $headers = "From: 'SpacActive' <'contactus@spacece.co'>" . $eol;
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            
            
              
              
                $emailSubject = 'Subscription';
            
            
            
                $emailBody = "Hello " . $email . ",<br><br>";
                $emailBody .= "Thank You for Subscribing <br><br>";
               
                $emailBody .= "<b>You will receive Notifications and latest updates  this Email</b> <br><br>";
               
                if (mail( $email, $emailSubject, $emailBody, $headers)) {
                    echo "Success";
                }else{
                    echo "Invalid";
                }


                //   }
                   }
           
         
             
            } 
