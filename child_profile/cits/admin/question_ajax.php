<?php

include('include/config.php');
//var_dump($_POST);
$arr = $_POST; 
foreach( $arr['category'] as $key=> $row ) {

    $q_text=$_POST['q_text'][$key];
    $category=$_POST['category'][$key];
    $age=$_POST['age'][$key];
    $quey="INSERT INTO `parents_questions`(`child_age`, `q_text`, `category`) VALUES ('$age','$q_text','$category')";
    echo $quey;
    $insert=mysqli_query($con,$quey);
   // $count=mysqli_num_rows($insert);
    if($insert){
        echo "Success";
    }else{
        echo "Error";
    }
}