<?php
error_reporting(1);
include_once './header_local.php';
include_once '../common/header_module.php';
//include_once 'includes/header1.php';
include_once '../common/banner.php';
include './placeholder.php';


if (!isset($_SESSION['current_user_id'])) {
  echo "<script type='text/javascript'> document.location = '../spacece_auth/login.php'; </script>";
  exit();
}
$conn = new mysqli('localhost', 'root', '', 'spacece');
$sql="select * from learnonapp_courses order by id";
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
  <div id="courses">
    <table id="tbl" class="table table-hover  table-light table-bordered table-striped'> 
      <thead class="thead-dark" ><tr>
      <td>Id</td> 
      <td>Title</td>
      <td>Details</td>
      <td>Level</td>
      <td>Category</td>
      <td>Skills</td>
      <td>Mode</td>
     </tr></thead><tbody>
<?php
if($_GET['user']=="")
  {
    $conn=new mysqli('localhost','root','','spacece');
    //include('../Db_Connection/db_spacece.php');
$sql="select * from learnonapp_courses order by id";

  }else{
   // $conn=include('../Db_Connection/db_spacece.php');
    $conn=new mysqli('localhost','root','','api_learnonapp');
 $sql="select * from learnon_courses b ,learnon_users_courses c where ";
  $sql.="b.id=c.cid and b.id=1" ;


  }
//echo $sql;
$cur=mysqli_query($conn,$sql)
or die("error");
?>

     
  <?php while($row=mysqli_fetch_assoc($cur)) {
     ?>
   <tr>
   <td width="5%"><?=$row['id']?></td> 
      <td width="10%"><?=$row['title']?></td>
      <td width="25%"><?=$row['description']?></td>
      <td width="15%"><?=$row['level']?></td>
      <td width="15%"><?=$row['category']?></td>
      <td width="20%"><?=$row['skill_gained']?></td>
      <td width="10%"><?=$row['mode']?></td>
   </tr></tbody>
    <?php
    
   } ?>
    </table>
  </div>
</div>
<?php
include_once '../common/footer_module.php';
?>