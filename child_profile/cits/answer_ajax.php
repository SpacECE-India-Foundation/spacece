<?php
include("./include/config.php");

//var_dump($_POST);

$arr = $_POST; 
foreach( $arr['children_id'] as $key=> $row ) {
   
    $children_id=$_POST['children_id'][$key];
    $children_age=$_POST['children_age'][$key];
    $q_id=$_POST['q_id'][$key];
    $answ=$_POST['answ'][$key];
    $parent_id=$_POST['parent_id'][$key];
    $sql="SELECT * from parents_answers where parent_id='$parent_id' AND child_id='$children_id'";
    $select=mysqli_query($con,$sql);
    $count=mysqli_num_rows($select);
    if($count > 0){
        echo "Already Added";
    }else{
        $quey="INSERT INTO `parents_answers`( `question_id`, `parent_id`, `child_id`, `answers`, `age`) 
        VALUES ('$q_id','$parent_id','$children_id','$answ','$children_age')";
        $insert=mysqli_query($con,$quey);
        echo $insert;
    }
  
}