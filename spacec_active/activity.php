<?php
// include_once('includes/header1.php');

include '../Db_Connection/db_spacece_active.php';


if (function_exists('date_default_timezone_set')) {
    date_default_timezone_set("Asia/Kolkata");
}

// then use the date functions, not the other way around
$date1 = date('Y-m-d');
    
    $query = mysqli_query($mysqli1, "SELECT spacece.users.u_email,spacece.users.u_name,spacece.users.u_id,cits1.tblchildren.childDob from spacece.users JOIN cits1.tblchildren where spacece.users.u_email=cits1.tblchildren.parentEmail AND spacece.users.space_active='active'") or die('Sql Query1 Error' . mysqli_error($mysqli));
    
    while ($result1 = mysqli_fetch_assoc($query)) {
        $uid = $result1['u_id'];
        $umob = $result1['u_mob'];
        $name = $result1['u_name'];
        $email = $result1['u_email'];
        $dob=$result1['childDob'];

        $d1 = new DateTime($result1['childDoB']);
        $d2 = new DateTime();
        $months = 0;
        
        $d1->add(new \DateInterval('P1M'));
        while ($d1 <= $d2){
            $months ++;
            $d1->add(new \DateInterval('P1M'));
        }
       // echo $months;
        //print_r($months);
        $days = array();
        if($months<2){
            $days[] =1;
        }elseif( ($months < 6)){
            $days[] =2;
        }elseif( $months<18){
            $days[] =3;   
        }elseif( $months<48){
            $days[] =4;  
        }
        getActivity($days,$email,$name,$umob,$uid,$mysqli1);
    //     $day = implode(', ', $days);
    //     $query = mysqli_query($mysqli1, "SELECT * FROM spaceactive_activities WHERE activity_level IN ('.$day.') ") or die('Sql Query Error2');
      // sendEmail($name, $email, $act_id, $activity_name, $activity_level, $activity_dev_domain, $activity_objectives, $activity_key_dev, $activity_material, $activity_assessment, $activity_process, $activity_instructions,$uid);
    }

function  getActivity($days,$email,$name,$umob,$uid,$mysqli1){
    $day = implode(', ', $days);
         $query = mysqli_query($mysqli1, "SELECT * FROM spaceactive_activities WHERE activity_level IN ('$day') ") or die('Sql Query Error2');
         $result = mysqli_fetch_assoc($query);
         if($result){
             $act_date = $result['activity_date'];
             $act_id = $result['activity_no'];
             $activity_name = $result['activity_name'];
             $activity_level = $result['activity_level'];
             $activity_dev_domain = $result['activity_dev_domain'];
             $activity_objectives = $result['activity_objectives'];
             $activity_key_dev = $result['activity_key_dev'];
             $activity_material = $result['activity_material'];
             $activity_assessment = $result['activity_assessment'];
             $activity_process = $result['activity_process'];
             $activity_instructions = $result['activity_instructions'];
             sendEmail($name, $email, $act_id, $activity_name, $activity_level, $activity_dev_domain, $activity_objectives, $activity_key_dev, $activity_material, $activity_assessment, $activity_process, $activity_instructions,$uid);
}
}

