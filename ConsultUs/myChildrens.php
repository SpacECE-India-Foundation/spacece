<?php
error_reporting(0);
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
$email = $_SESSION['current_user_email'];
//echo $email;
define('DB_CITY_DATABASE', 'cits1');
$conn1 = new mysqli(DB_HOST_NAME, DB_USER_NAME, DB_USER_PASSWORD, DB_CITY_DATABASE);
//$conn1 = new mysqli('localhost', 'root', '', 'cits1');
$query = "SELECT  * FROM `tblchildren` WHERE  parentEmail='$email'";
$res = mysqli_query($conn1, $query);
//$count=mysqli_num_rows($res);
if ($res) {
?>
    <style>
        th,
        td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }
    </style>
    <div class="container" style=" margin-top: 150px; margin-bottom:50px">
        <table class="table table-bordered  table-striped table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Immunaization</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Address</th>
                </tr>
            </thead>
            <?php
            while ($row = mysqli_fetch_assoc($res)) {
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
    </div>


<?php
} else {
    echo "No data Found";
}
?>

<?php include '../common/footer_module.php'; ?>