<?php
session_start();
//var_dump($_SESSION);
// if(empty($_SESSION['current_user_email'])){
//     header('location:../spacece_auth/login.php');
//     exit();
//   }
include_once './header_local.php';
include_once '../common/header_module.php';
// include_once '../common/banner.php';
include('../Db_Connection/db_consultus_app.php');
$email=$_SESSION['current_user_email'];
//echo $email;
define('DB_CITY_DATABASE', 'cits1');
$conn1 = new mysqli(DB_HOST_NAME, DB_USER_NAME, DB_USER_PASSWORD, DB_CITY_DATABASE);
$query = "SELECT  * FROM `tblchildren` WHERE  parentEmail='$email'";
$res = mysqli_query($conn1, $query);
//$count=mysqli_num_rows($res);
if($res){
    ?>

    <table class="table table-bordered  table-striped table-hover"><thead>
        <tr>
            <td>Name</td>
            <td>Age</td>
            <td>Gender</td>
            <td>Immunaization</td>
            <td>Email</td>
            <td>Contact Number</td>
            <td>Address</td>
        </tr>
    </thead>
    <?php
 while($row=mysqli_fetch_assoc($res)){
?>
<tr>
    <td><?php echo $row['childName']; ?></td>
    <td><?php echo $row['childAge']; ?></td>
    <td><?php echo  $row['childGender']; ?></td>
    <td><?php echo $row['childImmu']; ?></td>
    <td><?php echo $row['parentEmail']; ?></td>
    <td><?php echo  $row['parentContno']; ?></td>
    <td><?php echo $row['parentAdd']; ?></td>
</tr>
<?php
 }
 ?>
 </table>
 <?php
}else{
    echo "No data Found";
}
?>

<?php include '../common/footer_module.php';?>