function sendEmail($name, $email, $act_id, $activity_name, $activity_level, $activity_dev_domain, $activity_objectives, $activity_key_dev, $activity_material, $activity_assessment, $activity_process, $activity_instructions,$uid)
{
    include('./includes/data.php');
    $header = "Daily Activities";
    //Email header
    // a random hash will be necessary to send mixed content
    $separator = md5(time());
    
    $eol = "\r\n";
    // main header (multipart mandatory)
    $headers = "From: 'SpacActive' <'contactus@spacece.co'>" . $eol;
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // message
    $toEmail = $email; //add to email address here
    $emailSubject = 'Activity';

    //     Hello <user name>,

    // Wishing you a very good morning and a great day ahead.

    // Please find the activity for your children below. We are sure that it will make children's days full of fun and engaging.

    // <Activity>

    // Thanks and Regards,
    // SpacActive,
    // +919096305648
    // spacactivee@spacece.co

    $emailBody = "Hello " . $name . ",<br><br>";
    $emailBody .= "Wishing you a very good morning and a great day ahead.<br><br>";
    $emailBody .= "Please find the activity for your children below. We are sure that it will make children's days full of fun and engaging.<br><br>";
    $emailBody .= "<b>Activity:</b> <br><br>";
    $emailBody .= "<b>Activity Name:</b> " . $activity_name . "<br>";
    $emailBody .= "<b>Activity Level:</b> " . $activity_level . "<br>";
    $emailBody .= "<b>Activity Development Domain:</b> " . $activity_dev_domain . "<br>";
    $emailBody .= "<b>Activity Objectives:</b> " . $activity_objectives . "<br>";
    $emailBody .= "<b>Activity Key Development:</b> " . $activity_key_dev . "<br>";
    $emailBody .= "<b>Activity Material:</b> " . $activity_material . "<br>";
    $emailBody .= "<b>Activity Assessment:</b> " . $activity_assessment . "<br>";
    $emailBody .= "<b>Activity Process:</b> " . $activity_process . "<br>";
    $emailBody .= "<b>Activity Instructions:</b> " . $activity_instructions . "<br><br>";
    $emailBody .= "Thanks and Regards,<br>";
    $emailBody .= "SpacActive,<br>";
    $emailBody .= "+919096305648<br>";
    $emailBody .= "spacactivee@spacece.co";

    //SEND Mail
    // $is_mail_sent = 0;

    if (mail($toEmail, $emailSubject, $emailBody, $headers)) {
       
        echo "Mail sent successfully to . $toEmail . <br>";
        $is_mail_sent = 1;
        $sql = mysqli_query($mysqli, "SELECT * from user_activity_mail Where u_id='" . $uid . "'") or die('Sql Query3 Error' . mysqli_error($mysqli));
        $act_date = date('Y-m-d');
         if (mysqli_num_rows($sql) > 0) {
            while ($result = mysqli_fetch_assoc($sql)) {

                $update = mysqli_query($mysqli, "UPDATE `user_activity_mail` set act_id='" . $act_id . "',act_date='" . $act_date . "',is_mail_sent='" . $is_mail_sent . "' where u_id='" . $uid . "'")  or die('Sql Query1 Error' . mysqli_error($mysqli));
            }
        } else {


            $query3 = mysqli_query($mysqli, "INSERT into user_activity_mail(u_id,act_id,act_date,is_mail_sent) values('" . $uid . "','$act_id','$act_date','$is_mail_sent')")
                or die('Sql Query4 Error' . mysqli_error($mysqli));
            }
    } else {
        echo "Mail sending failed to . $toEmai . <br>";
    }
}
    // if (mail($toEmail, $emailSubject, $emailBody, $headers)) {
        // echo "mail send ... OK"; // do what you want after sending the email


        // $is_mail_sent = 1;

        // $sql = mysqli_query($mysqli, "SELECT * from user_activity_mail Where u_id='" . $uid[$i] . "'") or die('Sql Query3 Error' . mysqli_error($mysqli));
        // if (mysqli_num_rows($sql) > 0) {
        //     while ($result = mysqli_fetch_assoc($sql)) {

        //         $update = mysqli_query($mysqli, "UPDATE `user_activity_mail` set act_id='" . $act_id . "',act_date='" . $act_date . "',is_mail_sent='" . $is_mail_sent . "' where u_id='" . $uid[$i] . "'")  or die('Sql Query1 Error' . mysqli_error($mysqli));
        //     }
        // } else {


        //     $query3 = mysqli_query($mysqli, "INSERT into user_activity_mail(u_id,act_id,act_date,is_mail_sent) values('" . $uid[$i] . "','$act_id','$act_date','$is_mail_sent')")
        //         or die('Sql Query4 Error' . mysqli_error($mysqli));
            // }
        // } else {
        //     echo "mail send ... ERROR!";
        //     print_r(error_get_last());
    // }

//var_dump($date1);
// if (mysqli_num_rows($query) > 0) {

//     $rowcount = mysqli_num_rows($query);


//     if (mysqli_num_rows($query1) > 0) {
//         while ($result1 = mysqli_fetch_assoc($query1)) {

//             $act_date = $result1['activity_date'];
//             $act_id = $result1['activity_no'];

//             $activity_name = $result1['activity_name'];
//             $activity_level = $result1['activity_level'];
//             $activity_dev_domain = $result1['activity_dev_domain'];
//             $activity_objectives = $result1['activity_objectives'];
//             $activity_key_dev = $result1['activity_key_dev'];
//             $activity_material = $result1['activity_material'];
//             $activity_assessment = $result1['activity_assessment'];
//             $activity_process = $result1['activity_process'];
//             $activity_instructions = $result1['activity_instructions'];

//             // print_r($result1);

//         }
//         // die();
//     }

//     $query = mysqli_query($mysqli, "Select u_id,u_fname,u_email,u_mob from users") or die('Sql Query1 Error' . mysqli_error($mysqli));

//     //$uid='';
//     while ($result = mysqli_fetch_assoc($query)) {
//         // var_dump($result);

//         // echo $rowcount;
//     }





//     for ($i = 0; $i < $rowcount; $i++) {



       


        
        //echo '<SmsResponse xmlns:i="http://www.w3.org/2001/XMLSchema-instance"><ErrorCode>000</ErrorCode><ErrorMessage>Done</ErrorMessage><Activity number>'.$act_id.'</Activity number><MessageData><Messages><Number>'.$umob[$i].'</Number><MessageId>iCZjlRsJfUKtve5OcVoAZw</MessageId></Messages></MessageData></SmsResponse>';


    // }
// }


//include_once('includes/footer.php');
