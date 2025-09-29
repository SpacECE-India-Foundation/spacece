<?php
//***********************/
//***#0000567 Geeta R
//** Addednew file toshow toprated instructors
//Added new table for instructors detail
//**  table name: instructor sql file added
//** */ dbinstructor.sql  */ 
//** */
 /************************************* */
error_reporting(1);
include_once './header_local.php';
include_once '../common/header_module.php';
//include_once 'includes/header1.php'
include_once '../common/banner.php';
include './placeholder.php';

/*
if (!isset($_SESSION['current_user_id'])) {
  echo "<script type='text/javascript'> document.location = '../spacece_auth/login.php'; </script>";
  exit();
}
  */
$conn = new mysqli('localhost', 'root', '', 'api_learnonapp');
$sql="select * from instructor order by id";
//echo $sql;
$cur=mysqli_query($conn,$sql)
or die("error")

?>
<!-- <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head> -->

<div class="my_course_container">
  <div id="topinst">
    <table id="tbl"  class="table table-hover  table-light table-bordered table-striped'> 
      <thead class="thead-dark" >
        <tr><td colspan="4" align="center"><h2> Top Instructors</h2></td></tr>
        <tr>
      <td>Id</td> 
      <td>Name</td>
      <td>Course</td>
      <td>Rating</td>
     </tr></thead><tbody>
<?php

    $conn=include('../Db_Connection/db_learnonapp.php');
 $sql="select  c.id,b.title,c.name,b.rating from learnon_courses b ,instructor c where ";
  $sql.="b.instructor=c.id " ;
  //echo($sql);
$cur=mysqli_query($conn,$sql)
 or die(mysqli_error($conn));

?>

     
  <?php while($row=mysqli_fetch_assoc($cur)) {
     ?>
   <tr>
 <td width='20%'> <?=$row['id']?> </td> 

      <td width='35%'><?=$row['name']?></td>
      <td width='35%'><?=$row['title']?></td>
       <td width='15%'><?=$row['Rating']?></td>
         </tr>
    <?php
    
   } ?>
   </tbody>
    </table>
  </div>
</div>
<?php
include_once '../common/footer_module.php';
?>