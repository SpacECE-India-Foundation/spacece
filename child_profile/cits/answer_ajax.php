<?php
include("./include/config.php");

//var_dump($_POST);

$arr = $_POST; 
foreach( $arr['children_id'] as $key=> $row ) {
   
    $children_id=$_POST['children_id'][$key];
    $children_age=$_POST['children_age'][$key];
    $q_id=$_POST['q_id'][$key];
    $answ=$_POST['answ'][$key];
    $email=$_POST['email'][$key];
    $parent_id=$_POST['parent_id'][$key];
    $sql="SELECT * from parents_answers where parent_id='$parent_id' AND child_id='$children_id' AND age='$children_age'";
    $select=mysqli_query($con,$sql);
    $count=mysqli_num_rows($select);
    if($count > 0){
        echo "Already Added";
    }else{
        $quey="INSERT INTO `parents_answers`( `question_id`, `parent_id`, `child_id`, `answers`, `age`) 
        VALUES ('$q_id','$parent_id','$children_id','$answ','$children_age')";
        $insert=mysqli_query($con,$quey);
        $eol = "\r\n";
        // main header (multipart mandatory)
        $headers = "From: 'SpacActive' <'contactus@spacece.co'>" . $eol;
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
        // message
        $toEmail = $email; //add to email address here
        $emailSubject = 'Form Submision';
        $emailBody = "Hello " . $email . ",<br><br>";
        $emailBody = "You Have successfully Submitted  Form<br><br>";
        $emailBody .= "Thank you for Showing intrest on Us.<br><br>";
        if (mail($email, $emailSubject, $emailBody, $headers)) {
       
            echo "Mail sent successfully to . $email . <br>";
        }else{
            echo "Error While Sending Email";
        }

        echo $insert;
    }
  
}